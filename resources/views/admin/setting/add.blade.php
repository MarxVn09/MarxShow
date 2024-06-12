@extends('layout.admin')

@section('title')
    <title>Slider</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/admins/setting/add/add.css')}}" type="text/css"/>

@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'Setting','key'=>'Add'])


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="{{route('setting.store').'?type='.request()->type}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Config Key</label>
                                <input class="form-control @error('config_key')is-invalid @enderror "
                                       name="config_key"
                                       placeholder="Config Key"
                                       value="{{old('config_key')}}"
                                >
                                @error('config_key')
                                <div class="alert alert-danger validation_css">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Config Value</label>
                            @if(request()->type  ==='text')

                                    <input class="form-control @error('config_value')is-invalid @enderror "
                                           name="config_value"
                                           placeholder="Config Value"
                                           value="{{old('config_value')}}"
                                    >
                                @elseif(request()->type  ==='textarea')
                                    <textarea
                                            class="form-control @error('config_value')is-invalid @enderror "
                                           name="config_value"
                                           placeholder="Config Value"
                                    >
                                        {{old('config_value')}}
                                    </textarea>

                            @endif
                                @error('config_value')
                                <div class="alert alert-danger validation_css">{{$message}}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
