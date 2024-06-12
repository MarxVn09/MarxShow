@extends('layout.site')

@section('content')
    <h1>POST</h1>
    <hr>

        <div class="mx-5">
            <h6>{{$i->name}}</h6>
            <p>{{$i->content}}</p>
            <h6>{{$i->created_at}}</h6>
            <hr>
        </div>
    <a href="{{route('post.index')}}" class="btn btn-success">Back</a>
@endsection
