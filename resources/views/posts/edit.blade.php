@extends('layouts.app')

@section('title', 'Edit Postingan')

@section('content')
    <div class="container">
        <h1>Edit postingan</h1>

        <form method="POST" action="{{ url("posts/$post->id") }}" class="form-control mb-3">
            @method('PATCH')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Konten</label>
                <textarea class="form-control" id="content" name="content" rows="3">{{ $post->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Edit</button>
        </form>

        <form method="POST" action="{{ url("posts/$post->id") }}">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">Hapus Postingan 😭</button>
        </form>
    </div>
@endsection
