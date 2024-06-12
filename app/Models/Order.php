<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class,'order_id');
    }
    public function getUser($id)
    {
        return DB::table('user_normals')->where('id',$id)->first();
    }
}
