<div>
    {{-- Page header --}}
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-1">
            <a href="{{ route('my.pets') }}" class="text-sm text-gray-500 hover:text-gray-700 transition-colors">My Pets</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-sm text-gray-900 font-medium">
                {{ $isEditing ? 'Edit ' . $petTitle : 'Add New Pet' }}
            </span>
        </div>
        <h1 class="text-2xl font-bold text-gray-900">
            {{ $isEditing ? 'Edit ' . $petTitle : 'Add New Pet' }}
        </h1>
    </div>

    <form wire:submit="save" class="space-y-6">

        {{-- Section 1: Basic Info --}}
        <div class="rounded-2xl bg-white shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Basic Information</h2>
            </div>
            <div class="px-6 py-5 grid grid-cols-1 gap-5 sm:grid-cols-2">

                {{-- Name --}}
                <div class="sm:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Pet Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="name"
                           wire:model="name"
                           placeholder="e.g. Buddy"
                           class="block w-full rounded-lg border px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:ring-1 focus:ring-green-500 {{ $errors->has('name') ? 'border-red-500 bg-red-50 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}">
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Species --}}
                <div>
                    <label for="species" class="block text-sm font-medium text-gray-700 mb-1">
                        Species <span class="text-red-500">*</span>
                    </label>
                    <select id="species"
                            wire:model="species"
                            class="block w-full rounded-lg border px-3 py-2 text-sm text-gray-900 focus:ring-1 focus:ring-green-500 {{ $errors->has('species') ? 'border-red-500 bg-red-50 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}">
                        <option value="dog">Dog</option>
                        <option value="cat">Cat</option>
                        <option value="bird">Bird</option>
                        <option value="rabbit">Rabbit</option>
                        <option value="cattle">Cattle</option>
                        <option value="goat">Goat</option>
                        <option value="pig">Pig</option>
                        <option value="poultry">Poultry</option>
                        <option value="other">Other</option>
                    </select>
                    @error('species')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Breed --}}
                <div>
                    <label for="breed" class="block text-sm font-medium text-gray-700 mb-1">Breed</label>
                    <input type="text"
                           id="breed"
                           wire:model="breed"
                           placeholder="e.g. Labrador Retriever"
                           class="block w-full rounded-lg border px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:ring-1 focus:ring-green-500 {{ $errors->has('breed') ? 'border-red-500 bg-red-50 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}">
                    @error('breed')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Gender --}}
                <div class="sm:col-span-2">
                    <span class="block text-sm font-medium text-gray-700 mb-2">
                        Gender <span class="text-red-500">*</span>
                    </span>
                    <div class="flex flex-wrap gap-3">
                        <label class="flex items-center gap-2 cursor-pointer rounded-lg border px-4 py-2.5 text-sm font-medium transition-colors
                            {{ $gender === 'male' ? 'border-blue-500 bg-blue-50 text-blue-700' : 'border-gray-200 bg-white text-gray-700 hover:border-gray-300' }}">
                            <input type="radio" wire:model="gender" value="male" class="sr-only">
                            <span>♂</span>
                            <span>Male</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer rounded-lg border px-4 py-2.5 text-sm font-medium transition-colors
                            {{ $gender === 'female' ? 'border-pink-500 bg-pink-50 text-pink-700' : 'border-gray-200 bg-white text-gray-700 hover:border-gray-300' }}">
                            <input type="radio" wire:model="gender" value="female" class="sr-only">
                            <span>♀</span>
                            <span>Female</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer rounded-lg border px-4 py-2.5 text-sm font-medium transition-colors
                            {{ $gender === 'unknown' ? 'border-gray-400 bg-gray-100 text-gray-700' : 'border-gray-200 bg-white text-gray-700 hover:border-gray-300' }}">
                            <input type="radio" wire:model="gender" value="unknown" class="sr-only">
                            <span>?</span>
                            <span>Unknown</span>
                        </label>
                    </div>
                    @error('gender')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- Section 2: Health Details --}}
        <div class="rounded-2xl bg-white shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Health Details</h2>
            </div>
            <div class="px-6 py-5 grid grid-cols-1 gap-5 sm:grid-cols-2">

                {{-- Date of Birth --}}
                <div>
                    <label for="dateOfBirth" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                    <input type="date"
                           id="dateOfBirth"
                           wire:model="dateOfBirth"
                           max="{{ now()->format('Y-m-d') }}"
                           class="block w-full rounded-lg border px-3 py-2 text-sm text-gray-900 focus:ring-1 focus:ring-green-500 {{ $errors->has('dateOfBirth') ? 'border-red-500 bg-red-50 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}">
                    @error('dateOfBirth')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Weight --}}
                <div>
                    <label for="weightKg" class="block text-sm font-medium text-gray-700 mb-1">Weight (kg)</label>
                    <input type="number"
                           id="weightKg"
                           wire:model="weightKg"
                           step="0.1"
                           min="0.01"
                           max="9999"
                           placeholder="e.g. 12.5"
                           class="block w-full rounded-lg border px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:ring-1 focus:ring-green-500 {{ $errors->has('weightKg') ? 'border-red-500 bg-red-50 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}">
                    @error('weightKg')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Color / Markings --}}
                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Color / Markings</label>
                    <input type="text"
                           id="color"
                           wire:model="color"
                           placeholder="e.g. Black and white"
                           class="block w-full rounded-lg border px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:ring-1 focus:ring-green-500 {{ $errors->has('color') ? 'border-red-500 bg-red-50 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}">
                    @error('color')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Microchip Number --}}
                <div>
                    <label for="microchipNumber" class="block text-sm font-medium text-gray-700 mb-1">Microchip Number</label>
                    <input type="text"
                           id="microchipNumber"
                           wire:model="microchipNumber"
                           placeholder="e.g. 900123456789012"
                           class="block w-full rounded-lg border px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:ring-1 focus:ring-green-500 {{ $errors->has('microchipNumber') ? 'border-red-500 bg-red-50 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}">
                    @error('microchipNumber')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- Section 3: Notes --}}
        <div class="rounded-2xl bg-white shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Notes</h2>
            </div>
            <div class="px-6 py-5">
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Additional Notes</label>
                <textarea id="notes"
                          wire:model="notes"
                          rows="4"
                          placeholder="Any allergies, special conditions, or other notes about your pet..."
                          class="block w-full rounded-lg border px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:ring-1 focus:ring-green-500 {{ $errors->has('notes') ? 'border-red-500 bg-red-50 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}"></textarea>
                @error('notes')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Footer actions --}}
        <div class="flex items-center justify-between gap-4 pt-2">
            <a href="{{ route('my.pets') }}"
               class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">
                ← Cancel
            </a>
            <button type="submit"
                    class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 disabled:opacity-60 transition-colors">
                <svg wire:loading wire:target="save" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/>
                </svg>
                <span wire:loading.remove wire:target="save">
                    {{ $isEditing ? 'Save Changes' : 'Add Pet' }}
                </span>
                <span wire:loading wire:target="save">Saving…</span>
            </button>
        </div>

    </form>
</div>
