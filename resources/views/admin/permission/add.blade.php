@extends('layout.admin')

@section('title')
    <title>Permission</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/admins/menu/add/add.css')}}" type="text/css" />

@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'Permission','key'=>'Add'])


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{route('permission.storePermission')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="">Select Permission you need add</label>
                                <select class="form-select form-control" name="module_name">
                                    <option value="">Select module</option>
                                    @foreach(config('permissions.table_module') as $i)
                                        <option value="{{$i}}">{{ucfirst($i)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    @foreach(config('permissions.module_child') as $i)
                                        <div class="col-lg-3">
                                            <label for="">
                                                <input type="checkbox" value="{{$i}}" name="module_child[]">
                                                {{ucfirst($i)}}
                                            </label>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
