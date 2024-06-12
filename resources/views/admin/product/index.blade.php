@extends('layout.admin')

@section('title')
    <title>Product</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/admins/product/index/index.css')}}" type="text/css"/>

@endsection
@section('js')
    <script src="{{asset('/vendors/sweetalert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('/admins/main.js')}}"></script>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'Product','key'=>'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @can('product-add')
                        <div class="col-lg-12">
                            <a href="{{route('product.creat')}}" class="btn btn-primary float-right mb-3">Add
                                Product</a>
                        </div>
                    @endcan

                    <div class="col-lg-12">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Price</th>
                                <th scope="col">Category</th>
                                @foreach($products as $i)
                                @canany(['product-edit','product-delete'],[$i->id])
                                    <th scope="col">Action</th>
                                    @break
                                @endcanany
                                @endforeach

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <th scope="row">{{$product->id}}</th>
                                    <td>{{$product->name}}</td>
                                    <td>

                                        <img src="{{$product->feature_image_path}}" alt=""
                                             class="image_product_150_100">
                                    </td>
                                    <td>{{number_format($product->price)}}</td>
                                    <td>{{optional($product->category)->name}}</td>
                                    @canany(['product-edit','product-delete'],[$product->id])
                                        <td>
                                            @can('product-edit',[$product->id])
                                                <a href="{{route('product.edit',['id'=>$product->id])}}"
                                                   class="btn btn-primary">Edit</a>
                                            @endcan
                                            @can('product-delete')
                                                <a href=""
                                                   data-url="{{route('product.delete',['id'=>$product->id])}}"
                                                   class="btn btn-danger delete_button">Delete</a>
                                            @endcan

                                        </td>
                                    @endcanany

                                </tr>
                            @endforeach


                            </tbody>
                        </table>

                    </div>
                    <div class=" col-lg-12">
                        {{
                            $products->links()
                        }}
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection


