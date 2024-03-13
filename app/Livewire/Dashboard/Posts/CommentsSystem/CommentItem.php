<?php

namespace App\Livewire\Dashboard\Posts\CommentsSystem;

use App\Models\PostComments;
use Livewire\Attributes\On;
use Livewire\Component;

class CommentItem extends Component
{
    public PostComments $comment;
    public bool $replying = false;
    public bool $editing = false;

    public function mount(PostComments $comment)
    {
        $this->comment = $comment;
    }

    public function render()
    {
        return view('livewire.dashboard.posts.comments-system.comment-item');
    }

    public function startReplying()
    {
        $this->replying = true;
        $this->editing = false;
    }

    public function cancelReplying()
    {
        $this->replying = false;
    }

    private function cancelEditing()
    {
        $this->editing = false;
    }

    public function startCommentEdit()
    {
        $this->editing = true;
    }

    #[On('hideCommentForm')]
    public function hideCommentForm()
    {
        $this->cancelReplying();
        $this->cancelEditing();
    }

    public function deleteComment()
    {
        $user = auth()->user();
        if (!$user) {
            return $this->redirect(route('login'));
        }
        if ($user->id != $this->comment->user_id) {
            return response()->status(403);
        }

        $id = $this->comment->id;
        $this->comment->delete();

        $this->dispatch('commentDeleted', id: $id)->to(Comments::class);
    }

    #[On('commentCreated')]
    public function commentCreated(int $replyId)
    {
        $this->cancelReplying();
    }
}
