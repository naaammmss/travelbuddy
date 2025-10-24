<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'full_name',
        'email',
        'phone',
        'participants',
        'start_date',
        'end_date',
        'total_price',
        'status',
    ];

    public function package()
    {
        return $this->belongsTo(TourPackages::class, 'package_id');
    }
}
