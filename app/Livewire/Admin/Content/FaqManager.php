<?php

namespace App\Livewire\Admin\Content;

use App\Models\Faq;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class FaqManager extends Component
{
    use WithPagination;

    public ?int $editingId = null;

    public bool $showForm = false;

    public string $question = '';

    public string $answer = '';

    public string $category = '';

    public string $isActiveStr = '1';

    public int $sortOrder = 0;

    public function startEdit(int $id): void
    {
        $faq = Faq::findOrFail($id);
        $this->editingId = $faq->id;
        $this->question = $faq->question;
        $this->answer = $faq->answer;
        $this->category = $faq->category ?? '';
        $this->isActiveStr = $faq->is_active ? '1' : '0';
        $this->sortOrder = $faq->sort_order;
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
        $this->question = '';
        $this->answer = '';
        $this->category = '';
        $this->isActiveStr = '1';
        $this->sortOrder = 0;
        $this->resetValidation();
    }

    public function save(): void
    {
        $this->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:100',
            'sortOrder' => 'integer|min:0',
        ]);

        $data = [
            'question' => $this->question,
            'answer' => $this->answer,
            'category' => $this->category ?: null,
            'is_active' => $this->isActiveStr === '1',
            'sort_order' => $this->sortOrder,
        ];

        if ($this->editingId) {
            Faq::findOrFail($this->editingId)->update($data);
            session()->flash('success', 'FAQ updated.');
        } else {
            Faq::create($data);
            session()->flash('success', 'FAQ created.');
        }

        $this->cancelEdit();
    }

    public function delete(int $id): void
    {
        Faq::findOrFail($id)->delete();
        session()->flash('success', 'FAQ deleted.');
    }

    public function render(): View
    {
        $faqs = Faq::orderBy('sort_order')->paginate(20);

        return view('livewire.admin.content.faq-manager', compact('faqs'));
    }
}
