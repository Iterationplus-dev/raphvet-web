<div>
    {{-- Hero --}}
    <x-ui.page-hero>
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 text-primary-200 text-sm font-semibold mb-6 backdrop-blur-sm border border-white/20">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
            Get In Touch
        </span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-5">Contact Us</h1>
        <p class="text-primary-100/90 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
            Have questions about our services? Need to schedule an appointment? We're here to help — reach out and we'll respond promptly.
        </p>
    </x-ui.page-hero>

    {{-- Main content --}}
    <section class="py-16 md:py-20 bg-white">
        <div class="container-app">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-12">

                {{-- Contact form (spans 3 cols) --}}
                <div class="lg:col-span-3">
                    @if($submitted)
                        {{-- Success state --}}
                        <div class="text-center py-16 px-8">
                            <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-3">Message Sent!</h2>
                            <p class="text-gray-500 text-lg mb-8 max-w-md mx-auto">Thank you for reaching out, {{ $name }}. We'll get back to you at {{ $email }} within 24 hours.</p>
                            <button wire:click="$set('submitted', false)" class="btn btn-primary">Send Another Message</button>
                        </div>
                    @else
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900">Send Us a Message</h2>
                            <p class="text-gray-500 mt-2">Fill out the form below and we'll respond within 24 hours.</p>
                        </div>

                        <form wire:submit="submit" class="space-y-5" novalidate>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                {{-- Name --}}
                                <div>
                                    <label for="name" class="form-label">Full Name <span class="required">*</span></label>
                                    <input
                                        type="text"
                                        id="name"
                                        wire:model="name"
                                        class="form-input @error('name') is-invalid @enderror"
                                        placeholder="Your full name"
                                        autocomplete="name"
                                    >
                                    @error('name') <p class="form-error">{{ $message }}</p> @enderror
                                </div>

                                {{-- Email --}}
                                <div>
                                    <label for="email" class="form-label">Email Address <span class="required">*</span></label>
                                    <input
                                        type="email"
                                        id="email"
                                        wire:model="email"
                                        class="form-input @error('email') is-invalid @enderror"
                                        placeholder="your@email.com"
                                        autocomplete="email"
                                    >
                                    @error('email') <p class="form-error">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                {{-- Phone --}}
                                <div>
                                    <label for="phone" class="form-label">Phone Number <span class="text-gray-400 font-normal">(optional)</span></label>
                                    <input
                                        type="tel"
                                        id="phone"
                                        wire:model="phone"
                                        class="form-input @error('phone') is-invalid @enderror"
                                        placeholder="+234 912 712 8206"
                                        autocomplete="tel"
                                    >
                                    @error('phone') <p class="form-error">{{ $message }}</p> @enderror
                                </div>

                                {{-- Subject --}}
                                <div>
                                    <label for="subject" class="form-label">Subject <span class="required">*</span></label>
                                    <input
                                        type="text"
                                        id="subject"
                                        wire:model="subject"
                                        class="form-input @error('subject') is-invalid @enderror"
                                        placeholder="How can we help?"
                                    >
                                    @error('subject') <p class="form-error">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            {{-- Message --}}
                            <div>
                                <label for="message" class="form-label">Message <span class="required">*</span></label>
                                <textarea
                                    id="message"
                                    wire:model="message"
                                    rows="6"
                                    class="form-input @error('message') is-invalid @enderror resize-none"
                                    placeholder="Tell us more about your enquiry... (minimum 20 characters)"
                                ></textarea>
                                @error('message') <p class="form-error">{{ $message }}</p> @enderror
                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary btn-lg w-full sm:w-auto"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-75"
                            >
                                <span wire:loading.remove wire:target="submit" class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    Send Message
                                </span>
                                <span wire:loading wire:target="submit" class="flex items-center gap-2">
                                    <span class="spinner w-4 h-4"></span>
                                    Sending...
                                </span>
                            </button>
                        </form>
                    @endif
                </div>

                {{-- Contact info sidebar (spans 2 cols) --}}
                <div class="lg:col-span-2 space-y-5">
                    {{-- Address --}}
                    <div class="card p-5 flex gap-4">
                        <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Our Location</h3>
                            <p class="text-gray-500 text-sm leading-relaxed">Raph Veterinary Services<br>No 10 Uche Street, Rumuola Link, Off Stadium Road,<br>Port Harcourt, Nigeria</p>
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="card p-5 flex gap-4">
                        <div class="w-10 h-10 bg-accent-100 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Phone</h3>
                            <p class="text-gray-500 text-sm">+234 912 712 8206</p>
                            <p class="text-gray-500 text-sm">Mon – Sat, 8am – 6pm</p>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="card p-5 flex gap-4">
                        <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                            <p class="text-gray-500 text-sm">info@raphvet.com</p>
                            <p class="text-gray-500 text-sm">We respond within 24 hours</p>
                        </div>
                    </div>

                    {{-- Hours --}}
                    <div class="card p-5 flex gap-4">
                        <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-2">Working Hours</h3>
                            <div class="space-y-1 text-sm text-gray-500">
                                <div class="flex justify-between gap-4">
                                    <span>Mon – Fri</span>
                                    <span class="font-medium text-gray-700">8:00 AM – 6:00 PM</span>
                                </div>
                                <div class="flex justify-between gap-4">
                                    <span>Saturday</span>
                                    <span class="font-medium text-gray-700">9:00 AM – 4:00 PM</span>
                                </div>
                                <div class="flex justify-between gap-4">
                                    <span>Sunday</span>
                                    <span class="font-medium text-red-500">Emergency Only</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Google Maps placeholder --}}
                    <div class="rounded-2xl overflow-hidden border border-gray-200 h-48 bg-gray-100 flex items-center justify-center">
                        <div class="text-center text-gray-400">
                            <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                            <div class="embed-map-fixed"><div class="embed-map-container"><iframe class="embed-map-frame" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&height=400&hl=en&q=No%2010%20Uche%20Street%2C%20Rumuola%20Link%2C%20Off%20Stadium%20Road%2C%20Port%20Harcourt%20City%2C%20Nigeria&t=p&z=17&ie=UTF8&iwloc=B&output=embed"></iframe><a href="https://sprunkiretake.net" style="font-size:2px!important;color:gray!important;position:absolute;bottom:0;left:0;z-index:1;max-height:1px;overflow:hidden">Sprunki</a></div><style>.embed-map-fixed{position:relative;text-align:right;width:600px;height:400px;}.embed-map-container{overflow:hidden;background:none!important;width:600px;height:400px;}.embed-map-frame{width:600px!important;height:400px!important;}</style></div>
                        </div>
                    </div>

                    {{-- WhatsApp CTA --}}
                    <div class="rounded-2xl bg-[#25D366]/10 border border-[#25D366]/30 p-5 flex items-center gap-4">
                        <div class="w-12 h-12 bg-[#25D366] rounded-full flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900 mb-0.5">Chat on WhatsApp</h3>
                            <p class="text-sm text-gray-500">Get instant answers from our team</p>
                        </div>
                        <a
                            href="https://wa.me/{{ config('services.whatsapp.number', '2349127128206') }}?text={{ urlencode('Hello! I would like to enquire about your veterinary services.') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-sm text-white font-semibold px-4 py-2 rounded-lg"
                            style="background-color: #25D366;"
                        >
                            Chat Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
