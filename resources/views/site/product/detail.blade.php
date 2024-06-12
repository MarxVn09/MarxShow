@extends('layout.site')

@section('js')
    <script>
        function addToCart(){
        }
    </script>
@endsection
@section('content')

    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link action " data-toggle="tab" href="#tabs-1" role="tab">
                                    <div class="product__thumb__pic set-bg"
                                         data-setbg="{{asset($product->feature_image_path)}}">
                                    </div>
                                </a>
                            </li>
                            @foreach($product->images as $i)
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-{{$i->id}}" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="{{asset($i->image_path)}}">
                                        </div>
                                    </a>
                                </li>
                            @endforeach


                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{asset($product->feature_image_path)}}" alt="" class="w-75">
                                </div>
                            </div>

                            @foreach($product->images as $i)
                                <div class="tab-pane " id="tabs-{{$i->id}}" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="{{asset($i->image_path)}}" alt="" class="w-75">
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{$product->name}}</h4>
                            <h3>${{ number_format($product->price)}}.00</h3>
                            {!! $product->content !!}
                            <form action="{{route('cart.add')}}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="product__details__option">
                                    <div class="product__details__option__size">
                                        <span>Size:</span>
                                        <label for="xxl">xxl
                                            <input type="radio" name="size" value="xxl" id="xxl" >
                                        </label>
                                        <label class="active" for="xl">xl
                                            <input type="radio" name="size" value="xl" id="xl" checked>
                                        </label>
                                        <label for="l">l
                                            <input type="radio" name="size" value="l" id="l">
                                        </label>
                                        <label for="sm">s
                                            <input type="radio" name="size" value="s" id="sm">
                                        </label>
                                    </div>
                                </div>
                                <div class="product__details__cart__option">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" name="quantity"  value="1" id="quantity">
                                        </div>
                                    </div>
                                    <button href="" class="primary-btn">add to cart</button>
                                </div>
                            </form>



                            <div class="product__details__btns__option">
                                <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                            </div>
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="{{asset('manfashion/img/shop-details/details-payment.png')}}')}}" alt="">
                                <ul>
                                    <li><span>Inventory:</span> {{$product->inventory}}</li>
                                    <li><span>Categories:</span> {{$product->category->name}}</li>
                                    <li>
                                        <span>Tag:</span>

                                        @foreach($product->tags as $tagi)
                                            {{$tagi->name}}
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <div class="row">

                @foreach($product->relatedProduct($product->category_id,$product->id) as $proi)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg"
                                 data-setbg="{{asset($proi->feature_image_path)}}">
                                <ul class="product__hover">
                                    <li><a href="#"><img src="{{asset('manfashion/img/icon/search.png')}}" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>{{$proi->name}}</h6>
                                <a href="#" class="add-cart">+ Add To Cart</a>
                                <h5>${{$proi->price}}.00</h5>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Related Section End -->

@endsection
