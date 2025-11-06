<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'contact_number',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function customerProfile()
{
    return $this->hasOne(CustomerProfile::class, 'user_id');
}


    public function agencyProfile()
    {
        return $this->hasOne(AgencyProfile::class);
    }

    public function adminProfile()
    {
        return $this->hasOne(AdminProfile::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isAgency()
    {
        return $this->role === 'travel_agency';
    }

    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    /**
     * Get the user's role with proper formatting
     */
    public function getRoleNameAttribute()
    {
        return match($this->role) {
            'customer' => 'Customer',
            'travel_agency' => 'Travel Agency',
            'admin' => 'Administrator',
            default => 'Unknown'
        };
    }
}
