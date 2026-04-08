<div>
    {{-- Hero --}}
    <x-ui.page-hero>
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 text-primary-200 text-sm font-semibold mb-6 backdrop-blur-sm border border-white/20">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>
            Help Centre
        </span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-5">Frequently Asked Questions</h1>
        <p class="text-primary-100/90 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
            Find answers to common questions about our veterinary services, appointments, and pet care guidance.
        </p>
    </x-ui.page-hero>

    {{-- Filters & FAQs --}}
    <section class="py-16 md:py-20 bg-white">
        <div class="container-app">
            <div class="max-w-3xl mx-auto">
                {{-- Search --}}
                <div class="relative mb-8">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search questions..."
                        class="form-input pl-12 pr-4 py-3.5 text-base"
                    >
                    @if($search)
                        <button
                            wire:click="$set('search', '')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    @endif
                </div>

                {{-- Category pills --}}
                @if(count($this->categories) > 0)
                <div class="flex flex-wrap gap-2 mb-10">
                    <button
                        wire:click="$set('activeCategory', 'all')"
                        class="px-4 py-2 rounded-full text-sm font-semibold transition-all {{ $activeCategory === 'all' ? 'bg-primary-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-primary-50 hover:text-primary-700' }}"
                    >
                        All
                    </button>
                    @foreach($this->categories as $category)
                    <button
                        wire:click="$set('activeCategory', '{{ $category }}')"
                        class="px-4 py-2 rounded-full text-sm font-semibold transition-all {{ $activeCategory === $category ? 'bg-primary-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-primary-50 hover:text-primary-700' }}"
                    >
                        {{ $category }}
                    </button>
                    @endforeach
                </div>
                @endif

                {{-- FAQ Accordion --}}
                @php
                    $displayFaqs = $this->faqs->count() > 0 ? $this->faqs : collect([
                        (object)['id' => 1, 'question' => 'What types of animals do you treat?', 'answer' => 'We treat a wide range of animals including dogs, cats, rabbits, birds, reptiles, and large farm animals such as cattle, goats, sheep, and poultry. Our team is trained and experienced in handling both companion animals and livestock.', 'category' => 'General'],
                        (object)['id' => 2, 'question' => 'How do I book an appointment?', 'answer' => 'You can book an appointment through our online booking system available after creating an account. Simply log in, navigate to "Book Appointment," select your preferred service, date, and time. You can also call us directly or send us a WhatsApp message.', 'category' => 'Appointments'],
                        (object)['id' => 3, 'question' => 'Do you offer emergency veterinary services?', 'answer' => 'Yes, we offer emergency services for critical cases. Our emergency line is available 24/7. Please call our emergency number for immediate assistance. For non-urgent matters, we recommend booking a regular appointment during business hours.', 'category' => 'Services'],
                        (object)['id' => 4, 'question' => 'What vaccinations does my pet need?', 'answer' => 'Vaccination requirements vary by species and age. For dogs, core vaccines include Distemper, Parvovirus, and Rabies. For cats, we recommend FVRCP and Rabies vaccines. During your first visit, our vets will assess your pet and create a personalized vaccination schedule.', 'category' => 'Health & Care'],
                        (object)['id' => 5, 'question' => 'How much do your services cost?', 'answer' => 'Our pricing varies based on the type of service, complexity of treatment, and specific needs of your animal. We believe in transparent pricing and will always provide a clear cost estimate before proceeding with any treatment. Contact us or visit our clinic for a detailed price list.', 'category' => 'Pricing'],
                        (object)['id' => 6, 'question' => 'Can I access my pet\'s medical records online?', 'answer' => 'Yes! Through our digital pet health portal, you can access your pet\'s complete medical history, vaccination records, prescription history, and upcoming appointment details at any time. Simply create an account and register your pet to get started.', 'category' => 'Digital Services'],
                    ]);
                @endphp

                @if($displayFaqs->isEmpty())
                    <div class="text-center py-16">
                        <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <h3 class="font-semibold text-gray-700 mb-2">No results found</h3>
                        <p class="text-gray-400 text-sm">Try a different search term or browse all categories.</p>
                        <button wire:click="$set('search', '')" class="btn btn-secondary mt-4">Clear Search</button>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($displayFaqs as $index => $faq)
                        <div
                            x-data="{ open: {{ $index === 0 ? 'true' : 'false' }} }"
                            class="border border-gray-200 rounded-2xl overflow-hidden hover:border-primary-200 transition-colors"
                        >
                            <button
                                @click="open = !open"
                                class="w-full flex items-center justify-between gap-4 px-6 py-5 text-left bg-white hover:bg-gray-50 transition-colors"
                                :aria-expanded="open"
                            >
                                <span class="font-semibold text-gray-900 text-base leading-snug">{{ $faq->question }}</span>
                                <span class="shrink-0 w-6 h-6 rounded-full bg-primary-100 flex items-center justify-center transition-transform duration-300" :class="open ? 'rotate-180 bg-primary-600' : ''">
                                    <svg class="w-3.5 h-3.5 transition-colors" :class="open ? 'text-white' : 'text-primary-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </span>
                            </button>
                            <div
                                x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 -translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-1"
                                class="px-6 pb-5"
                            >
                                <div class="pt-1 border-t border-gray-100">
                                    <p class="text-gray-600 leading-relaxed pt-4">{{ $faq->answer }}</p>
                                    @if(isset($faq->category) && $faq->category)
                                        <span class="inline-block mt-3 px-3 py-1 rounded-full text-xs font-semibold bg-primary-50 text-primary-700">{{ $faq->category }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif

                {{-- Still have questions? --}}
                <div class="mt-14 text-center p-8 rounded-2xl bg-primary-50 border border-primary-100">
                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Still have questions?</h3>
                    <p class="text-gray-500 mb-6">Can't find what you're looking for? Our team is happy to help.</p>
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us</a>
                        <a href="{{ route('appointments.book') }}" class="btn btn-secondary">Book a Consultation</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
