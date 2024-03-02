@extends('layouts.app')

@section('title', "Blog: $post->title")

@section('content')
    <div class="container">
        <article class="blog-post">
            <h2 class="display-5 link-body-emphasis mb-1">{{ $post->title }}</h2>
            <p class="blog-post-meta">{{ date('d M Y H:i', strtotime($post->created_at)) }}</p>

            <p>{{ $post->content }}</p>

            <small class="text-muted">{{ $total_comments }} Komentar</small>

            @foreach ($comments as $comment)
                <div class="card mb-3">
                    <div class="card-body">
                        {{ $comment->comment }}
                    </div>
                </div>
            @endforeach

            <a href="{{ url('posts') }}">
                < Kembali</a>
        </article>
    </div>
@endsection
