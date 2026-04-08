<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Login extends Component
{
    #[Rule('required|email')]
    public string $email = '';

    #[Rule('required')]
    public string $password = '';

    public bool $remember = false;

    public function mount(): void
    {
        if (Auth::check()) {
            $this->redirectToDashboard();
        }
    }

    public function authenticate(): void
    {
        $this->validate();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', 'These credentials do not match our records.');

            return;
        }

        session()->regenerate();

        $this->redirectToDashboard();
    }

    private function redirectToDashboard(): void
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $this->redirect(route('admin.dashboard'), navigate: true);
        } elseif ($user->hasRole('vet')) {
            $this->redirect(route('vet.calendar'), navigate: true);
        } else {
            $this->redirect(route('my.dashboard'), navigate: true);
        }
    }

    public function render(): View
    {
        return view('livewire.auth.login');
    }
}
