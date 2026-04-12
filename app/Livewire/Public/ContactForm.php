<?php

namespace App\Livewire\Public;

use App\Models\ContactSubmission;
use Illuminate\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ContactForm extends Component
{
    #[Rule('required|max:100')]
    public string $name = '';

    #[Rule('required|email')]
    public string $email = '';

    #[Rule('nullable|max:20')]
    public string $phone = '';

    #[Rule('required|max:150')]
    public string $subject = '';

    #[Rule('required|min:20')]
    public string $message = '';

    public bool $submitted = false;

    public bool $sending = false;

    public function submit(): void
    {
        $this->sending = true;

        $this->validate();

        ContactSubmission::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone ?: null,
            'subject' => $this->subject,
            'message' => $this->message,
            'ip_address' => request()->ip(),
        ]);

        $this->submitted = true;
        $this->sending = false;

        $this->dispatch('notify', type: 'success', message: 'Your message has been sent successfully!');
    }

    public function render(): View
    {
        return view('livewire.public.contact')
            ->layout('components.layouts.app', [
                'title' => 'Contact Us',
                'description' => 'Get in touch with Raph Veterinary Services. Send us a message for enquiries about veterinary care, appointments, products, or any other support across Nigeria.',
            ]);
    }
}
