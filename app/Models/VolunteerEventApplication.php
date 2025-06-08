<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VolunteerEventApplication extends Model
{
    protected $fillable = [
        'event_id',
        'full_name',
        'email',
        'phone_number',
        'application_reason',
        'tracking_code',
        'status',
        'applied_at',
        'admin_notes'
    ];

    protected $casts = [
        'applied_at' => 'datetime',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
