<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $image_path
 */
class CollectionPointImage extends Model
{
    protected $fillable = ['collection_point_id', 'image_path'];

    public function collectionPoint()
    {
        return $this->belongsTo(CollectionPoint::class);
    }

    public function getImagePath(): string
    {
        return $this->image_path;
    }

    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }
}
