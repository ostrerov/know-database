<div class="d-flex">
    <div class="flex-shrink-0 me-2"></div>
    <div class="flex-grow-1">
        <p class="mb-1">
            <span class="fw-semibold text-info">{{ $comment->user->name }}</span>
            @if($editing)
                <livewire:dashboard.posts.comments-system.comment-create
                    wire:key="'edit-'.$comment->id"
                    :post-id="$comment->post_id"
                    :comment-model="$comment"
                    :show-profile="false" />
            @else
                {{ $comment->comment }}
            @endif
        </p>
        <p>
            <span class="text-xs tf-format" tf-unix="{{ strtotime($comment->created_at) }}"></span>
            &bull;
            @if(Auth::check() && Auth::user()->id == $comment->user_id OR Auth::user()->isAdmin())
                <a class="me-1" href="javascript:void(0)" wire:click.prevent="deleteComment">Удалить</a>
                @if(strtotime($comment->created_at) >= (time() - 43200) OR Auth::user()->isAdmin())
                    <a class="me-1" href="javascript:void(0)" wire:click.prevent="startCommentEdit">Редактировать</a>
                @endif
            @endif
            <a href="javascript:void(0)" wire:click.prevent="startReplying">Ответить</a>
        </p>
        @if($replying)
            <livewire:dashboard.posts.comments-system.comment-create
                wire:key="'reply-'.$comment->id"
                :post-id="$comment->post_id"
                :parent-id="$comment->id" />
        @endif
        @if($comment->replies)
            @foreach($comment->replies as $reply)
                <livewire:dashboard.posts.comments-system.comment-item wire:key="{{ $reply->id }}" :comment="$reply" />
            @endforeach
        @endif
    </div>
</div>
