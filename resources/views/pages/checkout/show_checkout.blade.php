@extends('welcome')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="register-req">
				<p>Đăng ký hoặc đăng nhập để dễ dàng thanh toán và xem lịch sử mua hàng</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Điền thông tin mua hàng</p>
							<div class="form-one">
								<form action="{{URL::to('/save-checkout-customer')}}"method = "POST">
									{{ csrf_field() }}
									<input type="text" name="shipping_email" placeholder="Email*">
									<input type="text" name="shipping_name" placeholder="Họ tên *">
									<input type="text" name="shipping_address" placeholder="Địa chỉ *">
									<input type="text" name="shipping_phone" placeholder="Số điện thoại *">
									<input type="submit" value="Gửi" name="send_order" class ="btn btn-primary btn-sm">
								</form>
							</div>
						</div>
					</div>				
				</div>
			</div>
			<div class="review-payment">
				<h2>Giỏ hàng</h2>
			</div>

			<div class="table-responsive cart_info"  style="width: 750px;">
				<?php
				$content = Cart::content();
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình Ảnh</td>
							<td class="description">Mô Tả</td>
							<td class="price">Giá</td>
							<td class="quantity">Số Lượng</td>
							<td class="total">Tổng Tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>

						@foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img style="height: 50px" src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" alt="" /></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price).' '.'VNĐ'}}</p>
							</td>
							<td class="cart_quantity">
								<form action="{{URL::to('/update-cart-quantity')}}" method="POST">
									{{ csrf_field() }}
									<div class="cart_quantity_button">
										<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}" size="2">
										<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="btn-default btn-sm">
										<input type="submit" value="Sửa" name="update_qty" class="btn-default btn-sm">
									</div>
								</form>
								
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									
									<?php
										$subtotal = $v_content->price * $v_content->qty;
										echo number_format($subtotal).' '.'VNĐ';
									?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart',$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach

					</tbody>
				</table>
			</div>
			
		</div>
	</section> <!--/#cart_items-->
@endsection