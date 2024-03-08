@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="row">
        <div class="card col-md-4 mx-auto">
            <div class="card-body">
                <h1 class="text-center">Login</h1>

                <form method="POST" action="{{ url('login') }}" class="form-control">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
