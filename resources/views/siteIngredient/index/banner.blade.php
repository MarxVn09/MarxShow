<!-- Banner Section Begin -->
<section class="banner spad">
    <div class="container">
        <div class="row">
            @foreach($banners as $i)
                <div class="{{$i->break_point}}">
                    <div class="banner__item banner__item--{{$i->location_in_site}}">
                        <div class="banner__item__pic ">
                            <img src="{{asset($i->image_path)}}" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>{{$i->name}}</h2>
                            <a href="">Shop now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Banner Section End -->
