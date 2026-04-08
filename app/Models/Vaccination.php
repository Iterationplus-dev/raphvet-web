<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\VaccinationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vaccination extends Model
{
    /** @use HasFactory<VaccinationFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'pet_id',
        'vet_id',
        'vaccine_name',
        'batch_number',
        'manufacturer',
        'administered_date',
        'next_due_date',
        'notes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'administered_date' => 'date',
            'next_due_date' => 'date',
        ];
    }

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function vet(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vet_id');
    }

    public function reminders(): HasMany
    {
        return $this->hasMany(VaccinationReminder::class);
    }

    public function isOverdue(): bool
    {
        return $this->next_due_date !== null
            && $this->next_due_date->isPast();
    }

    public function isDueSoon(): bool
    {
        return $this->next_due_date !== null
            && ! $this->next_due_date->isPast()
            && $this->next_due_date->lte(Carbon::now()->addDays(14));
    }
}
