<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;
use App\Model\Order;
use App\Model\OrderDetail;
class CartController extends Controller
{
    public function index(){
        // Cart::clear();
        $carts=Cart::getContent();
 return view('client.cart',compact('carts'));
    }
    public function checkout(){
        return view('client.checkout');
    }
    public function store(Request $request){
        
      $order=  Order::create($request->all());
      $order->status='wait';
      $order->save();
        $carts=Cart::getContent();
        foreach ($carts as $key => $value) {
            $order->order_details()->create(
                [
                    'product_id'=>$value['id'],
                    'quantity'=>$value['quantity']
                ]
            );
        }
    return view('client.success');
    }
    public function add(Request $request){
        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => [
                'size'=>$request->size,
                'color'=>$request->color
            ]
 
        ]);
        return back();
    }
    public function update(Request $request){
   
        foreach ($request->except('_token') as $key => $value) {
            Cart::update($key,array(
                'quantity'=>array(
                    'relative'=>false,
                    'value'=>$value
                )
            ));
        };
        $carts=Cart::getContent();
        return view('client.table_cart',compact('carts'))->render();
     
        
        // $old_quantity= Cart::get($request->id)->quantity;
        // Cart::update($request->id,[
        //     'quantity'=>($request->quantity-$old_quantity)
        // ]);
        // return back();

    }
    public function destroy(Request $request){
        Cart::remove($request->id);
        $carts=Cart::getContent();
        return view('client.table_cart',compact('carts'))->render();
    }
}
