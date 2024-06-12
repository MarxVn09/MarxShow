<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;

class ShopController extends Controller
{
    private $product;
private $category;
private $tag;

    public function __construct(Product $product,Category $category)
    {
        $this->product = $product;
        $this->category=$category;
    }

    public function index()
    {
        $categories = $this->category->where('parent_id',0)->get();
        $products = $this->product->latest()->paginate(12);
        return view('site.shop.index', compact('products','categories'));
    }
    public function getByCategory($slug)
    {
        $category_id = $this->category->where('slug',$slug)->first();
        $categories = $this->category->where('parent_id',0)->get();
        $products = $this->product->where('category_id',$category_id->id)->latest()->paginate(12);
        return view('site.shop.productOfCategory',compact('products','categories'));
    }
}
