@extends('layout.admin')

@section('title')
    <title>Menu</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('site/user/profile.css')}}">
    <link rel="stylesheet" href="{{asset('admins/order/order.css')}}">
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'order','key'=>'View'])


        <div class="content">

            <div class="content-main">


                <div class="col-lg-6 col-md-9">
                    <div class="checkout__order card ">
                        <h4 class="order__title">{{$order->getUser($order->id_user)->name}}'s order</h4>
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
                            <li>Order code: {{$order->code_order}}</li>
                        </ul>
                        @if($order->status=='confirmed')
                            <a class="btn btn-outline-warning" href="{{route('order.change',['id'=>$order->id,'status'=>'preparing'])}}">Preparing goods</a>
                        @elseif($order->status=='preparing')
                            <a class="btn btn-outline-primary" href="{{route('order.change',['id'=>$order->id,'status'=>'on the way'])}}">On the way</a>
                        @endif

                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection
