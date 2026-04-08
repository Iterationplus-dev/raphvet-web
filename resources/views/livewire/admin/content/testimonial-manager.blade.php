<div class="space-y-5">

    {{-- Add / Edit form --}}
    @if($showForm)
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <h3 class="mb-4 font-semibold text-gray-900">{{ $editingId ? 'Edit Testimonial' : 'Add Testimonial' }}</h3>
            <form wire:submit="save" class="space-y-4">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Author Name</label>
                        <input type="text" wire:model="authorName" maxlength="150" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"/>
                        @error('authorName') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Author Role</label>
                        <input type="text" wire:model="authorRole" maxlength="150" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500" placeholder="e.g. Pet Owner"/>
                        @error('authorRole') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Content</label>
                        <textarea wire:model="content" rows="4" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"></textarea>
                        @error('content') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Rating (1–5)</label>
                        <select wire:model="rating" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}">{{ $i }} star{{ $i !== 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Sort Order</label>
                        <input type="number" wire:model="sortOrder" min="0" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"/>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Avatar URL <span class="text-gray-400">(optional)</span></label>
                        <input type="url" wire:model="avatarUrl" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500" placeholder="https://…"/>
                        @error('avatarUrl') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" wire:model="isActive" class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500"/>
                    <span class="font-medium text-gray-700">Active (visible on site)</span>
                </label>
                <div class="flex gap-3">
                    <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-700">Save</button>
                    <button type="button" wire:click="cancelEdit" class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</button>
                </div>
            </form>
        </div>
    @else
        <div class="flex justify-end">
            <button wire:click="startCreate" class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Testimonial
            </button>
        </div>
    @endif

    {{-- Testimonial grid --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
        @forelse($testimonials as $testimonial)
            <div class="flex flex-col rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                {{-- Stars --}}
                <div class="mb-3 flex gap-0.5">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="h-4 w-4 {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    @endfor
                </div>

                <p class="flex-1 text-sm text-gray-700 italic">"{{ Str::limit($testimonial->content, 150) }}"</p>

                <div class="mt-4 flex items-center gap-3">
                    @if($testimonial->avatar)
                        <img src="{{ $testimonial->avatar }}" alt="{{ $testimonial->author_name }}" class="h-9 w-9 rounded-full object-cover"/>
                    @else
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary-100 text-sm font-bold text-primary-700">
                            {{ strtoupper(substr($testimonial->author_name, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <p class="text-sm font-semibold text-gray-900">{{ $testimonial->author_name }}</p>
                        @if($testimonial->author_role)
                            <p class="text-xs text-gray-500">{{ $testimonial->author_role }}</p>
                        @endif
                    </div>
                    <span class="ml-auto inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $testimonial->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                        {{ $testimonial->is_active ? 'Active' : 'Hidden' }}
                    </span>
                </div>

                <div class="mt-4 flex gap-2 border-t border-gray-100 pt-4">
                    <button wire:click="startEdit({{ $testimonial->id }})" class="flex-1 rounded-lg border border-gray-200 bg-white py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50">Edit</button>
                    <button wire:click="delete({{ $testimonial->id }})" wire:confirm="Delete this testimonial?" class="flex-1 rounded-lg border border-red-200 bg-white py-1.5 text-xs font-medium text-red-600 hover:bg-red-50">Delete</button>
                </div>
            </div>
        @empty
            <div class="col-span-3 rounded-xl border border-dashed border-gray-200 py-12 text-center text-sm text-gray-400">
                No testimonials yet.
            </div>
        @endforelse
    </div>

    @if($testimonials->hasPages())
        <div>{{ $testimonials->links() }}</div>
    @endif
</div>
