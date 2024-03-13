@extends('layouts.dashboard')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Your Block -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    {{ __('Создание пользователя') }}
                </h3>
            </div>
            <div class="block-content p-5">
                <livewire:dashboard.users.create-user :modal="false" />
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection
