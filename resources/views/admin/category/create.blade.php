@extends('admin.layouts.main')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Icons</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý danh mục</h1>
        </div>
    </div>
    <!--/.row-->


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        @if (session('success'))
                        <div class="alert bg-success" role="alert">
                                <svg class="glyph stroked checkmark">
                                    <use xlink:href="#stroked-checkmark"></use>
                                </svg> Đã thêm danh mục thành công! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <form action="{{route('admin.category.store')}}" method="POST">
                                @csrf
                           

                            <div class="form-group">
                                <label for="">Danh mục cha:</label>
                                <select class="form-control" name="parent" >
                                    <option value="0">----ROOT----</option>
                                    @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @php
                              if(!is_null($category->sub)){
                                  printSubCategories($category->sub,1);
                              }
                          @endphp
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tên Danh mục</label>
                                <input type="text" class="form-control" name="name"  placeholder="Tên danh mục mới" required>
                                @if (count($errors)>0)
                                <div class="alert bg-danger" role="alert">
                                        <svg class="glyph stroked cancel">
                                            <use xlink:href="#stroked-cancel"></use>
                                        </svg>Tên danh mục đã tồn tại!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Tao danh mục</button>
                        </form>
                        </div>
                        
                    </div>
                </div>
            </div>



        </div>
        <!--/.col-->


    </div>
    <!--/.row-->
</div>
@endsection
@php
  function  printSubCategories($categories,$nth){
        foreach ($categories as $category) {
            echo '
            <option value="'.$category->id.'">'.printMark($nth).$category->name.'</option>
            ';
            if(!is_null($category->sub)){
                printSubCategories($category->sub,$nth+1);
            }
        }
    }
 function printMark($times){
     $mark='';
     for($i=0;$i<$times;$i++){
         $mark.='---|';}
         return $mark;
     }
 
@endphp