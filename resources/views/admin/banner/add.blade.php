@extends('layout.admin')

@section('title')
    <title>Banner</title>
@endsection
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'Banner','key'=>'Add'])


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="{{route('banner.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name Banner</label>
                                <input class="form-control"
                                       name="name"
                                       placeholder="Name Banner"
                                >
                            </div>
                            <div class="form-group">
                                <label class="form-label">Local </label>
                                <select class="form-control" name="location_in_site">
                                    <option value="first" {{$first}}>First</option>
                                    <option value="middle" {{$middle}}>Middle</option>
                                    <option value="last"  {{$last}} >Last</option>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <label for="main_img" class="mb-1">Image</label>
                                <input type="file" class="form-control-file"
                                       name="image_path"
                                >
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
