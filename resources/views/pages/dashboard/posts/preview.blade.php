@extends('layouts.dashboard')

@push('js')
    <script type="module" src="{{ asset('js/tf.js') }}"></script>
@endpush

@section('content')
    <!-- Hero Content -->
    @if($post->cover_url !== NULL)
        <div class="bg-image" style="min-height: 600px; background-image: url('{{ $post->cover_url }}');"></div>
    @endif
    <!-- END Hero Content -->

    <!-- Page Content -->
    <div class="bg-body-extra-light">
        <div class="content content-full">
            <div class="text-center fs-sm push">
                <h1 class="mt-3">{{ $post->name }}</h1>
                <span class="d-inline-block py-2 px-4 bg-body-light rounded">
                    <span>{{ $post->user->name }}</span> &bull; <span class="tf-format" tf-unix="{{ strtotime($post->created_at) }}">{{ $post->created_at }}</span> &bull; <span>{{ $post->category->title }}</span>
                </span>
                <span class="d-block py-2 px-4">
                    @foreach($tags as $tag)
                        <span class="badge badge-pill bg-info">{{ $tag->name }}</span>
                    @endforeach
                </span>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <!-- Story -->
                    <article class="story">
                        {!! $post->content !!}
                    </article>
                    <!-- END Story -->

                    <!-- Comments -->
                    <livewire:dashboard.posts.comments-system.comments :post="$post" />
                    <!-- End Comments -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
