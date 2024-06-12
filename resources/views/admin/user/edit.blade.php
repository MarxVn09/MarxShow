@extends('layout.admin')

@section('title')
    <title>User</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/vendors/select2/select2.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/admins/user/add/add.css')}}" type="text/css" />
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'User','key'=>'Edit'])


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="{{route('users.update',['id'=>$user->id])}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control "
                                       name="name"
                                       placeholder="Name"
                                       value="{{$user->name}}"
                                >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input class="form-control "
                                       name="email"
                                       type="email"
                                       placeholder="Email"
                                       value="{{$user->email}}"
                                >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input class="form-control "
                                       name="password"
                                       type="password"
                                       placeholder="Password"
                                >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Select Role</label>
                                <select name="role_id[]" class="form-control select2_int " multiple="multiple">
                                    @foreach($roles as $i)
                                        <option
                                            {{$roleOfUser->contains('id', $i->id) ?'selected': '' }}
                                            value="{{$i->id}}">{{$i->name}}
                                        </option>
                                    @endforeach


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
@section('js')
    <script src="{{asset('/vendors/select2/select2.min.js')}}"></script>
    <script >
        $('.select2_int').select2({
            'placeholder':'Select Role'
        })
    </script>
@endsection
