@extends('layout.admin')

@section('title')
    <title>Product</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/admins/product/index/index.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('/vendors/select2/select2.min.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('/vendors/node_modules/froala-editor/css/froala_editor.pkgd.min.css')}}"
          type="text/css"/>
    <link rel="stylesheet" href="{{asset('/vendors/node_modules/froala-editor/css/plugins/image_manager.min.css')}}"
          type="text/css"/>
    <link rel="stylesheet" href="{{asset('/vendors/node_modules/froala-editor/css/third_party/image_tui.min.css')}}"
          type="text/css"/>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'Product','key'=>'Update'])

        <form action="{{route('product.update',['id'=>$product->id])}}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                        @csrf
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Name Product</label>
                                <input class="form-control"
                                       name="name"
                                       value="{{$product->name}}"
                                       placeholder="Name Product">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price Product</label>
                                <input class="form-control"
                                       name="price"
                                       value="{{$product->price}}"
                                       placeholder="Price Product">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Inventory Product</label>
                                <input class="form-control"
                                       name="inventory"
                                       type="number"
                                       value="{{$product->inventory}}"
                                       min="{{$product->inventory}}"
                                       placeholder="Inventory Product">
                            </div>
                            <div class="input-group mb-3">
                                <label for="main_img" class="mb-1">Main Image</label>
                                <input type="file" class="form-control-file" name="product_image_path" id="main_img">
                                <div class="col-lg-6 mt-3">
                                    <img src="{{$product->feature_image_path}}" class="image_product_150_100" alt="">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="main_img" class="mb-1">Image detail</label>
                                <input type="file" class="form-control-file" name="image_path[]" id="img_detail"
                                       multiple="multiple">
                                <div class="col-lg-12">
                                    <div class="row mt-3 ">
                                        @foreach($product->images as $imageItem)
                                            <div class="col-lg-3">
                                                <img src="{{$imageItem->image_path}}" class="image_product_100_100_detail mx-2" alt="">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>Choose Tags</label>
                                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
                                    @foreach($product->tags as $tagItem)
                                        <option value="{{$tagItem->name}}" selected>{{$tagItem->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <select class="form-select form-control select2_init" name="category_id"
                                        multiple="multiple">
                                    <option value="0">Select Category</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="contents">Content</label>
                    <textarea id="contents" rows="3" name="contents">{{$product->content}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{asset('/vendors/select2/select2.min.js')}}"></script>
    {{--    <script src="{{asset('/vendors/tinymce/js/tinymce/tinymce.min.js')}}" referrerpolicy="origin"></script>--}}
    <script src="{{asset('/vendors/node_modules/froala-editor/js/froala_editor.pkgd.min.js')}}"></script>
    <script src="{{asset('/vendors/node_modules/froala-editor/js/plugins/image_manager.min.js')}}"></script>
    <script src="{{asset('/vendors/node_modules/froala-editor/js/plugins/files_manager.min.js')}}"></script>
    <script src="{{asset('/vendors/node_modules/froala-editor/js/third_party/image_tui.min.js')}}"></script>

    <script src="{{asset('/admins/product/add/add.js')}}"></script>
@endsection
