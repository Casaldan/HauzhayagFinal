<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'scholarship_type',
        'password',
        'temporary_password',
        'profile_picture',
        'class_year',
        'status',
        // Add other necessary fields
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
