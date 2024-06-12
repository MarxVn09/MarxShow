@extends('layout.site')
@section('content')
    <div class="container">
        <div class="loginForm m-5 p-5 border rounded">
            <form action="{{route('reset.password.post')}}" method="post">
                @csrf
                <input type="text" hidden name="token" value="{{$token}}">
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
                    <label for="email" class="form-label">New Password</label>
                    <input type="password"
                           class="form-control"
                           id="password"
                           name="password"

                    >

                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Confirm Password</label>
                    <input type="password"
                           class="form-control"
                           id="confirm_password"
                           name="confirm_password"

                    >

                </div>
                <button type="submit" class="btn btn-primary">Reset password</button>
            </form>
        </div>

    </div>
@endsection
