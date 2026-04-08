<?php

namespace App\Livewire\Public;

use App\Models\JobApplication;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app')]
class CareersPage extends Component
{
    use WithFileUploads;

    public bool $submitted = false;

    #[Validate('required|string|max:100')]
    public string $fullName = '';

    #[Validate('required|email|max:150')]
    public string $email = '';

    #[Validate('required|string|max:20')]
    public string $phone = '';

    #[Validate('required|string|max:100')]
    public string $positionApplied = '';

    #[Validate('required|in:0-1,1-3,3-5,5-10,10+')]
    public string $experienceYears = '';

    #[Validate('required|string|min:50|max:2000')]
    public string $coverLetter = '';

    #[Validate('nullable|file|mimes:pdf,doc,docx|max:5120')]
    public mixed $cv = null;

    #[Validate('nullable|url|max:200')]
    public string $linkedinUrl = '';

    public function submit(): void
    {
        $this->validate();

        $cvPath = null;
        if ($this->cv) {
            $cvPath = $this->cv->store('job-applications/cvs', 'local');
        }

        JobApplication::create([
            'full_name' => $this->fullName,
            'email' => $this->email,
            'phone' => $this->phone,
            'position_applied' => $this->positionApplied,
            'experience_years' => $this->experienceYears,
            'cover_letter' => $this->coverLetter,
            'cv_path' => $cvPath,
            'linkedin_url' => $this->linkedinUrl ?: null,
        ]);

        $this->submitted = true;
    }

    public function render(): View
    {
        return view('livewire.public.careers-page');
    }
}
