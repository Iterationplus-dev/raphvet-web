<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class UserList extends Component
{
    use WithPagination;

    public string $search = '';

    public string $roleFilter = 'all';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedRoleFilter(): void
    {
        $this->resetPage();
    }

    public function toggleActive(int $userId): void
    {
        $user = User::findOrFail($userId);
        abort_if($user->id === auth()->id(), 403, 'Cannot deactivate yourself');
        $user->update(['is_active' => ! $user->is_active]);
    }

    public function render(): View
    {
        $users = User::with('roles')
            ->when($this->search, fn ($q) => $q->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%");
            }))
            ->when($this->roleFilter !== 'all', fn ($q) => $q->whereHas('roles', fn ($q) => $q->where('name', $this->roleFilter)))
            ->latest()
            ->paginate(15);

        return view('livewire.admin.users.user-list', compact('users'));
    }
}
