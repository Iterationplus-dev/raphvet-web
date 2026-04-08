<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class UserForm extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $role = 'customer';

    public bool $isActive = true;

    public string $password = '';

    public ?int $userId = null;

    public function mount(?User $user = null): void
    {
        if ($user->exists) {
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->phone = $user->phone ?? '';
            $this->isActive = $user->is_active;
            $this->role = $user->roles->first()?->name ?? 'customer';
        }
    }

    public function save(): void
    {
        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email'.($this->userId ? ",{$this->userId}" : ''),
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,vet,customer',
            'isActive' => 'boolean',
        ];

        if (! $this->userId) {
            $rules['password'] = 'required|string|min:8';
        }

        $this->validate($rules);

        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            $user->update(['name' => $this->name, 'email' => $this->email, 'phone' => $this->phone, 'is_active' => $this->isActive]);
        } else {
            $user = User::create(['name' => $this->name, 'email' => $this->email, 'phone' => $this->phone, 'password' => $this->password, 'is_active' => $this->isActive]);
        }

        $user->syncRoles([$this->role]);

        session()->flash('success', 'User saved successfully.');
        $this->redirect(route('admin.users'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.users.user-form');
    }
}
