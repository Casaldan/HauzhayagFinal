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
        'application_reason',
        'status',
        'applied_at'
    ];

    protected $casts = [
        'applied_at' => 'datetime',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
