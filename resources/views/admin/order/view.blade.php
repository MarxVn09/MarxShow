@extends('layout.admin')

@section('title')
    <title>Menu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'Menu','key'=>'Edit'])


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="{{route('menus.update',['id'=>$menu->id])}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name Menu</label>
                                <input class="form-control"
                                       name="name"
                                       value="{{$menu->name}}"
                                       placeholder="Name Menu">
                            </div>
                            <div class="mb-3">
                                <select class="form-select form-control" name="parent_id">
                                    <option value="0">Select Parent Menu</option>
                                    {!! $html !!}
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
