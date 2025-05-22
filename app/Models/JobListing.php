<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobListing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'company',
        'company_name',
        'location',
        'type',
        'employment_type',
        'hours_per_week',
        'status',
        'category',
        'start_date',
        'end_date',
        'requirements',
        'benefits',
        'contact_email',
        'contact_phone',
        'salary_min',
        'salary_max',
        'role',
        'qualifications',
        'contact_person',
        'expires_at',
        'is_admin_posted',
        'posted_by'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'expires_at' => 'datetime',
        'is_admin_posted' => 'boolean',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2'
    ];

    // Add accessors to handle salary values
    public function getSalaryMinAttribute($value)
    {
        return $value !== null ? (float) $value : null;
    }

    public function getSalaryMaxAttribute($value)
    {
        return $value !== null ? (float) $value : null;
    }

    public function postedBy()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}
