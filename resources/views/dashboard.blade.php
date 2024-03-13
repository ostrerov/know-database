@extends('layouts.dashboard')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">
                        Панель управления
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Добро пожаловать {{ Auth::user()->name }}.
                    </h2>
                </div>
                {{--<nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                  <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                      <a class="link-fx" href="javascript:void(0)">App</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                      Dashboard
                    </li>
                  </ol>
                </nav>--}}
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="row">
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center"
                   href="{{ route('dashboard.users.index') }}">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-primary">{{ $usersCount }}</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-muted mb-0">
                            {{ __('Пользователи') }}
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center"
                   href="{{ route('dashboard.posts.index') }}">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-success">{{ $postsCount }}</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-muted mb-0">
                            {{ __('Посты') }}
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
