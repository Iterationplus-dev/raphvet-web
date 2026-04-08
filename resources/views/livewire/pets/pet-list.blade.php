<div>
    {{-- Page header --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">My Pets</h1>
            <p class="text-sm text-gray-500 mt-1">Manage your animals and their health records.</p>
        </div>
        <a href="{{ route('my.pets.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Pet
        </a>
    </div>

    @if ($pets->isEmpty())
        {{-- Empty state --}}
        <div class="flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-gray-200 bg-white py-16 px-8 text-center">
            <svg class="w-16 h-16 text-gray-300 mb-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4.5 11a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm15 0a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zM7 14.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm10 0a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zM12 20a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/>
            </svg>
            <h3 class="text-lg font-semibold text-gray-900 mb-1">No pets added yet</h3>
            <p class="text-sm text-gray-500 mb-6">Add your first pet to start tracking health records and appointments.</p>
            <a href="{{ route('my.pets.create') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-green-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add your first pet
            </a>
        </div>
    @else
        {{-- Pet grid --}}
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($pets as $pet)
                @php
                    $avatarColors = match($pet->species) {
                        'dog'    => 'bg-blue-100 text-blue-700',
                        'cat'    => 'bg-purple-100 text-purple-700',
                        'bird'   => 'bg-yellow-100 text-yellow-700',
                        'cattle' => 'bg-green-100 text-green-700',
                        default  => 'bg-gray-100 text-gray-700',
                    };
                @endphp

                <div class="group flex flex-col rounded-2xl bg-white shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                    <div class="flex items-center gap-4 p-5 border-b border-gray-50">
                        {{-- Avatar --}}
                        <div class="shrink-0 w-12 h-12 rounded-full {{ $avatarColors }} flex items-center justify-center text-xl font-bold uppercase">
                            {{ mb_substr($pet->name, 0, 1) }}
                        </div>

                        <div class="min-w-0 flex-1">
                            <h3 class="text-base font-bold text-gray-900 truncate">{{ $pet->name }}</h3>
                            <p class="text-sm text-gray-500 capitalize">
                                {{ ucfirst($pet->species) }}
                                &middot;
                                {{ $pet->breed ?: 'Mixed' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 px-5 py-3 text-sm text-gray-600">
                        {{-- Age badge --}}
                        <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-700">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $pet->age ?? 'Unknown' }}
                        </span>

                        @if ($pet->weight_kg)
                            <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-700">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                                </svg>
                                {{ $pet->weight_kg }} kg
                            </span>
                        @endif
                    </div>

                    <div class="flex gap-2 px-5 pb-5 mt-auto">
                        <a href="{{ route('my.pets.show', $pet) }}"
                           class="flex-1 text-center rounded-lg bg-green-50 px-3 py-2 text-sm font-medium text-green-700 hover:bg-green-100 transition-colors">
                            View Profile
                        </a>
                        <a href="{{ route('my.pets.edit', $pet) }}"
                           class="flex-1 text-center rounded-lg bg-gray-50 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">
                            Edit
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if ($pets->hasPages())
            <div class="mt-8">
                {{ $pets->links() }}
            </div>
        @endif
    @endif
</div>
