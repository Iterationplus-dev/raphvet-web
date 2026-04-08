<?php

namespace App\Livewire\Customer;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.customer')]
class ProfileSettings extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $whatsappNumber = '';

    public string $currentPassword = '';

    public string $newPassword = '';

    public string $newPasswordConfirmation = '';

    public bool $profileSaved = false;

    public bool $passwordSaved = false;

    public string $passwordError = '';

    public function mount(): void
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone ?? '';
        $this->whatsappNumber = $user->whatsapp_number ?? '';
    }

    public function updateProfile(): void
    {
        $user = auth()->user();

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'whatsappNumber' => ['nullable', 'string', 'max:30'],
        ]);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'whatsapp_number' => $this->whatsappNumber,
        ]);

        $this->profileSaved = true;
    }

    public function updatePassword(): void
    {
        $this->passwordError = '';
        $this->passwordSaved = false;

        $this->validate([
            'currentPassword' => ['required'],
            'newPassword' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();

        if (! Hash::check($this->currentPassword, $user->password)) {
            $this->passwordError = 'The current password is incorrect.';

            return;
        }

        $user->update(['password' => Hash::make($this->newPassword)]);

        $this->currentPassword = '';
        $this->newPassword = '';
        $this->newPasswordConfirmation = '';
        $this->passwordSaved = true;
    }

    public function render(): View
    {
        return view('livewire.customer.profile-settings');
    }
}
