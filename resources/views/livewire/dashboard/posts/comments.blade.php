@push('js')
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.js') }}"/>
    <script type="module">One.helpersOnLoad(['jq-notify']);</script>
    <script type="javascript">
        document.addEventListener('livewire:init', () => {
            Livewire.on('comment-posted', () => {
                One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Комментарий опубликован'});
            })
            Livewire.on('comment-deleted', () => {
                One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Комментарий удалён'});
            })
        });

        document.getElementById()

        function editPost(postID) {
            let comment = document.getElementById('comment-' + postID + '');
            let commentText = comment.outerText;

            console.log(commentText)
        }
    </script>
@endpush

<div class="px-4 pt-4 rounded bg-body-extra-light shadow-lg d-block block-mode-loading">
    <form wire:submit="save">
        <input type="text" class="form-control form-control-alt @error('comment') is-invalid @enderror" wire:model="comment" placeholder="Комментарий...">
        @error('comment')
        <div id="commentFeedback" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div wire:loading class="ms-1 spinner-border spinner-border-sm" role="status">
            <span class="visually-hidden"></span>
        </div>
    </form>
    <div class="pt-3 fs-sm">
        @foreach($postComments as $postComment)
            <div class="d-flex">
                <div class="flex-grow-1">
                    <p class="mb-1">
                        <span class="fw-semibold text-info">{{ $postComment->user->name }}</span>
                        <span id="comment-{{ $postComment->id }}">{!! $postComment->comment !!}</span>
                    </p>
                    <p>
                        <a class="me-1" href="javascript:void(0)" wire:click="deleteComment({{ $postComment->id }})">Удалить</a>
                        <a href="javascript:void(0)" onclick="editPost({{ $postComment->id }})">Редактировать</a>
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
