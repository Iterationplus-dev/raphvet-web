<?php

namespace App\Models;

use Database\Factories\AppointmentFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Appointment extends Model
{
    /** @use HasFactory<AppointmentFactory> */
    use HasFactory, SoftDeletes;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'reference_number',
        'customer_id',
        'guest_name',
        'guest_email',
        'guest_phone',
        'vet_id',
        'pet_id',
        'service_id',
        'appointment_date',
        'start_time',
        'end_time',
        'status',
        'type',
        'reason',
        'notes',
        'cancellation_reason',
        'cancelled_at',
        'reminder_sent_at',
        'total_amount',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'appointment_date' => 'date',
            'cancelled_at' => 'datetime',
            'reminder_sent_at' => 'datetime',
            'total_amount' => 'decimal:2',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'reference_number';
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function vet(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vet_id');
    }

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class)->withDefault();
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class)->withDefault();
    }

    public function statusLogs(): HasMany
    {
        return $this->hasMany(AppointmentStatusLog::class);
    }

    public function scopeUpcoming(Builder $query): void
    {
        $query->whereDate('appointment_date', '>=', today())
            ->whereIn('status', ['pending', 'confirmed']);
    }

    public function scopeToday(Builder $query): void
    {
        $query->whereDate('appointment_date', today());
    }

    public function isCancellable(): bool
    {
        return \in_array($this->getAttribute('status'), ['pending', 'confirmed']);
    }

    public static function generateReference(): string
    {
        return 'APT-'.strtoupper(Str::random(8));
    }
}
