@extends('layout.admin')

@section('title')
    <title>User</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/vendors/select2/select2.min.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('/admins/user/add/add.css')}}" type="text/css"/>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'Role','key'=>'Add'])


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{route('roles.store')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       placeholder="Name"
                                       value="{{old('name')}}"
                                >
                                @error('name')
                                <div class="alert alert-danger validation_css">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Detail of Role</label>
                                <textarea class="form-control @error('display_name') is-invalid @enderror"
                                          name="display_name"
                                >{{old('display_name')}}
                                </textarea>
                                @error('display_name')
                                <div class="alert alert-danger validation_css">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="">
                                            <input type="checkbox" class="check_all">
                                            All
                                        </label>
                                    </div>
                                    @foreach($permissionParent as $i)
                                        <div class="card border-primary mb-3 col-lg-12 p-0">
                                            <div class="card-header bg-blue">
                                                <label for="">
                                                    <input type="checkbox" name="" class="checkBox_wrapper" >
                                                    Modul {{$i->name}}
                                                </label>
                                            </div>
                                            <div class="card-body text-primary">
                                                <div class="row">
                                                    @foreach($i->permissionsChildrent as $item)

                                                        <h5 class="card-title col-lg-3">
                                                            <label for="">
                                                                <input type="checkbox" name="permission_id[]" class="checkBox_childrent"
                                                                       value="{{$item->id}}">
                                                                {{$item->name}}
                                                            </label>
                                                        </h5>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mb-4">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
@section('js')
    <script src="{{asset('admins/role/add/add.js')}}"></script>
@endsection
