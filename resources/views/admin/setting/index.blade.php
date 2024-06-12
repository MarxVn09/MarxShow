@extends('layout.admin')

@section('title')
    <title>Slider</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/admins/slider/index/index.css')}}" type="text/css"/>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'Setting','key'=>'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @can('setting-add')
                        <div class="col-lg-12">
                            <div class="btn-group float-right mb-3">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                    Add setting
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('setting.creat').'?type=text'}}">As text</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{route('setting.creat').'?type=textarea'}}">As
                                            textarea</a></li>
                                </ul>
                            </div>
                        </div>
                    @endcan

                    <div class="col-lg-12">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Config Key</th>
                                <th scope="col">Config Value</th>
                                @canany(['setting-edit','setting-delete'])
                                    <th scope="col">Action</th>
                                @endcanany


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($settings as $i)
                                <tr>
                                    <td>{{$i->id}}</td>
                                    <td>{{ $i->config_key }}</td>
                                    <td class="">{{ $i->config_value }}</td>
                                    @canany(['setting-edit','setting-delete'])
                                        <td>
                                            @can('setting-edit')
                                                <a href="{{route('setting.edit',['id'=>$i->id]).'?type='.$i->type_setting}}"
                                                   class="btn btn-primary">Edit</a>
                                            @endcan
                                            @can('setting-delete')
                                                <a href=""
                                                   data-url="{{route('setting.delete',['id'=>$i->id])}}"
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
                        {{$settings->links()}}
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


