<?php

namespace App\Livewire\Dashboard\Posts;

use App\Models\PostComments;
use Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Component;

class Comments extends Component
{
    public $postID;

    public $comment;

    public $postComments;

    public function mount($post_id)
    {
        $this->postID = $post_id;
        $this->getComments();
    }

    public function render()
    {
        return view('livewire.dashboard.posts.comments');
    }

    public function save()
    {
        $validated = Validator::make(
            [
                'comment' => $this->comment
            ],
            [
                'comment' => ['string', 'min:6']
            ],
            [
                'comment' => [
                    'min' => 'Минимальная длинна комментария - :min символов'
                ]
            ]
        );

        if ($validated) {
            PostComments::create([
                'post_id' => $this->postID,
                'user_id' => Auth::user()->id,
                'comment' => $this->comment
            ]);

            $this->dispatch('comment-posted');
            $this->dispatch('comment-posted')->self();
            $this->reset('comment');
        }

        return false;
    }

    public function deleteComment($id)
    {
        PostComments::whereId($id)->delete();
        $this->dispatch('comment-deleted');
        $this->dispatch('comment-deleted')->self();
    }

    public function editComment($id)
    {

    }

    #[On('comment-posted')]
    #[On('comment-deleted')]
    public function getComments()
    {
        $this->postComments = PostComments::where(['post_id' => $this->postID])->get();
    }
}
