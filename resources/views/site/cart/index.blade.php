@extends('layout.site')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cart->cart_details as $i)
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="{{ asset($i->getProduct($i->product_id)->feature_image_path) }}" alt="" style="width: 100px;">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{ $i->getProduct($i->product_id)->name }}</h6>
                                            <h5 class="product_price" data-price="{{ $i->getProduct($i->product_id)->price }}">
                                                ${{ $i->getProduct($i->product_id)->price }}
                                            </h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input type="number" min="1" class="product_quantity" data-id="{{ $i->id }}" value="{{ $i->quantity }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">
                                            <span class="product_total">
                                                ${{ $i->quantity * $i->getProduct($i->product_id)->price }}
                                            </span>
                                    </td>
                                    <td class="cart__close"><a href="" class="btn"><i class="fa fa-close"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="#">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span id="cart_subtotal">$0.00</span></li>
                            <li>Total <span id="cart_total">$0.00</span></li>
                        </ul>
                        <a href="{{route('cart.checkOut')}}" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        $(document).ready(function() {
            function updateCartTotals() {
                var subtotal = 0;

                $('.product_quantity').each(function() {
                    var quantity = $(this).val();
                    var price = $(this).closest('tr').find('.product_price').data('price');

                    if ($.isNumeric(quantity) && quantity > 0) {
                        var total = quantity * price;
                        $(this).closest('tr').find('.product_total').text('$' + total.toFixed(2));
                        subtotal += total;
                    } else {
                        $(this).closest('tr').find('.product_total').text('$0.00');
                    }
                });

                // Update subtotal and total
                $('#cart_subtotal').text('$' + subtotal.toFixed(2));
                $('#cart_total').text('$' + subtotal.toFixed(2)); // Assuming no additional charges
            }

            $('.product_quantity').on('input', function() {
                var quantity = $(this).val();
                var id = $(this).data('id');

                // Send AJAX request to update cart
                $.ajax({
                    url: '{{ route("cart.update") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        quantity: quantity
                    },
                    success: function(response) {
                        if (response.success) {
                            updateCartTotals();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });

            $('.cart__close a').on('click', function(event) {
                event.preventDefault();
                var row = $(this).closest('tr');
                var id = row.find('.product_quantity').data('id');

                // Send AJAX request to remove cart item
                $.ajax({
                    url: '{{ route("cart.remove") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(response) {
                        if (response.success) {
                            row.remove();
                            updateCartTotals();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });

            // Initial calculation
            updateCartTotals();
        });

    </script>
@endsection
