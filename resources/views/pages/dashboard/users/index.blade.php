@extends('layouts.dashboard')

@push('js')
    <script src="{{ asset('js/tf.js') }}"></script>
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.js') }}"/>
    <script type="module">One.helpersOnLoad(['jq-notify']);</script>
    <script type="module">
        const offcanvas = new bootstrap.Offcanvas('#offcanvasScrollingBackdrop')

        document.addEventListener('livewire:init', () => {
            Livewire.on('user-edited', () => {
                One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Пользователь отредактирован'});
            })
            Livewire.on('user-created', () => {
                One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Пользователь создан'});
                offcanvas.toggle()
            })
        });
    </script>
@endpush

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">
                        {{ __('Пользователи') }}
                    </h1>
                </div>
                <div class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3">
                    <a href="{{ route('dashboard.users.add') }}" class="btn btn-success" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrollingBackdrop" aria-controls="offcanvasScrollingBackdrop">
                        <i class="fas fa-user-plus ms-1"></i>
                        <span>{{ __('Добавить пользователя') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Content -->
    <div class="content">
        <!-- Your Block -->
        <div class="block block-rounded">
            <div class="block-content">
                <livewire:dashboard.users.users-list />
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
    <div class="offcanvas offcanvas-end bg-body-extra-light" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasScrollingBackdrop" aria-labelledby="offcanvasScrollingBackdropLabel">
        <div class="offcanvas-header bg-body-light">
            <h5 class="offcanvas-title" id="offcanvasScrollingBackdropLabel">{{ __('Создание пользователя') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <livewire:dashboard.users.create-user />
        </div>
    </div>
@endsection
