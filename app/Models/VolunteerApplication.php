<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VolunteerApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'full_name',
        'email',
        'phone_number',
        'address',
        'reason',
        'status',
        'admin_notes',
        'confirmation_code',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
