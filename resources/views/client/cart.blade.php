@extends('client.layouts.main')
@section('content')
<!-- main -->
<div class="colorlib-shop">
    <div class="container table-cart">
        @include('client.table_cart')
    </div>
</div>

<!-- end main -->
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>
        $(document).ready(function(){
            bindBtnUpdate();
            bindBtnDelete();
        });
     function bindBtnUpdate(){
        $('.btn-update').click(function(e){

            e.preventDefault();
            let data={};
            $('.input-number').each(function(index,element){
            let id=  $(this).attr('data-id');
               let value= $(this).val();
             data[id]=value;
            });
            data["_token"]="{{csrf_token()}}";
            console.log(data);
            $.ajax({
                url:'/gio-hang/update',
                method:'POST',
                data:data,
                success:function(scs){
                    $('.table-cart').html(scs);
                    bindBtnUpdate();
                }
            });
        });
     }
     function bindBtnDelete(){
        $('.btn-delete').click(function(e){

            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.value) {
                    let data={};
                    data["id"]=$(this).attr('data-id');
                    data["_token"]="{{csrf_token()}}";
                     $.ajax({
                         url:'/gio-hang/delete',
                         method:'POST',
                         data:data,
                         success:function(scs){
                             $('.table-cart').html(scs);
                             bindBtnDelete();
                         }
                     });
                }
              })
        
         
        });
     }
    </script>
@endpush