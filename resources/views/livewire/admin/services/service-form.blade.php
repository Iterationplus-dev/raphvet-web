<div class="mx-auto max-w-2xl space-y-5">

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-100 px-6 py-4">
            <h2 class="text-base font-semibold text-gray-900">{{ $serviceId ? 'Edit Service' : 'Create Service' }}</h2>
        </div>

        <form wire:submit="save" class="divide-y divide-gray-100">
            {{-- Basic Info --}}
            <div class="space-y-4 px-6 py-5">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Service Name</label>
                        <input type="text" wire:model.live="name" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500" placeholder="e.g. General Consultation"/>
                        @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Slug</label>
                        <div class="flex items-center rounded-lg border border-gray-300 focus-within:border-primary-500 focus-within:ring-1 focus-within:ring-primary-500">
                            <span class="border-r border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-500 rounded-l-lg">/services/</span>
                            <input type="text" wire:model="slug" class="flex-1 rounded-r-lg px-3 py-2 text-sm focus:outline-none" placeholder="general-consultation"/>
                        </div>
                        @error('slug') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Category</label>
                        <select wire:model="category" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
                            <option value="treatment">Treatment</option>
                            <option value="consultation">Consultation</option>
                            <option value="surgery">Surgery</option>
                            <option value="grooming">Grooming</option>
                            <option value="vaccination">Vaccination</option>
                            <option value="diagnostics">Diagnostics</option>
                            <option value="other">Other</option>
                        </select>
                        @error('category') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Sort Order</label>
                        <input type="number" wire:model="sortOrder" min="0" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"/>
                        @error('sortOrder') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Short Description</label>
                        <input type="text" wire:model="shortDescription" maxlength="500" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500" placeholder="Brief one-liner shown in cards"/>
                        @error('shortDescription') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Full Description</label>
                        <textarea wire:model="description" rows="5" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500" placeholder="Detailed service description…"></textarea>
                        @error('description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Active toggle --}}
                <div class="flex items-center justify-between rounded-lg border border-gray-200 px-4 py-3">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Active</p>
                        <p class="text-xs text-gray-500">Inactive services are hidden from the public site.</p>
                    </div>
                    <button type="button" wire:click="$toggle('isActive')" class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 {{ $isActive ? 'bg-primary-600' : 'bg-gray-200' }}">
                        <span class="inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 {{ $isActive ? 'translate-x-5' : 'translate-x-0' }}"></span>
                    </button>
                </div>
            </div>

            {{-- SEO --}}
            <div class="space-y-4 px-6 py-5">
                <h3 class="text-sm font-semibold text-gray-700">SEO</h3>
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Meta Title</label>
                    <input type="text" wire:model="metaTitle" maxlength="160" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"/>
                    @error('metaTitle') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Meta Description</label>
                    <textarea wire:model="metaDescription" rows="3" maxlength="320" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"></textarea>
                    @error('metaDescription') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 px-6 py-4">
                <a href="{{ route('admin.services') }}" wire:navigate class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-700">
                    {{ $serviceId ? 'Save Changes' : 'Create Service' }}
                </button>
            </div>
        </form>
    </div>
</div>
