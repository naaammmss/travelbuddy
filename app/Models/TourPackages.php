<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackages extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // package name
        'category',
        'description',
        'duration',
        'max_participants',
        'price',
        'location',
        'cover_photo', 
        'itinerary',
        'inclusions',
        'exclusions',
        'gallery',
    ];

    protected $casts = [
        'gallery' => 'array',
    ];

    /**
     * We store the cover image in `cover_photo` - expose it as `image_path`.
     */
    public function getImagePathAttribute()
    {
        return $this->attributes['cover_photo'] ?? null;
    }
}
