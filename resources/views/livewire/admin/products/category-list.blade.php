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
                <li class="px-5 py-10 text-center text-sm text-gray-400">No categories found.</li>
            @endforelse
        </ul>
    </div>
</div>
