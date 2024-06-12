@extends('layout.admin')

@section('title')
    <title>Slider</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/admins/slider/add/add.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/admins/slider/edit/edit.css')}}" type="text/css" />

@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'Slider','key'=>'Edit'])


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="{{route('sliders.update',['id'=>$slider->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name Slider</label>
                                <input class="form-control @error('name')is-invalid @enderror "
                                       name="name"
                                       placeholder="Name Slider"
                                       value="{{$slider->name}}"
                                >
                                @error('name')
                                <div class="alert alert-danger validation_css">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea
                                    class="form-control @error('description')is-invalid @enderror"
                                    name="description"
                                    rows="3"
                                    cols="3"
                                >
                                    {{$slider->description}}
                                </textarea>
                                @error('description')
                                <div class="alert alert-danger validation_css">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <label for="main_img" class="mb-1">Image</label>
                                <input type="file" class="form-control-file @error('image_path')is-invalid @enderror"
                                       name="image_path"
                                >
                                @error('image_path')
                                <div class="alert alert-danger validation_css">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg-12 mb-5">
                                <img src="{{$slider->image_path}}" class="w-100 rounded">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
