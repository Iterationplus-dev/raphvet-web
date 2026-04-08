<?php

namespace App\Livewire\Admin\Content;

use App\Models\Testimonial;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class TestimonialManager extends Component
{
    use WithPagination;

    public ?int $editingId = null;

    public bool $showForm = false;

    public string $authorName = '';

    public string $authorRole = '';

    public string $content = '';

    public int $rating = 5;

    public bool $isActive = true;

    public int $sortOrder = 0;

    public string $avatarUrl = '';

    public function startEdit(int $id): void
    {
        $testimonial = Testimonial::findOrFail($id);
        $this->editingId = $testimonial->id;
        $this->authorName = $testimonial->author_name;
        $this->authorRole = $testimonial->author_role ?? '';
        $this->content = $testimonial->content;
        $this->rating = $testimonial->rating;
        $this->isActive = $testimonial->is_active;
        $this->sortOrder = $testimonial->sort_order;
        $this->avatarUrl = $testimonial->avatar ?? '';
        $this->showForm = true;
    }

    public function startCreate(): void
    {
        $this->cancelEdit();
        $this->showForm = true;
    }

    public function cancelEdit(): void
    {
        $this->editingId = null;
        $this->showForm = false;
        $this->authorName = '';
        $this->authorRole = '';
        $this->content = '';
        $this->rating = 5;
        $this->isActive = true;
        $this->sortOrder = 0;
        $this->avatarUrl = '';
        $this->resetValidation();
    }

    public function save(): void
    {
        $this->validate([
            'authorName' => 'required|string|max:150',
            'authorRole' => 'nullable|string|max:150',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'isActive' => 'boolean',
            'sortOrder' => 'integer|min:0',
            'avatarUrl' => 'nullable|url|max:500',
        ]);

        $data = [
            'author_name' => $this->authorName,
            'author_role' => $this->authorRole ?: null,
            'content' => $this->content,
            'rating' => $this->rating,
            'is_active' => $this->isActive,
            'sort_order' => $this->sortOrder,
            'avatar' => $this->avatarUrl ?: null,
        ];

        if ($this->editingId) {
            Testimonial::findOrFail($this->editingId)->update($data);
            session()->flash('success', 'Testimonial updated.');
        } else {
            Testimonial::create($data);
            session()->flash('success', 'Testimonial created.');
        }

        $this->cancelEdit();
    }

    public function delete(int $id): void
    {
        Testimonial::findOrFail($id)->delete();
        session()->flash('success', 'Testimonial deleted.');
    }

    public function render(): View
    {
        $testimonials = Testimonial::orderBy('sort_order')->paginate(20);

        return view('livewire.admin.content.testimonial-manager', compact('testimonials'));
    }
}
