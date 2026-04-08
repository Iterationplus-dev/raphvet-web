<div class="space-y-4">

    {{-- Top bar --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-1 gap-3">
            <div class="relative max-w-xs flex-1">
                <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    wire:model.live.300ms="search"
                    placeholder="Search users..."
                    class="w-full rounded-lg border border-gray-300 py-2 pl-9 pr-3 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"
                />
            </div>
            <select wire:model.live="roleFilter" class="rounded-lg border border-gray-300 py-2 pl-3 pr-8 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
                <option value="all">All Roles</option>
                <option value="admin">Admin</option>
                <option value="vet">Vet</option>
                <option value="customer">Customer</option>
            </select>
        </div>
        <a href="{{ route('admin.users.create') }}" wire:navigate class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add User
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50 text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="px-5 py-3 text-left">User</th>
                        <th class="px-5 py-3 text-left">Role</th>
                        <th class="px-5 py-3 text-left">Pets</th>
                        <th class="px-5 py-3 text-left">Status</th>
                        <th class="px-5 py-3 text-left">Joined</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-primary-100 text-sm font-bold text-primary-700">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3">
                                @foreach($user->roles as $role)
                                    @php
                                        $roleColors = [
                                            'admin'    => 'bg-red-100 text-red-700',
                                            'vet'      => 'bg-purple-100 text-purple-700',
                                            'customer' => 'bg-blue-100 text-blue-700',
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $roleColors[$role->name] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ ucfirst($role->name) }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-700">{{ $user->pets()->count() }}</td>
                            <td class="px-5 py-3">
                                <button
                                    wire:click="toggleActive({{ $user->id }})"
                                    class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium transition-colors {{ $user->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full {{ $user->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-5 py-3 text-right">
                                <a href="{{ route('admin.users.edit', $user) }}" wire:navigate class="inline-flex items-center gap-1 rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-sm text-gray-400">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="border-t border-gray-100 px-5 py-3">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
