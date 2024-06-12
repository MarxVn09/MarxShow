@extends('layout.site')

@section('content')
    <h1>POST @if(!empty($name_cat))
            {{$name_cat}}
        @endif</h1>
    <div class="row">
        <a href="{{route('post.view')}}" class="btn btn-primary mx-2">Most View</a>
        <a href="{{route('post.new')}}" class="btn btn-primary mx-2">New</a>
        <a href="{{route('post.cat',['id'=>1])}}" class="btn btn-primary mx-2">Category 1</a>
        <a href="{{route('post.cat',['id'=>2])}}" class="btn btn-primary mx-2">Category 2</a>
        <a href="{{route('post.cat',['id'=>3])}}" class="btn btn-primary mx-2">Category 3</a>

    </div>
    <hr>
    @foreach($posts as $i)
        <div class="mx-5">
            <h6>{{$i->name}}</h6>
            <p>{{$i->content}}</p>
            <small>{{$i->view}}View</small>|
            <small>{{$i->created_at}}</small>
            <a href="{{route('post.detail',['id'=>$i->id])}}" class="btn btn-primary">View</a>
            <hr>
        </div>
    @endforeach
@endsection
