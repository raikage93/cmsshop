<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
class ProductController extends Controller
{
 public function detail( Product $product){
    
  return view('client.product',compact('product'));
 }
 public function shop(){
     $products=Product::paginate(6);
     return view('client.list-product',compact('products'));
 }
}
