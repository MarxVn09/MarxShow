<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductSiteController extends Controller
{
    private $product;
    public function __construct(Product $product)
    {
        $this->product=$product;
    }

    public function productDetail($id)
    {
        $product =$this->product->find($id);
//        dd( $product->relatedProduct($product->category_id,$product->id));

        return view('site.product.detail',compact('product'));
    }
}
