<?php

namespace App\CollectionPoint\Domain;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $image_path
 */
#[Fillable(['collection_point_id', 'image_path'])]
class CollectionPointImage extends Model
{
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
