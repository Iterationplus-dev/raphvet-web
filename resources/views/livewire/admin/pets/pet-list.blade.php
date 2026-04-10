<div class="space-y-4">

    {{-- Search bar --}}
    <div class="relative max-w-sm">
        <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <input type="text" wire:model.live.300ms="search" placeholder="Search pet or owner name…" class="w-full rounded-lg border border-gray-300 py-2 pl-9 pr-3 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"/>
    </div>

    {{-- Table --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50 text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="px-5 py-3 text-left">Pet Name</th>
                        <th class="px-5 py-3 text-left">Species</th>
                        <th class="px-5 py-3 text-left">Breed</th>
                        <th class="px-5 py-3 text-left">Owner</th>
                        <th class="px-5 py-3 text-left">Registered</th>
                        <th class="px-5 py-3 text-right">Owner Link</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pets as $pet)
                        @php
                            $speciesColors = [
                                'dog'    => 'bg-amber-100 text-amber-700',
                                'cat'    => 'bg-purple-100 text-purple-700',
                                'bird'   => 'bg-sky-100 text-sky-700',
                                'rabbit' => 'bg-pink-100 text-pink-700',
                            ];
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3">
                                <p class="text-sm font-semibold text-gray-900">{{ $pet->name }}</p>
                                @if($pet->microchip_number)
                                    <p class="text-xs text-gray-400">Chip: {{ $pet->microchip_number }}</p>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $speciesColors[strtolower($pet->species ?? '')] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($pet->species ?? '—') }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-700">{{ $pet->breed ?? '—' }}</td>
                            <td class="px-5 py-3">
                                @if($pet->owner)
                                    <p class="text-sm font-medium text-gray-900">{{ $pet->owner->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $pet->owner->email }}</p>
                                @else
                                    <span class="text-sm text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-500">{{ $pet->created_at->format('d M Y') }}</td>
                            <td class="px-5 py-3 text-right">
                                @if($pet->owner)
                                    <a href="{{ route('admin.users.edit', $pet->owner) }}" wire:navigate class="rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                                        View Owner
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-14 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-pink-50">
                                        <svg class="h-7 w-7 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-700">No pets found.</p>
                                        <p class="mt-0.5 text-xs text-gray-400">Try searching by a different pet or owner name.</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pets->hasPages())
            <div class="border-t border-gray-100 px-5 py-3">{{ $pets->links() }}</div>
        @endif
    </div>
</div>
