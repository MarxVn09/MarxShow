@extends('layout.site')
@section('css')
    <link rel="stylesheet" href="{{asset('site/user/profile.css')}}">
    <link rel="stylesheet" href="{{asset('site/user/order.css')}}">

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


            <div class="card-grid">
                @foreach($order as $i)
                    <article class="card">
                        <div class="card-header">
                            <div>
                                <h3>Order Code:{{$i->code_order}}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Total: ${{$i->total}}.</p>
                            <p>Date of purchase: {{$i->created_at->format('d/m/Y')}}.</p>
                            <p>
                                Status:
                                <span
                                     class="
                                        @if($i->status=='success')
                                        text-success
                                        @elseif($i->status=='on the way')
                                        text-primary
                                        @elseif($i->status=='preparing')
                                        text-primary
                                        @else
                                        text-warning
                                         @endif
                                     ">
                                    {{ucfirst($i->status)}}.
                                </span></p>
                        </div>
                        <div class="card-footer">
                            <a class="btn text-primary" href="{{route('user.order.detail',['id'=>$i->id])}}">View integration</a>
                        </div>
                    </article>
                @endforeach
            </div>


        </div>
    </div>
@endsection
