<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;

class CartSiteController extends Controller
{
    private $cart;
    private $cart_detail;
    private $order;
    private $orderDetail;
    public function __construct(Cart $cart, CartDetail $cart_detail,Order $order, OrderDetail $orderDetail)
    {
        $this->cart=$cart;
        $this->cart_detail=$cart_detail;
        $this->order=$order;
        $this->orderDetail=$orderDetail;
    }

    public function  index()
        {
            $user =auth('site')->user();
            $cart  = $this->cart->where('id_user',$user->id)->first();
            return view('site.cart.index',compact('cart'));
        }
        public function addToCart(Request $request)
        {
            $user =auth('site')->user();
            $cartCheck  = $this->cart->where('id_user',$user->id)->first();
            if($request->quantity<1){
                return back()->with('error','you need choose quantity');
            }
            if(!$cartCheck){
                $this->cart->create([
                    'id_user'=>$user->id,
                ]);
            }
            $cart = $this->cart->where('id_user',$user->id)->first();
            $product_check =$this->cart_detail->where('cart_id',$cart->id)->where('product_id',$request->product_id)->where('size',$request->size)->first();
            if($product_check){
                $this->cart_detail->find($product_check->id)->update([
                    'quantity'=>$product_check->quantity+$request->quantity
                    ]);
            }else{
                $this->cart_detail->create([
                    'product_id'=>$request->product_id,
                    'cart_id'=>$cart->id,
                    'quantity'=>$request->quantity,
                    'size'=>$request->size
                ]);
            }

            return redirect()->to(\route('cart.index'));
        }
    public function updateCart(Request $request)
    {
        $cartDetail = CartDetail::find($request->id);
        if ($cartDetail) {
            $cartDetail->quantity = $request->quantity;
            $cartDetail->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Cart item not found']);
        }
    }
    public function removeCartItem(Request $request)
    {
        $cartDetail = CartDetail::find($request->id);
        if ($cartDetail) {
            $cartDetail->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Cart item not found']);
        }
    }
    public function checkOut()
    {
        $user =auth('site')->user();
        $cart  = $this->cart->where('id_user',$user->id)->first();
        $total=0;
        return view('site.cart.check-out',compact('cart','total'));
    }
    public function checkOutPost(Request $request)
    {
        $user =auth('site')->user();
        $code =Str::random(10).auth('site')->user()->id;
        $address=$request->address.', '.$request->city.', '.$request->country;
        $name =$request->first_name.' '.$request->last_name;
        $status = 'confirmed';
        $total =0;
        $order=$this->order->create([
            'code_order'=>$code,
            'address'=>$address,
            'name'=>$name,
            'payment_method'=>$request->payment_method,
            'phone_number'=>$request->phone,
            'status'=>$status,
            'id_user'=>$user->id,
            'note'=>$request->note ,
            'total'=>$total
        ]);

        $cart  = $this->cart->where('id_user',$user->id)->first();
        foreach ($cart->cart_details as $i){
            $this->orderDetail->create([
                'product_id'=>$i->product_id,
                'quantity'=>$i->quantity,
                'order_id'=>$order->id
            ]);
            $total+=$i->getProduct($i->product_id)->price*$i->quantity;
            $this->cart_detail->find($i->id)->delete();
        }
        if($total<50){
            $total+=2;
        }
        $this->order->find($order->id)->update([
            'total'=>$total
        ]);
        return redirect()->to(\route('user.profile'));
    }
}
