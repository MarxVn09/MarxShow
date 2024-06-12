@extends('layout.admin')

@section('title')
    <title>Role</title>
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'Role','key'=>'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @can('role-add')

                    @endcan
                    <div class="col-lg-12">
                        <a href="{{route('roles.creat')}}" class="btn btn-primary float-right mb-3">Add
                            Role</a>
                    </div>
                    <div class="col-lg-12">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Role</th>
                                <th scope="col">Detail of Role</th>
                                @canany(['role-edit','role-delete'])
                                    <th scope="col">Action</th>
                                @endcanany

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $i)
                                <tr>
                                    <td>{{$i->id}}</td>
                                    <td>{{ $i->name }}</td>
                                    <td class="">{{ $i->display_name }}</td>
                                    @canany(['role-edit','role-delete'])
                                        <td>
                                            @can('role-edit')
                                                <a href="{{route('roles.edit',['id'=>$i->id])}}"
                                                   class="btn btn-primary">Edit</a>
                                            @endcan
                                            @can('role-delete')
                                                <a href=""
                                                   data-url="{{route('roles.delete',['id'=>$i->id])}}"
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
                        {{$roles->links()}}
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


