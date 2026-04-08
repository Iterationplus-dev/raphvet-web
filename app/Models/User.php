<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'whatsapp_number',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'email_notifications' => 'boolean',
        ];
    }

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class, 'owner_id');
    }

    public function vetProfile(): HasOne
    {
        return $this->hasOne(VetProfile::class);
    }

    public function customerAppointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'customer_id');
    }

    public function vetAppointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'vet_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isVet(): bool
    {
        return $this->hasRole('vet');
    }

    public function isCustomer(): bool
    {
        return $this->hasRole('customer');
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return $this->avatar;
        }

        $name = urlencode($this->name);

        return "https://ui-avatars.com/api/?name={$name}&background=random";
    }
}
