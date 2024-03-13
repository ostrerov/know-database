@push('js')
    <script type="module">
        let modal;

        document.addEventListener('DOMContentLoaded', () => {
            modal = document.getElementById('createCategoryModal')
            const createCategoryInput = document.getElementById('title')

            modal.addEventListener('shown.bs.modal', () => {
                createCategoryInput.focus()
            })
        })
    </script>
@endpush
<form wire:submit="save">
    <div class="modal-body">
        <div class="col-12">
            <label for="title" class="form-label">{{ __('Название категории') }}</label>
            <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror" id="title">
            @error('title')
            <div id="titleFeedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Отмена') }}</button>
        <button wire:loading.attr="disabled" wire:target="title" type="submit" class="btn btn-primary">
            <div class="d-flex align-items-center">
                {{ __('Создать') }}
                <div wire:loading class="ms-1 spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden"></span>
                </div>
            </div>
        </button>
    </div>
</form>
