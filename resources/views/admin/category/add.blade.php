@extends('layout.admin')

@section('title')
    <title>Category</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/admins/category/add/add.css')}}" type="text/css" />

@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'Category','key'=>'Add'])


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="{{route('categories.store')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name Category</label>
                                <input class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       placeholder="Name Category"
                                       value="{{old('name')}}">
                                @error('name')
                                <div class="alert alert-danger validation_css">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <select class="form-select form-control" name="parent_id">
                                    <option value="0">Select Parent Category</option>
                                    {!! $htmlOption !!}
                                </select>

                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
