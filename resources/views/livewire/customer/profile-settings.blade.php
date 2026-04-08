<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Profile Settings</h1>
        <p class="text-gray-500 mt-1">Manage your account information and password.</p>
    </div>

    <div class="space-y-6 max-w-2xl">

        {{-- Profile information --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-5">Profile Information</h2>

            @if($profileSaved)
                <div class="alert alert-success mb-5">
                    <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                    <span>Profile updated successfully.</span>
                </div>
            @endif

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                    <input
                        wire:model="name"
                        type="text"
                        class="w-full rounded-lg border px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 {{ $errors->has('name') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}"
                    >
                    @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                    <input
                        wire:model="email"
                        type="email"
                        class="w-full rounded-lg border px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 {{ $errors->has('email') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}"
                    >
                    @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input
                        wire:model="phone"
                        type="tel"
                        class="w-full rounded-lg border px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 {{ $errors->has('phone') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}"
                        placeholder="+234..."
                    >
                    @error('phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp Number</label>
                    <input
                        wire:model="whatsappNumber"
                        type="tel"
                        class="w-full rounded-lg border px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 {{ $errors->has('whatsappNumber') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}"
                        placeholder="+234... (if different from phone)"
                    >
                    @error('whatsappNumber') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-5 pt-5 border-t border-gray-200">
                <button
                    wire:click="updateProfile"
                    wire:loading.attr="disabled"
                    class="btn btn-primary"
                >
                    <span wire:loading.remove wire:target="updateProfile">Save Changes</span>
                    <span wire:loading wire:target="updateProfile">Saving...</span>
                </button>
            </div>
        </div>

        {{-- Change password --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-5">Change Password</h2>

            @if($passwordSaved)
                <div class="alert alert-success mb-5">
                    <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                    <span>Password updated successfully.</span>
                </div>
            @endif

            @if($passwordError)
                <div class="alert alert-error mb-5">
                    <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"/></svg>
                    <span>{{ $passwordError }}</span>
                </div>
            @endif

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Password <span class="text-red-500">*</span></label>
                    <input
                        wire:model="currentPassword"
                        type="password"
                        class="w-full rounded-lg border px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 {{ $errors->has('currentPassword') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}"
                        autocomplete="current-password"
                    >
                    @error('currentPassword') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">New Password <span class="text-red-500">*</span></label>
                    <input
                        wire:model="newPassword"
                        type="password"
                        class="w-full rounded-lg border px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 {{ $errors->has('newPassword') ? 'border-red-500 focus:border-red-500' : 'border-gray-300 focus:border-green-500' }}"
                        autocomplete="new-password"
                    >
                    @error('newPassword') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    <p class="mt-1 text-xs text-gray-400">Minimum 8 characters.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password <span class="text-red-500">*</span></label>
                    <input
                        wire:model="newPasswordConfirmation"
                        type="password"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500"
                        autocomplete="new-password"
                    >
                </div>
            </div>

            <div class="mt-5 pt-5 border-t border-gray-200">
                <button
                    wire:click="updatePassword"
                    wire:loading.attr="disabled"
                    class="btn btn-primary"
                >
                    <span wire:loading.remove wire:target="updatePassword">Update Password</span>
                    <span wire:loading wire:target="updatePassword">Updating...</span>
                </button>
            </div>
        </div>

    </div>
</div>
