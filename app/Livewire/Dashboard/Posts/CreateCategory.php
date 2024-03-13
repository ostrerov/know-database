<?php

namespace App\Livewire\Dashboard\Posts;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateCategory extends Component
{
    public $title;

    public function render()
    {
        return view('livewire.dashboard.posts.create-category');
    }

    public function save(): void
    {
        $validated = Validator::make(
            ['title' => $this->title],
            ['title' => ['required', 'string', 'unique:categories', 'min:3']],
            [
                'required' => 'Введите название категории',
                'unique' => 'Такая категория уже существует',
                'min' => 'Минимальная длинна названия категории - :min символов'
            ]
        )->validate();

        Category::create($validated);
        $this->dispatch('category-created');
        $this->dispatch('category-created')->to(CreatePost::class);
        $this->reset('title');
    }
}
