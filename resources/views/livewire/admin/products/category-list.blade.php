<div class="space-y-4">
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-100 px-5 py-4">
            <h2 class="font-semibold text-gray-900">Product Categories</h2>
        </div>
        <ul class="divide-y divide-gray-100">
            @forelse($categories as $category)
                <li class="px-5 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $category->name }}</p>
                            <p class="text-sm text-gray-500">{{ $category->products_count }} {{ Str::plural('product', $category->products_count) }}</p>
                        </div>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $category->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    @if($category->children->isNotEmpty())
                        <ul class="mt-3 space-y-1 border-l-2 border-gray-100 pl-4">
                            @foreach($category->children as $child)
                                <li class="flex items-center justify-between py-1">
                                    <p class="text-sm text-gray-700">{{ $child->name }}</p>
                                    <span class="text-xs text-gray-400">{{ $child->products_count ?? 0 }} products</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @empty
                <li class="px-5 py-14 text-center">
                    <div class="flex flex-col items-center gap-3">
                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-blue-50">
                            <svg class="h-7 w-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-700">No categories found.</p>
                            <p class="mt-0.5 text-xs text-gray-400">Create your first product category to get started.</p>
                        </div>
                    </div>
                </li>
            @endforelse
        </ul>
    </div>
</div>
