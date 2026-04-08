<div class="mx-auto max-w-2xl">
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-100 px-6 py-4">
            <h2 class="text-base font-semibold text-gray-900">{{ $userId ? 'Edit User' : 'Create User' }}</h2>
        </div>
        <form wire:submit="save" class="divide-y divide-gray-100">
            <div class="space-y-4 px-6 py-5">
                {{-- Name --}}
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" wire:model="name" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500 @error('name') border-red-500 @enderror" placeholder="John Doe"/>
                    @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" wire:model="email" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500 @error('email') border-red-500 @enderror" placeholder="john@example.com"/>
                    @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Phone --}}
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Phone <span class="text-gray-400">(optional)</span></label>
                    <input type="text" wire:model="phone" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500 @error('phone') border-red-500 @enderror" placeholder="+234 800 000 0000"/>
                    @error('phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Role --}}
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Role</label>
                    <select wire:model="role" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500 @error('role') border-red-500 @enderror">
                        <option value="customer">Customer</option>
                        <option value="vet">Vet</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Password (only for new users) --}}
                @if(!$userId)
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" wire:model="password" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500 @error('password') border-red-500 @enderror" placeholder="Minimum 8 characters"/>
                        @error('password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                @endif

                {{-- Active toggle --}}
                <div class="flex items-center justify-between rounded-lg border border-gray-200 px-4 py-3">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Active Account</p>
                        <p class="text-xs text-gray-500">Inactive users cannot log in.</p>
                    </div>
                    <button
                        type="button"
                        wire:click="$toggle('isActive')"
                        class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 {{ $isActive ? 'bg-primary-600' : 'bg-gray-200' }}"
                    >
                        <span class="inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 {{ $isActive ? 'translate-x-5' : 'translate-x-0' }}"></span>
                    </button>
                </div>
            </div>

            {{-- Form actions --}}
            <div class="flex items-center justify-end gap-3 px-6 py-4">
                <a href="{{ route('admin.users') }}" wire:navigate class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-700">
                    {{ $userId ? 'Save Changes' : 'Create User' }}
                </button>
            </div>
        </form>
    </div>
</div>
