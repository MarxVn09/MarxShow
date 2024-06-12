
@foreach($categories as $i)
    @if($i->categoryChild->count())
        <div class="">
            <a class="btn p-0 w-100 text-left" data-toggle="collapse"
               data-target="#collapse{{$i->id}}">{{$i->name}}</a>
        </div>
        <div id="collapse{{$i->id}}" class="collapse show">
            @foreach($i->categoryChild as $iChild)
                <li class="ml-2"><a href="{{route('shop.product',['slug'=>$iChild->slug])}}">{{$iChild->name}}</a></li>
            @endforeach
        </div>
    @else
        <li><a href="{{route('shop.product',['slug'=>$i->slug])}}" class="">{{$i->name}}</a></li>
    @endif
@endforeach
