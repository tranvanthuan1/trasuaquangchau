@extends('welcome')
@section('content')
@foreach($product_details as $key => $value) 
<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{URL::to('/public/uploads/product/'.$value->product_image)}}" alt="" />
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
										  <a href=""><img src="{{URL::to('/public/fontend/images/similar1.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/fontend/images/similar2.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/fontend/images/similar3.jpg')}}" alt=""></a>
										</div>							
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$value->product_name}}</h2>
								<p>Web ID: 1089772</p>
								<form method="POST" action="{{URL::to('/save-cart')}}">
									{{csrf_field()}}
								<span>
									<span>{{number_format($value->product_price).' '.'VNĐ'}}</span>
									<label>Quantity:</label>
									<input name="qty" type="number" min="1" value="1" />
									<input name="productid_hidden" type="hidden" min="1" value="{{$value->product_id}}" />
									<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Đặt hàng
									</button>
								</span>
								</form>
								<p><b>Tình trạng:</b> In Stock</p>
								<p><b>Điều kiện:</b> New</p>
								<p><b>Đánh giá:</b>{{$value->brand_name}}</p>
								<p><b>Danh mục:</b>{{$value->category_name}}</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
</div><!--/product-details-->
<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Chi Tiết</a></li>
								<li><a href="#tag" data-toggle="tab">Thẻ</a></li>
								<li><a href="#reviews" data-toggle="tab">Đánh giá</a>}</li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
							<p>{!!$value->product_decs!!}</p>

							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<p>{!!$value->product_content!!}</p>
							</div>							
							<div class="tab-pane fade" id="tag" >
								
							</div>
							
							<div class="tab-pane fade" id="reviews" >
								<p>{{$value->brand_name}}</p>
							</div>
							
						</div>
</div><!--/category-tab-->
@endforeach
<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Gợi ý sản phẩm</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
									@foreach($related as $key => $lienquan)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{URL::to('/public/uploads/product/'.$lienquan->product_image)}}" alt="" />
													<h2>{{number_format($lienquan->product_price).' '.'VNĐ'}}</h2>
													<p>{{$lienquan->product_name}}</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Đặt hàng</button>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
								
					
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
</div><!--/recommended_items-->
@endsection