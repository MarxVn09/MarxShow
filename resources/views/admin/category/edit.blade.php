@extends('layout.admin')

@section('title')
    <title>Category</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'Category','key'=>'Edit'])


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="{{route('categories.update',['id'=>$category->id])}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name Category</label>
                                <input class="form-control"
                                       name="name"
                                       value="{{$category->name}}"
                                       placeholder="Name Category">

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
