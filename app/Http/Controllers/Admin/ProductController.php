<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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

        'description'=>$request->description
    ]);
    session()->flash('add_product','success');
    return redirect(route('admin.product.edit',$product->id));

    }
    public function update(Product $product,Request $request){
        
        if($request->hasFile('avatar')){
            unlink($product->avatar);
          $filename= time().'-'.$request->avatar->getClientOriginalName();  
       
        
          
        $path = $request->avatar->storeAs('public/images', $filename);
      
        

        }else{
            $filename=$product->avatar;
        }
        $product->update([
            'name'=>$request->name,
        'price'=>$request->price,
        'highlight'=>$request->highlight,
        'quantity'=>$request->quantity,
        'avatar'=>$filename,
        'description'=>$request->description
        ]);
        
        session()->flash('edit_product','success');
        return redirect()->back();
    }
    public function destroy(Product $product){
        $product->delete();
        Storage::delete('/public/images/'.$product->avatar);
        return response()->json([], 204);
    }
}
