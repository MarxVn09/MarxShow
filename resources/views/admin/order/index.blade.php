@extends('layout.admin')

@section('title')
    <title>Menu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'Menu','key'=>'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @can('menu-add')
                        <div class="col-lg-12">
                            <a href="{{route('menus.creat')}}" class="btn btn-primary float-right mb-3">Add Menu</a>
                        </div>
                    @endcan


                    <div class="col-lg-12">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                @canany(['menu-edit','menu-delete'])
                                    <th scope="col">Action</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($menus as $i)
                                <tr>
                                    <td>{{$i->id}}</td>
                                    <td>{{ $i->name }}</td>
                                    @canany(['menu-edit','menu-delete'])
                                        <td>
                                            @can('menu-edit')
                                                <a href="{{route('menus.edit',['id'=>$i->id])}}"
                                                   class="btn btn-primary">Edit</a>
                                            @endcan
                                            @can('menu-delete')
                                                <a href="{{route('menus.delete',['id'=>$i->id])}}"
                                                   class="btn btn-danger ">Delete</a>

                                            @endcan
                                        </td>
                                    @endcanany

                                </tr>
                            @endforeach


                            </tbody>
                        </table>

                    </div>
                    <div class=" col-lg-12">
                        {{$menus->links()}}
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection



