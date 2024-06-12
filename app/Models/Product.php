<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class , 'product_tags','product_id','tag_id')->withTimestamps();
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function relatedProduct($category_id,$id)
    {
        $products = DB::table('products')
            ->where('category_id','=',$category_id)
            ->where('id','!=',$id)
            ->orderBy('created_at','desc')
            ->limit(4);
        return $products->get();
    }

}
