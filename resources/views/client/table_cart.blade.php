<div class="row row-pb-md">
    <div class="col-md-10 col-md-offset-1">
        <div class="process-wrap">
            <div class="process text-center active">
                <p><span>01</span></p>
                <h3>Giỏ hàng</h3>
            </div>
            <div class="process text-center">
                <p><span>02</span></p>
                <h3>Thanh toán</h3>
            </div>
            <div class="process text-center">
                <p><span>03</span></p>
                <h3>Hoàn tất thanh toán</h3>
            </div>
        </div>
    </div>
</div>
<div class="row row-pb-md">
    <div class="col-md-10 col-md-offset-1">
        <div class="product-name">
            <div class="one-forth text-center">
                <span>Chi tiết sản phẩm</span>
            </div>
            <div class="one-eight text-center">
                <span>Giá</span>
            </div>
            <div class="one-eight text-center">
                <span>Số lượng</span>
            </div>
            <div class="one-eight text-center">
                <span>Tổng</span>
            </div>
            <div class="one-eight text-center">
                <span>Xóa</span>
            </div>
        </div>
      
        @foreach ($carts as $cart)
        <div class="product-cart">
                <div class="one-forth">
                    <div class="product-img">
                        <img class="img-thumbnail cart-img" src="images/item-6.jpg">
                    </div>
                    <div class="detail-buy">
                        <h4>Mã : {{$cart->id}}</h4>
                        <h5>{{$cart->name}}</h5>
                    </div>
                </div>
                <div class="one-eight text-center">
                    <div class="display-tc">
                        <span class="price">₫ {{$cart->price}}</span>
                    </div>
                </div>
                <div class="one-eight text-center">
                    <div class="display-tc">
                       <form action="{{route('cart.update')}}" method="POST" id="form-update-{{$cart->id}}">
                           @csrf
                        <input type="hidden" name="id" value="{{$cart->id}}">
                        <input type="number" id="quantity" data-id="{{$cart->id}}" name="quantity" class="form-control input-number text-center" value="{{$cart->quantity}}">

                       </form>
                       <a href="#" onclick="event.preventDefault();document.getElementById('form-update-{{$cart->id}}').submit();" class="btn btn-primary">Update <i class="icon-arrow-right-circle"></i></a>
                    </div>
                </div>
                <div class="one-eight text-center">
                    <div class="display-tc">
                        <span class="price">₫ {{Cart::get($cart->id)->getPriceSum()}}</span>
                    </div>
                </div>
                <div class="one-eight text-center">
                    <div class="display-tc">
                        <a href="" class="closed btn-delete" data-id="{{$cart->id}}"></a>
                    </div>
                    <form action="{{route('cart.delete',$cart->id)}}" id="form-delete-{{$cart->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                    <input type="hidden" name="id[]" value="{{$cart->id}}">
                    </form>
                </div>
            </div>
           
        @endforeach
        
       
    <button class="btn btn-primary btn-update">Cập nhật giỏ hàng</button>
    
    </div>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="total-wrap">
            <div class="row">
                <div class="col-md-8">
                        
                </div>
                <div class="col-md-3 col-md-push-1 text-center">
                    <div class="total">
                        
                        <div class="grand-total">
                            <p><span><strong>Tổng cộng:</strong></span> <span>{{number_format(Cart::getTotal())}}₫ </span></p>
                            <a href="/gio-hang/checkout" class="btn btn-primary">Thanh toán <i class="icon-arrow-right-circle"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>