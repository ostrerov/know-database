<?php

namespace App\Livewire\Dashboard\Posts;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTags;
use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $coverURL;

    private $coverURLfieldRules = [
        'coverURL' => ['nullable', 'image', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp', 'max:1024']
    ];

    private $coverURLfieldMessages = [
        'coverURL' => [
            'image' => 'Загрузить можно только изображение',
            'mimes' => 'Ошибка загрузки. Поддерживаются следующие типы файлов - :mimes',
            'max' => 'Ошибка загрузки. Максимальный размер файла - :max КБ'
        ]
    ];

    public $name;

    public $categoryID;

    public $content;

    public $categoriesList;
    public $categoryTitle;

    public $tags;

    public function mount()
    {
        $this->getCategoriesList();
    }

    public function render(
    ): View|Application|Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.dashboard.posts.create-post');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->coverURLfieldRules, $this->coverURLfieldMessages);
    }

    public function save()
    {
        $validated = Validator::make(
            [
                'coverURL' => $this->coverURL,
                'name' => $this->name,
                'categoryID' => $this->categoryID,
                'content' => $this->content,
                'tags' => $this->tags
            ],
            [
                $this->coverURLfieldRules,
                'name' => ['required', 'min:12', 'string', 'unique:posts'],
                'categoryID' => ['required', 'integer', 'exists:App\Models\Category,id'],
                'content' => ['required', 'string'],
                'tags' => ['required', 'array']
            ],
            [
                $this->coverURLfieldMessages,
                'name' => [
                    'required' => 'Название поста обязательно к заполнению',
                    'min' => 'Минимальная длинна названия - :min символов',
                    'unique' => 'Название поста должно быть уникальным'
                ],
                'categoryID' => [
                    'categoryID' => 'Пост обязательно должен быть в категории',
                    'exists' => 'Этой категории не найдено в базе данных'
                ],
                'content' => [
                    'required' => 'Текст поста обязателен к заполнению'
                ],
                'tags' => [
                    'required' => 'Должен быть хотя бы один тэг поста'
                ]
            ]
        )->validate();

        if ($validated) {
            $url = null;

            if ($this->coverURL != '' OR $this->coverURL !== NULL) {
                $url = $this->coverURL->store(path: 'uploads/posts_covers', options: 'public');
            }

            $postID = Post::create([
                'user_id' => Auth::user()->id,
                'cover_url' => "/storage/$url",
                'name' => $this->name,
                'category_id' => $this->categoryID,
                'short_text' => substr(strip_tags($this->content), 0, 255),
                'content' => $this->content,
            ])->id;

            foreach ($this->tags as $tag) {
                PostTags::create([
                    'post_id' => $postID,
                    'name' => preg_replace('/\s+/', '', $tag)
                ]);
            }

            return redirect()->route('dashboard.posts.index');
        }

        return false;
    }

    #[On('category-created')]
    public function getCategoriesList()
    {
        $this->categoriesList = Category::get();
    }
}
