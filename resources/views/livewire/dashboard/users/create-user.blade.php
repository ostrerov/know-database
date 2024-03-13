@push('js')
    <script>
        function genPassword() {
            let passwordInput = document.getElementById('password');
            passwordInput.value = Math.random().toString(36).slice(-8);
            @this.set('password', passwordInput.value);
        }
    </script>
@endpush
<div>
    <form class="row g-3" wire:submit="save">
        <div class="col-12">
            <label for="name" class="form-label">{{ __('Имя') }}</label>
            <input type="text" wire:loading.attr="disabled" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="John" id="name">
            @error('name')
            <div id="nameFeedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-12">
            <label for="login" class="form-label">{{ __('Псевдоним') }}</label>
            <input type="text" wire:loading.attr="disabled" wire:model="login" class="form-control @error('login') is-invalid @enderror" placeholder="admin" id="login">
            @error('login')
            <div id="loginFeedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-12">
            <label for="role" class="form-label">{{ __('Роль') }}</label>
            <select id="role" class="form-select @error('role') is-invalid @enderror" wire:model="role" wire:loading.attr="disabled">
                <option value="0" selected>{{ __('Выберите роль...') }}</option>
                @foreach($rolesList->all() as $role)
                    <option value="{{ $role->id }}">
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            @error('role')
            <div id="roleFeedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-12" wire:ignore>
            <label for="password" class="form-label">{{ __('Пароль') }}</label>
            <input type="text" wire:loading.attr="disabled" wire:model="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" aria-label="Password">
            @error('password')
            <div id="nameFeedback" class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-12 d-grid gap-0 h-25">
            <button class="btn btn-outline-secondary text-center" onclick="genPassword()" type="button">{{ __('Сгенерировать пароль') }}</button>
        </div>
        <div class="d-block">
            <button type="submit" wire:loading.attr="disabled" class="btn btn-primary">
                <div class="d-flex align-items-center">
                    {{ __('Создать') }}
                    <div wire:loading class="ms-1 spinner-border spinner-border-sm" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                </div>
            </button>
        </div>
    </form>
</div>
