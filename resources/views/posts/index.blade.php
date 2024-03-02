@extends('layouts.app')

@section('title', 'Welcome Masbro')

@section('content')
    <h1>The Best Blog Website Ever</h1>
    <a href="{{ url('posts/create') }}" class="btn btn-success mb-3">+ Add Post</a>

    @foreach ($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->content }}</p>
                <p class="card-text"><small class="text-body-secondary">Last updated
                        {{ date('d M Y H:i', strtotime($post->created_at)) }}</small></p>
                <a href="{{ url("posts/$post->id") }}" class="btn btn-primary">Selengkapnya</a>
                <a href="{{ url("posts/$post->id/edit") }}" class="btn btn-warning">Edit Cuy</a>
            </div>
        </div>
    @endforeach
@endsection
