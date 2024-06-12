@extends('layout.admin')

@section('title')
    <title>Banner</title>
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'Banner','key'=>'Edit'])


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="{{route('banner.update',['id'=>$banner->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name Banner</label>
                                <input class="form-control"
                                       name="name"
                                       placeholder="Name Banner"
                                       value="{{$banner->name}}"
                                >
                            </div>

                            <div class="input-group mb-3">
                                <label for="main_img" class="mb-1">Image</label>
                                <input type="file" class="form-control-file"
                                       name="image_path"
                                >
                            </div>
                            <div class="col-lg-12 mb-4">
                                <img src="{{asset($banner->image_path)}}" class="img_150_100" alt="">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
