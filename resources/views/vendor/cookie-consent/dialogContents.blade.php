<div class="js-cookie-consent cookie-consent fixed bottom-0 inset-x-0 z-50">
    <div class="w-full bg-gray-900/95 backdrop-blur-md border-t border-white/10 px-4 py-3 md:py-4">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 max-w-screen-2xl mx-auto">
            <div class="flex items-start gap-3 flex-1">
                <svg class="w-5 h-5 text-primary-400 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 18a8 8 0 110-16 8 8 0 010 16zm-1-5h2v2h-2v-2zm0-8h2v6h-2V7z"/>
                </svg>
                <p class="text-sm text-gray-300 cookie-consent__message">
                    {!! trans('cookie-consent::texts.message') !!}
                </p>
            </div>
            <button class="js-cookie-consent-agree cookie-consent__agree shrink-0 inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-primary-600 hover:bg-primary-500 text-white text-sm font-semibold transition-colors cursor-pointer whitespace-nowrap">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                {{ trans('cookie-consent::texts.agree') }}
            </button>
        </div>
    </div>
</div>
