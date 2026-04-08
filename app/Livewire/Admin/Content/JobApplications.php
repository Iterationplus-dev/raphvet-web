<?php

namespace App\Livewire\Admin\Content;

use App\Models\JobApplication;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class JobApplications extends Component
{
    use WithPagination;

    #[Url(as: 'status')]
    public string $filterStatus = '';

    #[Url(as: 'q')]
    public string $search = '';

    public ?int $viewingId = null;

    public string $adminNotes = '';

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function view(int $id): void
    {
        $application = JobApplication::findOrFail($id);
        $this->viewingId = $id;
        $this->adminNotes = $application->admin_notes ?? '';

        if ($application->status === 'new') {
            $application->update(['status' => 'reviewed']);
        }
    }

    public function closeView(): void
    {
        $this->viewingId = null;
        $this->adminNotes = '';
    }

    public function updateStatus(int $id, string $status): void
    {
        JobApplication::findOrFail($id)->update(['status' => $status]);

        if ($this->viewingId === $id) {
            // Refresh notes if viewing
        }

        session()->flash('success', 'Application status updated.');
    }

    public function saveNotes(): void
    {
        if (! $this->viewingId) {
            return;
        }

        JobApplication::findOrFail($this->viewingId)->update(['admin_notes' => $this->adminNotes]);
        session()->flash('success', 'Notes saved.');
    }

    public function render(): View
    {
        $applications = JobApplication::query()
            ->when($this->filterStatus, fn ($q) => $q->where('status', $this->filterStatus))
            ->when($this->search, fn ($q) => $q->where(function ($q): void {
                $q->where('full_name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%')
                    ->orWhere('position_applied', 'like', '%'.$this->search.'%');
            }))
            ->latest()
            ->paginate(15);

        $viewing = $this->viewingId ? JobApplication::find($this->viewingId) : null;

        return view('livewire.admin.content.job-applications', [
            'applications' => $applications,
            'viewing' => $viewing,
        ]);
    }
}
