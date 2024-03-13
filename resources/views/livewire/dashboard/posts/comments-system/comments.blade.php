<div class="px-4 pt-4 rounded bg-body-extra-light shadow-lg">
    <p class="fs-sm"><span>{{ $comments->count() > 0 ? $comments->count() : '' }}</span> Комментариев</p>
    <livewire:dashboard.posts.comments-system.comment-create :post-id="$post->id" />

    <div class="pt-3 fs-sm">
        @if($comments->count() > 0)
            @foreach($comments as $comment)
                <livewire:dashboard.posts.comments-system.comment-item wire:key="{{ $comment->id }}" :comment="$comment" />
            @endforeach
        @endif
    </div>
</div>
{{--<div class="px-4 pt-4 rounded bg-body-extra-light">
    <p class="fs-sm">
        <i class="fa fa-thumbs-up text-info"></i>
        <i class="fa fa-heart text-danger"></i>
        <a class="fw-semibold" href="javascript:void(0)">Albert Ray</a>,
        <a class="fw-semibold" href="javascript:void(0)">Carol Ray</a>,
        <a class="fw-semibold" href="javascript:void(0)">and 56 others</a>
    </p>
    <form action="be_pages_blog_story_cover.html" method="POST" onsubmit="return false;">
        <input type="text" class="form-control form-control-alt" placeholder="Write a comment..">
    </form>
    <div class="pt-3 fs-sm">
        <div class="d-flex">
            <a class="flex-shrink-0 img-link me-2" href="javascript:void(0)">
                <img class="img-avatar img-avatar32 img-avatar-thumb" src="assets/media/avatars/avatar6.jpg" alt="">
            </a>
            <div class="flex-grow-1">
                <p class="mb-1">
                    <a class="fw-semibold" href="javascript:void(0)">Lisa Jenkins</a>
                    Vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit.
                </p>
                <p>
                    <a class="me-1" href="javascript:void(0)">Like</a>
                    <a href="javascript:void(0)">Comment</a>
                </p>
                <div class="d-flex">
                    <a class="flex-shrink-0 img-link me-2" href="javascript:void(0)">
                        <img class="img-avatar img-avatar32 img-avatar-thumb" src="assets/media/avatars/avatar16.jpg" alt="">
                    </a>
                    <div class="flex-grow-1">
                        <p class="mb-1">
                            <a class="fw-semibold" href="javascript:void(0)">Jesse Fisher</a>
                            Odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </p>
                        <p>
                            <a class="me-1" href="javascript:void(0)">Like</a>
                            <a href="javascript:void(0)">Comment</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <a class="flex-shrink-0 img-link me-2" href="javascript:void(0)">
                <img class="img-avatar img-avatar32 img-avatar-thumb" src="assets/media/avatars/avatar13.jpg" alt="">
            </a>
            <div class="flex-grow-1">
                <p class="mb-1">
                    <a class="fw-semibold" href="javascript:void(0)">Jesse Fisher</a>
                    Leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices.
                </p>
                <p>
                    <a class="me-1" href="javascript:void(0)">Like</a>
                    <a href="javascript:void(0)">Comment</a>
                </p>
            </div>
        </div>
    </div>
</div>--}}
