<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;

class OrderController extends Controller
{
    public function index(){
        $orders=Order::where('status','wait')->paginate(10);
        return view('admin.order.index',compact('orders'));

    }
    public function edit(Order $order){
        $order->load('order_details');

        return view('admin.order.edit',compact('order'));

    }
    public function processed(){
        return view('admin.order.processed');
    }
}
