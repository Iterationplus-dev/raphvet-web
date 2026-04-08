<?php

namespace App\Models;

use Database\Factories\VaccinationReminderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VaccinationReminder extends Model
{
    /** @use HasFactory<VaccinationReminderFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'vaccination_id',
        'pet_id',
        'owner_id',
        'reminder_date',
        'channel',
        'status',
        'sent_at',
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
            'reminder_date' => 'date',
            'sent_at' => 'datetime',
        ];
    }

    public function vaccination(): BelongsTo
    {
        return $this->belongsTo(Vaccination::class);
    }

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
