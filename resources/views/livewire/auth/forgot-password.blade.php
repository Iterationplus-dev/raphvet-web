<div>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900">Forgot Password?</h2>
        <p class="mt-1 text-sm text-gray-500">Enter your email and we'll send you a reset link.</p>
    </div>

    @if ($status)
        <div class="mb-5 rounded-lg bg-green-50 border border-green-200 p-4 flex gap-3 items-start text-sm text-green-800">
            <svg class="w-5 h-5 shrink-0 mt-0.5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/>
            </svg>
            <span>{{ $status }}</span>
        </div>
    @endif

    <form wire:submit="sendResetLink" class="space-y-5">

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

        <button
            type="submit"
            class="btn btn-primary w-full justify-center py-2.5"
            wire:loading.attr="disabled"
            wire:loading.class="opacity-75"
        >
            <span wire:loading.remove>Send Reset Link</span>
            <span wire:loading class="flex items-center gap-2">
                <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                </svg>
                Sending…
            </span>
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600">
        Remembered your password?
        <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-700">Sign in</a>
    </p>
</div>
