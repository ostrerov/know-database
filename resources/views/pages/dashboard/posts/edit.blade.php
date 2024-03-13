@extends('layouts.dashboard')

@section('content')
    <livewire:dashboard.posts.edit-post :post="$post" :tags="$tags" />
@endsection
