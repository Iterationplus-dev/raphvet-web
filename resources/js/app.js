import './bootstrap';

// Alpine.js is bundled by Livewire — we only register plugins here.
// The plugins below are loaded from npm and handed to Alpine via the
// Livewire-provided global before it starts.

import mask from '@alpinejs/mask';
import focus from '@alpinejs/focus';
import morph from '@alpinejs/morph';
import intersect from '@alpinejs/intersect';
import 'swiper/css/bundle';
import 'flatpickr/dist/flatpickr.min.css';

import Swiper from 'swiper/bundle';
import flatpickr from 'flatpickr';

// Make Swiper & flatpickr globally available for inline scripts
window.Swiper = Swiper;
window.flatpickr = flatpickr;

// Register Alpine plugins once Alpine is available (Livewire triggers alpine:init)
document.addEventListener('alpine:init', () => {
    Alpine.plugin(mask);
    Alpine.plugin(focus);
    Alpine.plugin(morph);
    Alpine.plugin(intersect);
});
