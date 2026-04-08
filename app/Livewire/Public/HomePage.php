<?php

namespace App\Livewire\Public;

use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class HomePage extends Component
{
    /** @var Collection<int, Testimonial> */
    public Collection $testimonials;

    /** @var Collection<int, Service> */
    public Collection $featuredServices;

    public function mount(): void
    {
        $this->testimonials = Testimonial::active()->take(6)->get();
        $this->featuredServices = Service::active()->take(4)->get();
    }

    public function render(): View
    {
        return view('livewire.public.home-page');
    }
}
