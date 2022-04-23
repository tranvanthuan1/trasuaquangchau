@extends('welcome')
@section('content')

<div class="features_items"><!--features_items-->
                        <h2 class="title text-center">SẢN PHẨM MỚI NHẤT</h2>
                        @foreach($all_product as $key => $product)
                        <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img style="height: 200px" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                                            <h2>{{number_format($product->product_price).' '.'VNĐ'}}</h2>
                                            <p>{{$product->product_name}}</p>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>{{$product->brand_name}}</h2>
                                                <h2 class="title text-center">chi tiết sản phẩm</h2>
                                                
                                            </div>
                                        </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-star"></i>Yêu thích</a></li>
                                        <li><a href="#"><i class="fa fa-compress"></i>So sánh</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        </a> 
                    @endforeach
</div>                    
                    <div align="center" style="font-weight: bold; font-size: 30px;">{!! $all_product->render() !!} </div>                   
@endsection