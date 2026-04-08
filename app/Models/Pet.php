<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\PetFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    /** @use HasFactory<PetFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'owner_id',
        'name',
        'species',
        'breed',
        'gender',
        'date_of_birth',
        'weight_kg',
        'color',
        'microchip_number',
        'profile_photo',
        'notes',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'weight_kg' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function medicalRecords(): HasMany
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function vaccinations(): HasMany
    {
        return $this->hasMany(Vaccination::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function getAgeAttribute(): ?string
    {
        if (! $this->date_of_birth) {
            return null;
        }

        $dob = Carbon::parse($this->date_of_birth);
        $now = Carbon::now();

        $years = $dob->diffInYears($now);
        $months = $dob->copy()->addYears($years)->diffInMonths($now);

        if ($years >= 1) {
            return $years === 1
                ? '1 year'.($months > 0 ? ", {$months} ".($months === 1 ? 'month' : 'months') : '')
                : "{$years} years".($months > 0 ? ", {$months} ".($months === 1 ? 'month' : 'months') : '');
        }

        $totalMonths = $dob->diffInMonths($now);
        $days = $dob->copy()->addMonths($totalMonths)->diffInDays($now);

        if ($totalMonths >= 1) {
            return $totalMonths === 1
                ? '1 month'.($days > 0 ? ", {$days} ".($days === 1 ? 'day' : 'days') : '')
                : "{$totalMonths} months".($days > 0 ? ", {$days} ".($days === 1 ? 'day' : 'days') : '');
        }

        $totalDays = $dob->diffInDays($now);

        return $totalDays === 1 ? '1 day' : "{$totalDays} days";
    }
}
