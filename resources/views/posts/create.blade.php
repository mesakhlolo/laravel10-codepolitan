@extends('layouts.app')

@section('title', 'Buat Postingan')

@section('content')
    <div class="container">
        <h1>Buat postingan baru</h1>

        <form method="POST" action="{{ url('posts') }}" class="form-control">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Konten</label>
                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
