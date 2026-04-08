<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'position_applied',
        'experience_years',
        'cover_letter',
        'cv_path',
        'linkedin_url',
        'status',
        'admin_notes',
    ];

    public function scopeNew(Builder $query): void
    {
        $query->where('status', 'new');
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'new' => 'badge badge-blue',
            'reviewed' => 'badge badge-yellow',
            'shortlisted' => 'badge badge-green',
            'rejected' => 'badge badge-red',
            default => 'badge badge-gray',
        };
    }
}
