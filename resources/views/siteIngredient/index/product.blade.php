<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">Best Sellers</li>
                    <li data-filter=".new-arrivals">New Arrivals</li>
                    <li data-filter=".hot-sales">Hot Sales</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            @foreach($newAndHotProducts as $i)

                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix
                @if($loop->index %2==0)
                new-arrivals
                @else
                hot-sales
                @endif
                ">
                    <div class="product__item">
                        <div class="product__item__pic set-bg"
                             data-setbg="{{$i->feature_image_path}}">

                            <ul class="product__hover">
                                <li><a href="{{route('product.detail',['id'=>$i->id])}}"><img src="{{asset('manfashion/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{$i->name}}</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <h5>${{$i->price}}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Product Section End -->
