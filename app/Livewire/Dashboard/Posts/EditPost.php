<?php

namespace App\Livewire\Dashboard\Posts;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTags;
use DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class EditPost extends Component
{
    use WithFileUploads;

    private $postID;

    private $postData;

    private $tagsData;

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

    public function mount($post, $tags)
    {
        $this->getCategoriesList();
        $this->postID = $post->id;
        $this->postData = $post;
        $this->tagsData = $tags;
        $this->name = $this->postData->name;
        $this->categoryID = $this->postData->category_id;
        $this->content = $this->postData->content;
    }

    public function render()
    {
        return view('livewire.dashboard.posts.edit-post');
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
                'name' => ['required', 'min:12', 'string'],
                'categoryID' => ['required', 'integer', 'exists:App\Models\Category,id'],
                'content' => ['required', 'string'],
                'tags' => ['array', 'nullable']
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
                ]
            ]
        )->validate();

        if ($validated) {
            $url = null;

            if ($this->coverURL != '' or $this->coverURL !== null) {
                $url = $this->coverURL->store(path: 'uploads/posts_covers', options: 'public');
            }

            Post::whereId($this->postID)->update([
                'user_id' => Auth::user()->id,
                'cover_url' => ($url === null ? $url : "/storage/$url"),
                'name' => $this->name,
                'category_id' => $this->categoryID,
                'short_text' => substr(strip_tags($this->content), 0, 255),
                'content' => $this->content,
            ]);

            if ($this->tags !== NULL) {
                PostTags::where(['post_id' => $this->postID])->delete();
                foreach ($this->tags as $tag) {
                    PostTags::create([
                        'post_id' => $this->postID,
                        'name' => preg_replace('/\s+/', '', $tag)
                    ]);
                }
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
