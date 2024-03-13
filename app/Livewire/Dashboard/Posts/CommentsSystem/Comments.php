<?php

namespace App\Livewire\Dashboard\Posts\CommentsSystem;

use App\Models\Post;
use App\Models\PostComments;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Comments extends Component
{
    public Post $post;

    public Collection $comments;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->comments = $this->getComments();
    }

    public function render()
    {
        return view('livewire.dashboard.posts.comments-system.comments');
    }

    #[On('commentCreated')]
    public function commentCreated(int $id)
    {
        $comment = PostComments::query()->find($id);
        if (!$comment->parent_id) {
            $this->comments = $this->comments->prepend($comment);
        }
    }

    #[On('commentDeleted')]
    public function commentDeleted(int $id)
    {
        $this->comments = $this->comments->reject(function ($comment, int $key) use ($id) {
            return $comment->id == $id;
        });
    }

    private function getComments(): Collection|array
    {
        return PostComments::query()
            ->with([
                'user',
                'replies'
            ])
            ->where('post_id', $this->post->id)
            ->whereNull('parent_id')
            ->orderByDesc('created_at')
            ->get();
    }
}
