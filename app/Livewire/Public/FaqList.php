<?php

namespace App\Livewire\Public;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class FaqList extends Component
{
    public string $search = '';

    public string $activeCategory = 'all';

    /** @return array<int, string> */
    #[Computed]
    public function categories(): array
    {
        return Faq::query()
            ->where('is_active', true)
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category')
            ->toArray();
    }

    /** @return Collection<int, Faq> */
    #[Computed]
    public function faqs(): Collection
    {
        return Faq::active()
            ->when($this->activeCategory !== 'all', fn ($q) => $q->where('category', $this->activeCategory))
            ->when($this->search, fn ($q) => $q->where(function ($q): void {
                $q->where('question', 'like', '%'.$this->search.'%')
                    ->orWhere('answer', 'like', '%'.$this->search.'%');
            }))
            ->get();
    }

    public function render(): View
    {
        return view('livewire.public.faq-list')
            ->layout('components.layouts.app', [
                'title' => 'Frequently Asked Questions',
                'description' => 'Find answers to common questions about our veterinary services, appointments, pet care, and products at Raph Veterinary Services Nigeria.',
            ]);
    }
}
