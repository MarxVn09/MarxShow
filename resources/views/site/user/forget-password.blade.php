@extends('layout.site')
@section('content')
    <div class="container">
        <div class="loginForm m-5 p-5 border rounded">
            <form action="{{route('forget.password.post')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           name="email"
                           value="{{old('email')}}"
                    >
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Send Reset Link</button>
            </form>
        </div>

    </div>
@endsection
