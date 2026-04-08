<div class="space-y-4">

    {{-- Top bar --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="relative max-w-xs flex-1">
            <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" wire:model.live.300ms="search" placeholder="Search services..." class="w-full rounded-lg border border-gray-300 py-2 pl-9 pr-3 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"/>
        </div>
        <a href="{{ route('admin.services.create') }}" wire:navigate class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Service
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50 text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="px-5 py-3 text-left">Name</th>
                        <th class="px-5 py-3 text-left">Category</th>
                        <th class="px-5 py-3 text-left">Appointments</th>
                        <th class="px-5 py-3 text-left">Sort</th>
                        <th class="px-5 py-3 text-left">Status</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($services as $service)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3">
                                <p class="text-sm font-semibold text-gray-900">{{ $service->name }}</p>
                                <p class="text-xs text-gray-400">/services/{{ $service->slug }}</p>
                            </td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center rounded-full bg-indigo-100 px-2 py-0.5 text-xs font-medium text-indigo-700">
                                    {{ ucfirst($service->category ?? '—') }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-700">{{ number_format($service->appointments_count) }}</td>
                            <td class="px-5 py-3 text-sm text-gray-700">{{ $service->sort_order }}</td>
                            <td class="px-5 py-3">
                                <button wire:click="toggleActive({{ $service->id }})" class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium transition-colors {{ $service->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $service->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                    {{ $service->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="px-5 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.services.edit', $service) }}" wire:navigate class="rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50">Edit</a>
                                    <button wire:click="delete({{ $service->id }})" wire:confirm="Delete this service?" class="rounded-lg border border-red-200 bg-white px-3 py-1.5 text-xs font-medium text-red-600 shadow-sm hover:bg-red-50">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-sm text-gray-400">No services found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($services->hasPages())
            <div class="border-t border-gray-100 px-5 py-3">{{ $services->links() }}</div>
        @endif
    </div>
</div>
