<div>
    <form wire:submit.prevent="createComment" x-data="{
    focused: {{ $parentId ? 'true' : 'false' }},
    isEdit: {{ $commentModel ? 'true' : 'false' }},
    init() {
        if (this.isEdit || this.focused) {
            this.$refs.input.focus();
        }
        $wire.on('closeCommentBoxFromCreate', () => {
            this.focused = false;
        })
        $wire.on('hideCommentForm', () => {
            this.focused = false;
            this.isEdit = false;
        })
    }
    }">
        <div class="flex-1">
                <textarea
                    x-ref="input"
                    name="comment"
                    @click="focused = true"
                    id="comment"
                    wire:model.lazy="comment"
                    placeholder="Комментарий..."
                    class="form-control form-control-alt @error('comment') is-invalid @enderror"
                    :rows="focused || isEdit ? 4 : 1"></textarea>
            @error('comment')
            <div id="commentFeedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="text-right mt-4">
            <button type="submit" class="btn btn-sm btn-success">Комментировать</button>
            <button wire:click="resetForm" type="button" class="btn btn-sm btn-danger">Отменить</button>
            <div wire:loading class="ms-1 spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden"></span>
            </div>
        </div>
    </form>
</div>
