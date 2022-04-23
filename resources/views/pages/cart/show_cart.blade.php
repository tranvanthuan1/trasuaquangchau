@extends('welcome')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
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
	<section id="do_action">
		<div class="container">
			<!-- <div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div> -->
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng tiền<span>{{Cart::subtotal().' '.'VNĐ'}}</span></li>
							<li>Thuế<span>{{Cart::tax().' '.'VNĐ'}}</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Thành tiền <span>{{Cart::total().' '.'VNĐ'}}</span></li>
						</ul>
							<?php 
                                    $customer_id = Session::get('customer_id');
                                    $shipping_id = Session::get('shipping_id');
                                    if ($customer_id != NULL && $shipping_id == NULL) {
                                 ?>
                            <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a> 
                            <?php 
                                }elseif ($customer_id != NULL && $shipping_id != NULL) {
                             ?>
                            <a class="btn btn-default check_out" href="{{URL::to('/payment')}}">Thanh toán</a>      
                            <?php 
                                }else{
                             ?>
                            <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
                            
                            <?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection