<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function getProduct($id)
    {
        return DB::table('products')->where('id',$id)->first();
    }
}
