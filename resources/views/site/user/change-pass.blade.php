@extends('layout.site')
@section('css')
    <link rel="stylesheet" href="{{asset('site/user/profile.css')}}">
@endsection
@section('content')

    <div class="content">
        <div class="content-panel">
            <div class="vertical-tabs">
                <a href="{{route('user.profile')}}" class="active">Profile</a>
                <a href="{{route('user.order')}}">Orders</a>
                <a href="{{route('user.changePass')}}">Change Password</a>
                <a href="{{route('logoutSite')}}">Log Out</a>
            </div>
        </div>
        <div class="content-main">

            <form method="post" action="{{route('user.changePass.post')}}">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Old Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="oldPass">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="newPass">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Repeat New Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="reNewPass">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="keep_me">
                    <label class="form-check-label" for="exampleCheck1" >Keep me logged in</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>


        </div>
    </div>
@endsection
