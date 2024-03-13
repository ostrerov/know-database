@extends('layouts.dashboard')

@section('content')
    <div class="content content-full">
        <div class="row text-center">
            <div class="col-6 col-xl-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full">
                        <div class="py-md-3">
                            <div class="py-3 d-none d-md-block">
                                <i class="far fa-2x fa-file-alt text-primary"></i>
                            </div>
                            <p class="fs-4 fw-bold mb-0">
                                {{ $postsCount }}
                            </p>
                            <p class="text-muted mb-0">
                                {{ __('Все посты') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-rounded" href="{{ route('dashboard.posts.add') }}">
                    <div class="block-content block-content-full">
                        <div class="py-md-3">
                            <div class="py-3 d-none d-md-block">
                                <i class="fa fa-2x fa-plus text-primary"></i>
                            </div>
                            <p class="fs-4 fw-bold mb-0">
                                <i class="fa fa-plus text-primary me-1 d-md-none"></i> {{ __('Создать пост') }}
                            </p>
                            <p class="text-muted mb-0">
                                {{ __('автор - ') . Auth::user()->name }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="content">
        <!-- Your Block -->
        <div class="block block-rounded">
            <div class="block-content">
                <livewire:dashboard.posts.posts-list />
            </div>
        </div>
        <!-- END Your Block -->
    </div>
@endsection
