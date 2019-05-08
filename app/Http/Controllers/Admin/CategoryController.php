<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;


class CategoryController extends Controller
{  
    private $array=array();
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $categories=Category::where('parent',0)->get()->map(function($query){
            $query->sub=$this->getChildCategories($query->id);
            return $query;

        });
       
        return view('admin.category.index',compact('categories'));
    }
    private function getChildCategories($parent){
       $categories= Category::where('parent',$parent)->get();
       if($categories->count()>0){
        $categories->map(function($query){
            $query->sub=$this->getChildCategories($query->id);
            return $query;
        });

           return $categories;
       }
       return null;
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::where('parent',0)->get()->map(function($query){
            $query->sub=$this->getChildCategories($query->id);
            return $query;

        });
        return view('admin.category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    
    {
        $request->validate([
            'name'=>'unique:categories,name'
        ]);
      $category=  Category::create([
            'name'=>$request->name,
            'parent'=>$request->parent,

        ]);
        return redirect(route('admin.category.edit',$category->id))->with('create','Create Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $categories=Category::where('parent',0)->get()->map(function($query){
            $query->sub=$this->getChildCategories($query->id);
            return $query;

        });
        $categories_edit=Category::find($id);
        
           
        return view('admin.category.edit',compact('categories','categories_edit'));
    }
    public function getListCategory($parent){
      
        $categories=Category::where('parent',$parent)->get();
        if($categories->count()>0){
            foreach ($categories as $category) {
               array_push($this->array,$category->id);
                $this->getListCategory($category->id);
            }
           
        }
       
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)

    {
      
            $request->validate([
                'name'=>'unique:categories,name'
            ]);
      
        $category=Category::find($id);
        $category->update(['name'=>$request->name]);
        return back()->with('success','Update Thanh Cong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        array_push($this->array,$id);
      

        $array_new=$this->getListCategory($id);
        // session()->flush();
    
        foreach ($this->array as $id) {
            $category=Category::find($id);
            $category->delete();
        }
        return back();
    }
}
