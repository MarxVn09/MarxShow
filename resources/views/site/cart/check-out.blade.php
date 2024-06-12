@extends('layout.site')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="{{route('cart.checkOut.post')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">


                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" name="first_name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="last_name">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" name="country">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="city">
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add"
                                       name="address">

                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="zip">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text"
                                       placeholder="Notes about your order, e.g. special notes for delivery."
                                       name="note"
                                >
                            </div>


                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">Product <span>Total</span></div>
                                <ul class="checkout__total__products">
                                    @foreach($cart->cart_details as $index=>$i)
                                        <li>{{$index+1}}.
                                            {{$i->getProduct($i->product_id)->name}}({{$i->size}})
                                            x
                                            {{$i->quantity}}
                                            <span>${{$i->getProduct($i->product_id)->price*$i->quantity}}</span></li>
                                            @php
                                            $total+=$i->getProduct($i->product_id)->price*$i->quantity;
                                             @endphp
                                    @endforeach


                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Subtotal <span>${{$total}}</span></li>
                                    <li>Ship Fee:
                                        @if($total>=50)
                                            <span>free</span>
                                        @else
                                            <span>$2</span>
                                        @endif
                                    </li>
                                    <li>Total
                                        @if($total>=50)
                                            <span>${{$total}}</span>
                                        @else
                                            <span>${{$total+2}}</span>
                                        @endif

                                    </li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Payment on delivery
                                        <input type="radio" id="payment" name="payment_method" value="shipCod" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Payment on Visa/Master Cart (development posting function)
                                        <input type="radio" id="paypal" name="payment_method" disabled>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

@endsection
