<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'address',
        'best_time_to_visit',
        'visit_duration',
        'entry_fee',
        'special_notes',
        'image_path',
        'map_embed_url',    
    ];
}


