<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
private $order;
private $order_detail;
    public function __construct(Order $order,OrderDetail $order_detail)
    {
        $this->order=$order;
        $this->order_detail=$this->order_detail;
    }
    public function index()
    {
        $order=$this->order->latest()->paginate(6)->fragment('orders');
        return view('admin.order.index',compact('order'));
    }
    public function view($id)
    {
        $order =$this->order->find($id);
        return view('admin.order.view', compact('order'));
    }
    public function change(Request $request ,$id)
    {
        $status = $request->input('status');
        $this->order->find($id)->update([
            'status'=>$status
        ]);
        return redirect()->to(route('order.index'));
    }
}
