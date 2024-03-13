<?php

namespace App\Livewire\Dashboard\Posts;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class PostsList extends Component
{
    public $posts;

    public function mount()
    {
        $this->getPosts();
    }

    public function render()
    {
        $posts = $this->posts;

        return view('livewire.dashboard.posts.posts-list', compact('posts'));
    }

    public function deletePost($id)
    {
        Post::where(['id' => $id])->delete();
        $this->dispatch('post-deleted');
        $this->dispatch('post-deleted')->self();
    }

    #[On('post-deleted')]
    public function getPosts(): void
    {
        $posts = Post::get(['id', 'user_id', 'category_id', 'name', 'short_text', 'created_at', 'updated_at']);

        $this->posts = $posts;
    }
}
