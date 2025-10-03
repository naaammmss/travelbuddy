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
        'image_path',
        'itinerary',
        'inclusions',
        'exclusions',
    ];
}
