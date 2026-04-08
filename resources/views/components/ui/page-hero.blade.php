@props(['centered' => true])

@php
    $heroImages = [
        'https://res.cloudinary.com/dhmt9seuf/image/upload/q_auto/f_auto/v1775576726/trnava-university-_9xRHrMOjeg-unsplash_al3vhu.jpg',
        'https://res.cloudinary.com/dhmt9seuf/image/upload/q_auto/f_auto/v1775576732/olabode-balogun-cX_YzM5X-SY-unsplash_cg3nci.jpg',
        'https://res.cloudinary.com/dhmt9seuf/image/upload/q_auto/f_auto/v1775576723/markus-winkler-PcKhVNNyEio-unsplash_wbfz7s.jpg',
        'https://res.cloudinary.com/dhmt9seuf/image/upload/q_auto/f_auto/v1775576721/zoe-richardson-XOGg38VufZs-unsplash_jk8ngc.jpg',
        'https://res.cloudinary.com/dhmt9seuf/image/upload/q_auto/f_auto/v1775576718/alexas_fotos-M-XLyLVMWVU-unsplash_odc7wd.jpg',
        'https://res.cloudinary.com/dhmt9seuf/image/upload/q_auto/f_auto/v1775576717/brooke-cagle-EenUxvVltMs-unsplash_svlrfp.jpg',
    ];
    $heroImage = $heroImages[array_rand($heroImages)];
@endphp

<section class="relative py-20 md:py-28 hero-gradient overflow-hidden">
    {{-- Random Cloudinary background image at low opacity --}}
    <div
        class="absolute inset-0 bg-cover bg-center pointer-events-none opacity-20"
        style="background-image: url('{{ $heroImage }}');"
    ></div>

    {{-- Decorative blobs --}}
    <div class="absolute top-0 left-0 w-72 h-72 bg-primary-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 bg-accent-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container-app relative z-10 {{ $centered ? 'text-center' : '' }}">
        {{ $slot }}
    </div>
</section>
