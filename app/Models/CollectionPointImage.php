<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionPointImage extends Model
{
    protected $fillable = ['collection_point_id', 'image_path'];

    public function collectionPoint()
    {
        return $this->belongsTo(CollectionPoint::class);
    }

    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }
}