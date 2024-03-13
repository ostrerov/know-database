<?php

namespace App\Livewire\Dashboard\Posts\CommentsSystem;

use App\Models\PostComments;
use App\Models\User;
use Livewire\Component;
use Auth;

class CommentCreate extends Component
{
    public ?User $user = null;
    public ?PostComments $commentModel = null;
    public string $comment = '';
    public int $postId;
    public ?int $parentId = null;
    public ?string $message = null;
    public bool $showProfile = true;

    protected array $rules = [
        'comment' => 'required|string'
    ];

    protected array $messages = [
        'comment.required' => 'Комментарий не может быть пустым',
        'comment.string' => 'Неверный формат комментария',
    ];

    public function mount(
        int $postId,
        $commentModel = null,
        ?int $parentId = null
    )
    {
        if (Auth::check()) {
            $this->user = Auth::user();
        }
        $this->postId = $postId;
        $this->parentId = $parentId;
        $this->commentModel = $commentModel;
        $this->comment = $this->commentModel?->comment ?? '';
    }

    public function resetForm()
    {
        $this->comment = '';
        $this->parentId = null;
        $this->commentModel = null;
        $this->dispatch('hideCommentForm');
        $this->dispatch('hideCommentForm')->to(CommentItem::class);
    }

    public function createComment()
    {
        $this->validate();
        if (!\auth()->check()) {
            return $this->redirect(route('login'));
        }
        if ($this->commentModel && $this->commentModel->comment) {
            if ($this->user->id != $this->commentModel->user_id) {
                return response()->status(403);
            }
            $this->commentModel->comment = $this->comment;
            $this->commentModel->save();
            $this->dispatch('commentUpdated')->to(CommentItem::class);
        } else {
            $comment = PostComments::query()
                ->create([
                    'comment' => $this->comment,
                    'post_id' => $this->postId,
                    'user_id' => $this->user->id,
                    'parent_id' => $this->parentId
                ]);
            $this->dispatch('commentCreated', replyId: $comment->id)->to(CommentItem::class);
            $this->dispatch('commentCreated', id: $comment->id)->to(Comments::class);
        }

        $this->comment = '';
    }

    public function render()
    {
        return view('livewire.dashboard.posts.comments-system.comment-create');
    }
}
