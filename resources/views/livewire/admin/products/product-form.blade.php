<div class="mx-auto max-w-3xl" x-data="{ tab: $wire.entangle('activeTab') }">
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-100 px-6 py-4">
            <h2 class="text-base font-semibold text-gray-900">{{ $productId ? 'Edit Product' : 'Create Product' }}</h2>
        </div>

        {{-- Tabs --}}
        <div class="flex border-b border-gray-200 bg-gray-50">
            @foreach(['basic' => 'Basic Info', 'pricing' => 'Pricing & Inventory', 'description' => 'Description', 'seo' => 'SEO'] as $key => $label)
                <button type="button" @click="tab = '{{ $key }}'" class="px-5 py-3 text-sm font-medium transition-colors" :class="tab === '{{ $key }}' ? 'border-b-2 border-primary-600 text-primary-700 bg-white' : 'text-gray-500 hover:text-gray-700'">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        <form wire:submit="save">
            {{-- Basic Info --}}
            <div x-show="tab === 'basic'" class="space-y-4 px-6 py-5">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" wire:model.live="name" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"/>
                        @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">SKU</label>
                        <input type="text" wire:model="sku" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500" placeholder="Optional"/>
                        @error('sku') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Slug</label>
                        <input type="text" wire:model="slug" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"/>
                        @error('slug') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Category</label>
                        <select wire:model="categoryId" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
                            <option value="">— No category —</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('categoryId') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Type</label>
                        <select wire:model="type" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
                            <option value="food">Food</option>
                            <option value="medicine">Medicine</option>
                            <option value="accessory">Accessory</option>
                            <option value="supplement">Supplement</option>
                            <option value="grooming">Grooming</option>
                            <option value="other">Other</option>
                        </select>
                        @error('type') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="flex flex-wrap gap-6">
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" wire:model="isActive" class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500"/>
                        <span class="font-medium text-gray-700">Active</span>
                    </label>
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" wire:model="isFeatured" class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500"/>
                        <span class="font-medium text-gray-700">Featured</span>
                    </label>
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" wire:model="requiresPrescription" class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500"/>
                        <span class="font-medium text-gray-700">Requires Prescription</span>
                    </label>
                </div>
            </div>

            {{-- Pricing & Inventory --}}
            <div x-show="tab === 'pricing'" class="space-y-4 px-6 py-5">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Price (&#8358;)</label>
                        <input type="number" wire:model="price" step="0.01" min="0" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500" placeholder="0.00"/>
                        @error('price') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Compare At Price (&#8358;)</label>
                        <input type="number" wire:model="compareAtPrice" step="0.01" min="0" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500" placeholder="Optional"/>
                        @error('compareAtPrice') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Stock Quantity</label>
                        <input type="number" wire:model="stockQuantity" min="0" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500"/>
                        @error('stockQuantity') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Description --}}
            <div x-show="tab === 'description'" class="space-y-4 px-6 py-5">
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Short Description</label>
                    <input type="text" wire:model="shortDescription" maxlength="500" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500" placeholder="Brief summary shown in product cards"/>
                    @error('shortDescription') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Full Description</label>
                    <textarea wire:model="description" rows="8" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500" placeholder="Detailed product description…"></textarea>
                    @error('description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- SEO --}}
            <div x-show="tab === 'seo'" class="space-y-4 px-6 py-5">
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
            <div class="flex items-center justify-end gap-3 border-t border-gray-100 px-6 py-4">
                <a href="{{ route('admin.products') }}" wire:navigate class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-700">
                    {{ $productId ? 'Save Changes' : 'Create Product' }}
                </button>
            </div>
        </form>
    </div>
</div>
