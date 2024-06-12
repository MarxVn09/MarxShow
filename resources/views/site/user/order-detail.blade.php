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


            <div class="col-lg-6 col-md-9">
                <div class="checkout__order card ">
                    <h4 class="order__title">Your order</h4>
                    <div class="checkout__order__products">Product <span>Total</span></div>
                    <ul class="checkout__total__products">
                        @foreach($order->order_details as $index=>$i)
                            <li>{{$index+1}}.
                                {{$i->getProduct($i->product_id)->name}}({{$i->size}})
                                x
                                {{$i->quantity}}
                                <span>${{$i->getProduct($i->product_id)->price*$i->quantity}}</span></li>
                        @endforeach
                    </ul>
                    <ul class="checkout__total__all">
                        <li>Total <span>${{$order->total}}</span></li>
                        <li>Address: {{$order->address}}</li>
                        <li>Phone Number: {{$order->phone_number}}</li>
                        <li>Date of purchase: {{$order->created_at->format('d/m/Y')}}</li>
                        <li>Your order code: {{$order->code_order}}</li>
                    </ul>
                    <p>Thank you for trusting our store. Your choice is our honor.</p>
                    @if($order->status!='success')
                        <a class="btn btn-outline-primary" href="{{route('order.checked',['id'=>$order->id])}}">Received the goods</a>
                    @endif

                </div>
            </div>

        </div>
    </div>
@endsection
