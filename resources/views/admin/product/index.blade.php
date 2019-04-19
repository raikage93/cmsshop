@extends('admin.layouts.main')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Danh sách sản phẩm</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách sản phẩm</h1>
        </div>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="panel panel-primary">

                <div class="panel-body">
                    <div class="bootstrap-table">
                        <div class="table-responsive">
                           
                            <a href="{{route('admin.product.create')}}" class="btn btn-primary">Thêm sản phẩm</a>
                            <table class="table table-bordered" style="margin-top:20px;">

                                <thead>
                                    <tr class="bg-primary">
                                        <th>TT</th>
                                        <th>Thông tin sản phẩm</th>
                                        <th>Giá sản phẩm</th>
                                        <th>Tình trạng</th>
                                        <th>Danh mục</th>
                                        <th width='18%'>Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($products as $prd)
                                        <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-3"><img src="img/ao-khoac.jpg" alt="Áo đẹp" width="100px" class="thumbnail"></div>
                                                        <div class="col-md-9">
                                                            
                                                            <p>Tên sản phẩm :{{$prd->name}}</p>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{$prd->price}} VND</td>
                                                <td>
                                                    <a class="btn {{$prd->quantity>0?'btn-success':'btn-danger'}}"  role="button">{{$prd->quantity>0?'Còn Hàng':'Hết hàng'}}</a>
                                                </td>
                                                <td>Áo Khoác Nam</td>
                                                <td>
                                                    <a href="{{route('admin.product.edit',$prd->id)}}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
                                                    <a href="#" class="btn btn-danger btn-delete" data-id="{{$prd->id}}"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                
                                    
                                   


                                </tbody>
                            </table>
                            <div align='right'>
                                {{$products->links()}}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
            <!--/.row-->


        </div>
    </div>
</div>
<script
  src="https://code.jquery.com/jquery-3.4.0.js"
  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
  crossorigin="anonymous"></script>
  <script>
      $(document).ready(function(){
        $('.btn-delete').click(function(e){
            e.preventDefault();
           if(confirm('Are you sure')){
            let produc_id=$(this).attr('data-id');
            console.log(produc_id);
            $.ajax({
                url:'/admin/products/'+produc_id,
                method:'POST',
                data:{
                    _token:"{{csrf_token()}}",
                    _method:'DELETE'
                },
                success:function(){
                    window.location.reload();
                }
            });
           }
        });
      });
  </script>
@endsection