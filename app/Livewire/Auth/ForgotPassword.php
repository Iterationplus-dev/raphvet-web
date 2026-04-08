<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class ForgotPassword extends Component
{
    #[Rule('required|email')]
    public string $email = '';

    public string $status = '';

    public function sendResetLink(): void
    {
        $this->validate();

        $result = Password::sendResetLink(['email' => $this->email]);

        if ($result === Password::RESET_LINK_SENT) {
            $this->status = __($result);
            $this->email = '';
        } else {
            $this->addError('email', __($result));
        }
    }

    public function render(): View
    {
        return view('livewire.auth.forgot-password');
    }
}
