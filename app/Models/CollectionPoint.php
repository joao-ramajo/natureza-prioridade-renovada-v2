<?php

namespace App\Models;

use App\Enum\CollectionPointStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property int $user_id
 * @property string $uuid
 * @property string $name
 * @property CollectionPointStatus $status
 * @property string $category
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip_code
 * @property string $principal_image
 * @property float|null $lat
 * @property float|null $lng
 * @property \Carbon\Carbon|null $approved_at
 * @property \Carbon\Carbon|null $rejected_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $contested_at
 * @property \Carbon\Carbon|null $contestation_deadline
 * @property \Carbon\Carbon|null $reevaluated_at
 * @property \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CollectionPointImage[] $images
 */
class CollectionPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'name',
        'status',
        'category',
        'address',
        'city',
        'state',
        'zip_code',
        'description',
        'lat',
        'lng',
        'rejection_reason',
        'approved_at',
        'rejected_at',
        'principal_image',
        'contested_at',
        'contestation_deadline',
        'reevaluated_at',
    ];

    protected $casts = [
        'lat' => 'decimal:7',
        'lng' => 'decimal:7',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'contested_at' => 'datetime',
        'contestation_deadline' => 'datetime',
        'reevaluated_at' => 'datetime',
        'status' => CollectionPointStatus::class,
    ];

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });

        static::deleting(function (CollectionPoint $cp) {
            if ($cp->principal_image) {
                Storage::disk('public')->delete($cp->principal_image);
            }

            foreach ($cp->images as $image) {
                Storage::disk('public')->delete($image->getImagePath());
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function images(): HasMany
    {
        return $this->hasMany(CollectionPointImage::class);
    }

    public function getPrincipalImageUrlAttribute(): ?string
    {
        return $this->principal_image ? asset('storage/' . $this->principal_image) : null;
    }

    public function scopeByUuid($query, string $uuid)
    {
        return $query->where('uuid', $uuid);
    }
}
