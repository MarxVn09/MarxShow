@extends('layout.admin')

@section('title')
    <title>Slider</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/admins/slider/index/index.css')}}" type="text/css"/>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'Slider','key'=>'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="{{route('sliders.creat')}}" class="btn btn-primary float-right mb-3">Add
                            Slider</a>

                    </div>
                    <div class="col-lg-12">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $i)
                                <tr>
                                    <td>{{$i->id}}</td>
                                    <td>{{ $i->name }}</td>
                                    <td>
                                        <img src="{{ $i->image_path }}" alt="" class="img_150_100">
                                    </td>
                                    <td class="">{{ $i->description }}</td>
                                    <td>
                                        <a href="{{route('sliders.edit',['id'=>$i->id])}}" class="btn btn-primary">Edit</a>
                                        <a href=""
                                           data-url="{{route('sliders.delete',['id'=>$i->id])}}"
                                           class="btn btn-danger delete_button ">Delete</a>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>

                    </div>
                    <div class=" col-lg-12">
                        {{$sliders->links()}}
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
@section('js')
    <script src="{{asset('/vendors/sweetalert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('/admins/main.js')}}"></script>
@endsection


