<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    #[Rule('required|max:100')]
    public string $name = '';

    #[Rule('required|email|unique:users')]
    public string $email = '';

    #[Rule('nullable|max:20')]
    public string $phone = '';

    #[Rule('required|min:8|confirmed')]
    public string $password = '';

    public string $password_confirmation = '';

    public function register(): void
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone ?: null,
            'password' => $this->password,
        ]);

        $user->assignRole('customer');

        Auth::login($user);

        $this->redirect(route('my.dashboard'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.auth.register');
    }
}
