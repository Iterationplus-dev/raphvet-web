<div class="space-y-4">

    {{-- Filter tabs --}}
    <div class="flex gap-1 rounded-lg border border-gray-200 bg-white p-1 shadow-sm w-fit">
        @foreach(['all' => 'All', 'unread' => 'Unread', 'read' => 'Read'] as $key => $label)
            <button
                wire:click="$set('filter', '{{ $key }}')"
                class="rounded-md px-4 py-1.5 text-sm font-medium transition-colors {{ $filter === $key ? 'bg-primary-600 text-white shadow' : 'text-gray-600 hover:bg-gray-100' }}"
            >
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- Submissions list --}}
    <div class="space-y-3">
        @forelse($submissions as $sub)
            <div
                x-data="{ open: false }"
                class="overflow-hidden rounded-xl border bg-white shadow-sm {{ $sub->is_read ? 'border-gray-200' : 'border-primary-300' }}"
            >
                {{-- Header row --}}
                <div
                    class="flex cursor-pointer items-center gap-4 px-5 py-4 {{ $sub->is_read ? '' : 'bg-primary-50' }}"
                    @click="open = !open"
                >
                    {{-- Unread dot --}}
                    <span class="h-2.5 w-2.5 shrink-0 rounded-full {{ $sub->is_read ? 'bg-transparent' : 'bg-primary-500' }}"></span>

                    <div class="flex-1 min-w-0">
                        <p class="truncate text-sm font-semibold text-gray-900 {{ $sub->is_read ? '' : 'text-primary-900' }}">
                            {{ $sub->subject ?? '(No Subject)' }}
                        </p>
                        <p class="text-xs text-gray-500">{{ $sub->name }} &mdash; {{ $sub->email }}</p>
                    </div>

                    <div class="flex items-center gap-3 shrink-0">
                        <span class="text-xs text-gray-400">{{ $sub->created_at->format('d M Y') }}</span>
                        <svg class="h-4 w-4 text-gray-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

                {{-- Expanded message --}}
                <div x-show="open" x-transition class="border-t border-gray-100 px-5 py-4 space-y-3">
                    @if($sub->phone)
                        <p class="text-xs text-gray-500">Phone: {{ $sub->phone }}</p>
                    @endif
                    <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $sub->message }}</p>
                    @if(!$sub->is_read)
                        <div class="pt-1">
                            <button wire:click="markRead({{ $sub->id }})" class="rounded-lg bg-primary-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-primary-700">
                                Mark as Read
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="rounded-xl border border-dashed border-gray-200 py-12 text-center text-sm text-gray-400">
                No submissions in this category.
            </div>
        @endforelse
    </div>

    @if($submissions->hasPages())
        <div>{{ $submissions->links() }}</div>
    @endif
</div>
