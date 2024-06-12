@extends('layout.site')
@section('css')

@endsection
@section('js')

@endsection
@section('content')

    <div class="container">
        <div class="loginForm m-5 p-5 border rounded">
            <form method="post" action="{{route('resister.post')}}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           name="name"
                           value="{{old('name')}}"
                    >
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
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
                <div class="mb-3">
                    <label for="repassword" class="form-label">Password</label>
                    <input type="password"
                           class="form-control @error('repassword') is-invalid @enderror"
                           id="repassword"
                           name="repassword"
                    >
                    @error('repassword')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <a href="{{route('login.form')}}" class="float-right">I have an account</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>

    </div>

@endsection
