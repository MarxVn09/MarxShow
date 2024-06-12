@extends('layout.admin')

@section('title')
    <title>Category</title>
@endsection
@section('js')
    <script src="{{asset('/vendors/sweetalert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('/admins/main.js')}}"></script>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'Category','key'=>'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @can('category-add')
                        <div class="col-lg-12">
                            <a href="{{route('categories.creat')}}" class="btn btn-primary float-right mb-3">Add
                                Category</a>

                        </div>
                    @endcan

                    <div class="col-lg-12">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                @canany(['category-edit','category-delete'])
                                    <th scope="col">Action</th>
                                @endcanany


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $i)
                                <tr>
                                    <td>{{$i->id}}</td>
                                    <td>{{ $i->name }}</td>
                                    @canany(['category-edit','category-delete'])
                                        <td>
                                            @can('category-edit')
                                                <a href="{{route('categories.edit',['id'=>$i->id])}}"
                                                   class="btn btn-primary">Sửa</a>
                                            @endcan
                                            @can('category-delete')
                                                <a data-url="{{route('categories.delete',['id'=>$i->id])}}"
                                                    href=""

                                                   class="btn btn-danger delete_button">Xóa</a>
                                            @endcan

                                        </td>
                                    @endcanany

                                </tr>
                            @endforeach


                            </tbody>
                        </table>

                    </div>
                    <div class=" col-lg-12">
                        {{$categories->links()}}
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection


