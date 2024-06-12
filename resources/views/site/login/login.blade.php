@extends('layout.site')
@section('css')

@endsection
@section('js')

@endsection
@section('content')

    <div class="container">
        <div class="loginForm m-5 p-5 border rounded">
            <form action="{{route('login.post')}}" method="post">
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
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="password"
                           name="password"
                    >
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1" name="remember_me">Remember Me</label>
                </div>
                <div class="mb-3 form-check">
                    <a href="{{route('forget.password')}}" class="float-right btn">Forget Password</a>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </div>

@endsection
