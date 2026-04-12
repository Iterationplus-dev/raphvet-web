{{-- JSON-LD: Product Schema --}}
@push('scripts')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Product",
    "name": "{{ $product->name }}",
    "description": "{{ $product->meta_description ?: $product->short_description ?: $product->name }}",
    "sku": "{{ $product->sku }}",
    "url": "{{ route('shop.show', $product->slug) }}",
    @if($product->primaryImage)
    "image": "{{ $product->primaryImage->url }}",
    @endif
    "brand": {
        "@@type": "Brand",
        "name": "Raph Veterinary Services"
    },
    "offers": {
        "@@type": "Offer",
        "priceCurrency": "NGN",
        "price": "{{ $product->price }}",
        "availability": "{{ $product->isInStock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
        "url": "{{ route('shop.show', $product->slug) }}",
        "seller": {
            "@@type": "Organization",
            "name": "Raph Veterinary Services"
        }
    }
}
</script>
@endpush

<div
    @notify.window="
        const type = $event.detail.type ?? $event.detail[0]?.type;
        const message = $event.detail.message ?? $event.detail[0]?.message;
        if (window.toast) { window.toast(type, message); }
    "
>
    <div class="container-app py-8">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
            <a href="{{ route('shop') }}" class="hover:text-green-700">Shop</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            @if($product->category)
                <span>{{ $product->category->name }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            @endif
            <span class="text-gray-900 font-medium">{{ $product->name }}</span>
        </nav>

        {{-- Main product section --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-16">

            {{-- Images --}}
            <div>
                {{-- Main image --}}
                <div class="rounded-2xl overflow-hidden bg-gray-100 aspect-square mb-4">
                    @if($product->images->isNotEmpty())
                        @php $displayImage = $product->images->get($selectedImageIndex) ?? $product->images->first(); @endphp
                        <img src="{{ asset('storage/'.$displayImage->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        @php
                            $typeColors = ['food' => 'from-amber-400 to-orange-500', 'accessory' => 'from-blue-400 to-blue-600', 'medication' => 'from-red-400 to-red-600', 'supplement' => 'from-purple-400 to-purple-600', 'other' => 'from-gray-400 to-gray-600'];
                            $gradient = $typeColors[$product->type] ?? 'from-green-400 to-green-600';
                        @endphp
                        <div class="w-full h-full bg-linear-to-br {{ $gradient }} flex items-center justify-center">
                            <svg class="w-32 h-32 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                    @endif
                </div>

                {{-- Thumbnails --}}
                @if($product->images->count() > 1)
                    <div class="flex gap-3 overflow-x-auto pb-2">
                        @foreach($product->images as $index => $image)
                            <button
                                wire:click="selectImage({{ $index }})"
                                class="shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 transition-colors {{ $selectedImageIndex === $index ? 'border-green-500' : 'border-gray-200 hover:border-green-300' }}"
                            >
                                <img src="{{ asset('storage/'.$image->image_path) }}" alt="" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Product info --}}
            <div>
                @if($product->category)
                    <span class="badge badge-green mb-3">{{ $product->category->name }}</span>
                @endif

                <h1 class="text-3xl font-bold text-gray-900 mb-3">{{ $product->name }}</h1>

                {{-- Price --}}
                <div class="flex items-baseline gap-3 mb-4">
                    <span class="text-3xl font-bold text-green-700">₦{{ number_format((float) $product->price, 2) }}</span>
                    @if($product->compare_at_price && $product->compare_at_price > $product->price)
                        <span class="text-xl text-gray-400 line-through">₦{{ number_format((float) $product->compare_at_price, 2) }}</span>
                        @php $saving = round((($product->compare_at_price - $product->price) / $product->compare_at_price) * 100); @endphp
                        <span class="badge badge-red">Save {{ $saving }}%</span>
                    @endif
                </div>

                {{-- Stock status --}}
                <div class="flex flex-wrap gap-2 mb-4">
                    @if($product->isInStock())
                        <span class="badge badge-green">
                            <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            In Stock
                        </span>
                    @else
                        <span class="badge badge-red">Out of Stock</span>
                    @endif
                    @if($product->type)
                        <span class="badge badge-gray capitalize">{{ $product->type }}</span>
                    @endif
                </div>

                {{-- Short description --}}
                @if($product->short_description)
                    <p class="text-gray-600 mb-6 leading-relaxed">{{ $product->short_description }}</p>
                @endif

                {{-- Prescription warning --}}
                @if($product->requires_prescription)
                    <div class="alert alert-warning mb-5">
                        <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        <span><strong>Prescription Required:</strong> This product requires a valid veterinary prescription. Please ensure you have a prescription before purchasing.</span>
                    </div>
                @endif

                {{-- Variants --}}
                @if($product->variants->isNotEmpty())
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Option</label>
                        <div class="flex flex-wrap gap-2">
                            <button
                                wire:click="$set('selectedVariantId', null)"
                                class="px-4 py-2 rounded-lg border text-sm font-medium transition-colors {{ is_null($selectedVariantId) ? 'border-green-600 bg-green-50 text-green-700' : 'border-gray-300 text-gray-600 hover:border-green-400' }}"
                            >
                                Default
                            </button>
                            @foreach($product->variants as $variant)
                                <button
                                    wire:click="$set('selectedVariantId', {{ $variant->id }})"
                                    class="px-4 py-2 rounded-lg border text-sm font-medium transition-colors {{ $selectedVariantId === $variant->id ? 'border-green-600 bg-green-50 text-green-700' : 'border-gray-300 text-gray-600 hover:border-green-400' }}"
                                >
                                    {{ $variant->name }}
                                    @if($variant->price_modifier != 0)
                                        ({{ $variant->price_modifier > 0 ? '+' : '' }}₦{{ number_format((float) $variant->price_modifier, 2) }})
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Quantity + Add to Cart --}}
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                        <button wire:click="decrementQuantity" class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                        </button>
                        <span class="w-12 text-center text-sm font-semibold text-gray-900">{{ $quantity }}</span>
                        <button wire:click="incrementQuantity" class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </button>
                    </div>
                    <button
                        wire:click="addToCart"
                        wire:loading.attr="disabled"
                        @disabled(!$product->isInStock())
                        class="btn btn-primary btn-lg flex-1"
                    >
                        <span wire:loading.remove wire:target="addToCart">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            @if($product->isInStock()) Add to Cart @else Out of Stock @endif
                        </span>
                        <span wire:loading wire:target="addToCart">Adding...</span>
                    </button>
                </div>

                @if($product->sku)
                    <p class="text-xs text-gray-400">SKU: {{ $product->sku }}</p>
                @endif
            </div>
        </div>

        {{-- Description tabs --}}
        <div class="mb-16" x-data="{ activeTab: 'description' }">
            <div class="border-b border-gray-200 mb-6">
                <div class="flex gap-6">
                    <button
                        @click="activeTab = 'description'"
                        :class="activeTab === 'description' ? 'border-b-2 border-green-600 text-green-700 font-semibold' : 'text-gray-500 hover:text-gray-700'"
                        class="py-3 text-sm transition-colors"
                    >Description</button>
                    <button
                        @click="activeTab = 'features'"
                        :class="activeTab === 'features' ? 'border-b-2 border-green-600 text-green-700 font-semibold' : 'text-gray-500 hover:text-gray-700'"
                        class="py-3 text-sm transition-colors"
                    >Features</button>
                </div>
            </div>

            <div x-show="activeTab === 'description'" class="prose max-w-none text-gray-700">
                {!! nl2br(e($product->description ?? 'No description available.')) !!}
            </div>

            <div x-show="activeTab === 'features'" class="space-y-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    @if($product->type)
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                            <span class="font-medium text-gray-700 w-32">Type:</span>
                            <span class="text-gray-600 capitalize">{{ $product->type }}</span>
                        </div>
                    @endif
                    @if($product->weight_kg)
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                            <span class="font-medium text-gray-700 w-32">Weight:</span>
                            <span class="text-gray-600">{{ $product->weight_kg }} kg</span>
                        </div>
                    @endif
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <span class="font-medium text-gray-700 w-32">Stock Tracking:</span>
                        <span class="text-gray-600">{{ $product->track_stock ? 'Yes' : 'No' }}</span>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <span class="font-medium text-gray-700 w-32">Prescription:</span>
                        <span class="text-gray-600">{{ $product->requires_prescription ? 'Required' : 'Not required' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Products --}}
        @if($relatedProducts->isNotEmpty())
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Products</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                    @foreach($relatedProducts as $related)
                        @php
                            $typeColors = ['food' => 'from-amber-400 to-orange-500', 'accessory' => 'from-blue-400 to-blue-600', 'medication' => 'from-red-400 to-red-600', 'supplement' => 'from-purple-400 to-purple-600', 'other' => 'from-gray-400 to-gray-600'];
                            $relGradient = $typeColors[$related->type] ?? 'from-green-400 to-green-600';
                        @endphp
                        <a href="{{ route('shop.show', $related->slug) }}" class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-md transition-shadow block">
                            @if($related->primaryImage)
                                <img src="{{ asset('storage/'.$related->primaryImage->image_path) }}" alt="{{ $related->name }}" class="w-full aspect-square object-cover">
                            @else
                                <div class="w-full aspect-square bg-linear-to-br {{ $relGradient }} flex items-center justify-center">
                                    <svg class="w-12 h-12 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                </div>
                            @endif
                            <div class="p-3">
                                <p class="font-medium text-gray-900 text-sm line-clamp-2 mb-1">{{ $related->name }}</p>
                                <p class="font-bold text-green-700 text-sm">₦{{ number_format((float) $related->price, 2) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
