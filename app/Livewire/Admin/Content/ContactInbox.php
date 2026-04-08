<?php

namespace App\Livewire\Admin\Content;

use App\Models\ContactSubmission;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class ContactInbox extends Component
{
    use WithPagination;

    public string $filter = 'all';

    public function updatedFilter(): void
    {
        $this->resetPage();
    }

    public function markRead(int $id): void
    {
        ContactSubmission::findOrFail($id)->update(['is_read' => true]);
    }

    public function render(): View
    {
        $submissions = ContactSubmission::query()
            ->when($this->filter === 'unread', fn ($q) => $q->where('is_read', false))
            ->when($this->filter === 'read', fn ($q) => $q->where('is_read', true))
            ->latest()
            ->paginate(20);

        return view('livewire.admin.content.contact-inbox', compact('submissions'));
    }
}
