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
            @include('siteIngredient.user.changePassword')
{{--            <div class="card-grid">--}}
{{--                <article class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <div>--}}
{{--                            <h3>Zeplin</h3>--}}
{{--                        </div>--}}
{{--                        <label class="toggle">--}}
{{--                            <input type="checkbox" checked>--}}
{{--                            <span></span>--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <p>Collaboration between designers and developers.</p>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <a href="#">View integration</a>--}}
{{--                    </div>--}}
{{--                </article>--}}

{{--            </div>--}}
        </div>
    </div>
@endsection
