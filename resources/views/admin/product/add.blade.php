@extends('layout.admin')

@section('title')
    <title>Product</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/vendors/select2/select2.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/admins/product/add/add.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/vendors/node_modules/froala-editor/css/froala_editor.pkgd.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/vendors/node_modules/froala-editor/css/plugins/image_manager.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/vendors/node_modules/froala-editor/css/third_party/image_tui.min.css')}}" type="text/css" />
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'Product','key'=>'Add'])

        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                        @csrf
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Name Product</label>
                                <input class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       placeholder="Name Product"
                                       value="{{old('name')}}"
                                >
                                @error('name')
                                <div class="alert alert-danger validation_css">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price Product</label>
                                <input class="form-control @error('price') is-invalid @enderror"
                                       name="price"
                                       placeholder="Price Product"
                                       value="{{old('price')}}"
                                >
                                @error('price')
                                <div class="alert alert-danger validation_css">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Inventory Product</label>
                                <input class="form-control "
                                       name="inventory"
                                       placeholder="If Inventory is null that is 200"
                                       value="200"
                                >
{{--                                @error('price')--}}
{{--                                <div class="alert alert-danger validation_css">{{ $message }}</div>--}}
{{--                                @enderror--}}
                            </div>
                            <div class="input-group mb-3">
                                <label for="main_img" class="mb-1">Main Image</label>
                                <input type="file" class="form-control-file" name="product_image_path" id="main_img">

                            </div>
                            <div class="input-group mb-3">
                                <label for="main_img" class="mb-1">Image detail</label>
                                <input type="file" class="form-control-file" name="image_path[]" id="img_detail" multiple="multiple">
                            </div>
                            <div class="mb-3">
                                <label>Choose Tags </label>
                                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
                                </select>
                            </div>
                            <div class="mb-3">
                                <select class="form-select form-control select2_init @error('category_id') is-invalid @enderror" name="category_id"
                                        multiple="multiple">
                                    <option value="0">Select Category</option>
                                    {!! $htmlOption !!}
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger validation_css">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                </div>

            </div>
        </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="contents">Content</label>

                    <textarea id="contents" rows="3" name="contents" class="@error('contents') is-invalid @enderror" >
                        {{old('contents')}}
                    </textarea>
                    @error('contents')
                    <div class="alert alert-danger validation_css">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{asset('/vendors/select2/select2.min.js')}}"></script>
    <script src="{{asset('/vendors/node_modules/froala-editor/js/froala_editor.pkgd.min.js')}}"></script>
    <script src="{{asset('/vendors/node_modules/froala-editor/js/plugins/image_manager.min.js')}}"></script>
    <script src="{{asset('/vendors/node_modules/froala-editor/js/plugins/files_manager.min.js')}}"></script>
    <script src="{{asset('/vendors/node_modules/froala-editor/js/third_party/image_tui.min.js')}}"></script>
    <script src="{{asset('/admins/product/add/add.js')}}"></script>
@endsection
