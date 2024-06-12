@extends('layout.admin')

@section('title')
    <title>User</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/admins/slider/index/index.css')}}" type="text/css"/>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'User','key'=>'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @can('user-add')
                        <div class="col-lg-12">
                            <a href="{{route('users.creat')}}" class="btn btn-primary float-right mb-3">Add
                                User</a>
                        </div>
                    @endcan
                    <div class="col-lg-12">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                @canany(['user-edit','user-delete'])
                                    <th scope="col">Action</th>
                                @endcanany


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $i)
                                <tr>
                                    <td>{{$i->id}}</td>
                                    <td>{{ $i->name }}</td>
                                    <td class="">{{ $i->email }}</td>
                                    @canany(['user-edit','user-delete'])
                                        <td>
                                            @can('user-edit')
                                                <a href="{{route('users.edit',['id'=>$i->id])}}" class="btn btn-primary">Edit</a>
                                            @endcan
                                            @can('user-delete')
                                                <a href=""
                                                   data-url="{{route('users.delete',['id'=>$i->id])}}"
                                                   class="btn btn-danger delete_button ">Delete</a>
                                            @endcan

                                        </td>
                                    @endcanany

                                </tr>
                            @endforeach


                            </tbody>
                        </table>

                    </div>
                    <div class=" col-lg-12">
                        {{$users->links()}}
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


