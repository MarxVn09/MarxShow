<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    private $slider;
    private $banner;
    private $product;
    public function __construct(Slider $slider,Banner $banner,Product $product)
    {
        $this->slider=$slider;
        $this->banner=$banner;
        $this->product=$product;
    }

    public function index()
    {
        $sliders = $this->slider->all();
        $banners = $this->banner->all();
        $newAndHotProducts = $this->product->select('products.*')
            ->leftJoin('products AS hot', function ($join) {
                $join->on('products.id', '=', 'hot.id')
                    ->where('hot.created_at', '>', now()->subWeek());
            })
            ->orderBy('products.created_at', 'desc')
            ->limit(8)
            ->get();

        return view('site.index.index',compact('sliders','banners','newAndHotProducts'));
    }

}
