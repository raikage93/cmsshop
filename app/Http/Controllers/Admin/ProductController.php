<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;

class ProductController extends Controller
{
    public function create(){
return view('admin.product.create');
    }
    public function index(){
        $products=Product::paginate(5);
 return view('admin.product.index',compact('products'));
    }
    public function edit(Product $product){

return view('admin.product.edit',compact('product'));
    }
    public function store(Request $request){
    $request->validate([
        'name'=>'required',
        'price'=>'required',

    ]);
    $product=Product::create([
        'name'=>$request->name,
        'price'=>$request->price,
        'highlight'=>$request->highlight,
        'quantity'=>$request->quantity,
        'avatar'=>$request->avatar,
        'description'=>$request->description
    ]);
    session()->flash('add_product','success');
    return redirect(route('admin.product.edit',$product->id));

    }
    public function update(Product $product,Request $request){
        $product->update($request->all());
        session()->flash('edit_product','success');
        return redirect()->back();
    }
    public function destroy(Product $product){
        $product->delete();
        return response()->json([], 204);
    }
}
