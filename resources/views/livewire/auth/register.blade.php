<div>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900">Create an Account</h2>
        <p class="mt-1 text-sm text-gray-500">Join Raph Vet to manage your pet's health.</p>
    </div>

    <form wire:submit="register" class="space-y-5">

        <!-- Full Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
            <input
                wire:model.blur="name"
                id="name"
                type="text"
                autocomplete="name"
                class="input w-full @error('name') border-red-500 focus:ring-red-500 @enderror"
                placeholder="John Doe"
                required
            >
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
            <input
                wire:model.blur="email"
                id="email"
                type="email"
                autocomplete="email"
                class="input w-full @error('email') border-red-500 focus:ring-red-500 @enderror"
                placeholder="you@example.com"
                required
            >
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Phone (optional) -->
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                Phone
                <span class="text-gray-400 font-normal">(optional)</span>
            </label>
            <input
                wire:model.blur="phone"
                id="phone"
                type="tel"
                autocomplete="tel"
                class="input w-full @error('phone') border-red-500 focus:ring-red-500 @enderror"
                placeholder="+234 800 000 0000"
            >
            @error('phone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <div class="relative" x-data="{ show: false }">
                <input
                    wire:model.blur="password"
                    id="password"
                    :type="show ? 'text' : 'password'"
                    autocomplete="new-password"
                    class="input w-full pr-10 @error('password') border-red-500 focus:ring-red-500 @enderror"
                    placeholder="Min. 8 characters"
                    required
                >
                <button
                    type="button"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600"
                    @click="show = !show"
                    :aria-label="show ? 'Hide password' : 'Show password'"
                >
                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
            <div class="relative" x-data="{ show: false }">
                <input
                    wire:model.blur="password_confirmation"
                    id="password_confirmation"
                    :type="show ? 'text' : 'password'"
                    autocomplete="new-password"
                    class="input w-full pr-10"
                    placeholder="Repeat your password"
                    required
                >
                <button
                    type="button"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600"
                    @click="show = !show"
                    :aria-label="show ? 'Hide password' : 'Show password'"
                >
                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Submit -->
        <button
            type="submit"
            class="btn btn-primary w-full justify-center py-2.5"
            wire:loading.attr="disabled"
            wire:loading.class="opacity-75"
        >
            <span wire:loading.remove>Create Account</span>
            <span wire:loading class="flex items-center gap-2">
                <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                </svg>
                Creating account…
            </span>
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600">
        Already have an account?
        <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-700">Sign in</a>
    </p>
</div>
