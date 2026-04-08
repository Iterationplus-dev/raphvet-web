<?php

namespace App\Models;

use Database\Factories\MedicalRecordFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalRecord extends Model
{
    /** @use HasFactory<MedicalRecordFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'pet_id',
        'vet_id',
        'appointment_id',
        'visit_date',
        'chief_complaint',
        'diagnosis',
        'treatment',
        'prescription',
        'follow_up_date',
        'weight_at_visit',
        'temperature',
        'notes',
        'attachments',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'visit_date' => 'date',
            'follow_up_date' => 'date',
            'weight_at_visit' => 'decimal:2',
            'attachments' => 'array',
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
}
