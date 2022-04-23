<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
	public function AthuLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
	public function add_product(){
		$this->AthuLogin();
		$cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
    	return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function all_product(){
    	$this->AthuLogin();
    	$all_product = DB::table("tbl_product")
    	->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
    	->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
    	->orderby('tbl_product.product_id','desc')->get();
        // join lấy ra những sản phẩm thuộc danh mục nào, thương hiệu nào
    	$manager_product = view('admin.all_product')->with('all_product', $all_product);
    	return view('admin_layout')->with('all_product',$manager_product);
    }
    public function save_product(Request $request){
    	$this->AthuLogin();
    	$data = array();
    	//tên cột trong DB ----------------------- name trong form
    	$data['product_name'] = $request->product_name;
    	$data['product_price'] = $request->product_price;
    	$data['product_decs'] = $request->product_decs;
    	$data['product_content'] = $request->product_content;
    	$data['category_id'] = $request->product_cate;
    	$data['brand_id'] = $request->product_brand;
    	$data['product_status'] = $request->product_status;
    	$data['product_image'] = $request->product_status;
    	$get_image = $request->file('product_image');

    	if($get_image){
    		$get_name_image = $get_image->getClientOriginalName();
    		$name_image = current(explode('.',$get_name_image)); //  hàm curent phân tách tên hình ảnh qua dấu chấm: linh     .      jpg

    		$new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
    		$get_image->move('public/uploads/product',$new_image);
    		$data['product_image'] = $new_image;
    		DB::table('tbl_product')->insert($data);
	    	Session::put('massage','Thêm sản phẩm thành công!');
	    	return Redirect::to('/add-product');
    	}
    	$data['product_image'] = '';
    	DB::table('tbl_product')->insert($data);
    	Session::put('massage','Thêm sản phẩm thành công!');
    	return Redirect::to('/all-product');
    }

    //không kích hoạt, ko hiển thị chuyển về = 0 
    public function unactive_product($product_id){
    	$this->AthuLogin();
    	DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status'=>0]);
    	Session::put('massage','Đã ẩn!');
    	return Redirect::to('/all-product');
    }
    public function active_product($product_id){
    	$this->AthuLogin();
    	DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status'=>1]);
    	Session::put('massage','Đã hiện!');
    	return Redirect::to('/all-product');
    }
    public function edit_product($product_id){
    	$this->AthuLogin();
    	$cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

    	$edit_product = DB::table("tbl_product")->where('product_id',$product_id)->get();
    	$manager_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    	return view('admin_layout')->with('edit_product',$manager_product);
    }
    public function update_product(Request $request,$product_id){
    	$this->AthuLogin();
    	$data = array();
    	$data['product_name'] = $request->product_name;
    	$data['product_price'] = $request->product_price;
    	$data['product_decs'] = $request->product_decs;
    	$data['product_content'] = $request->product_content;
    	$data['category_id'] = $request->product_cate;
    	$data['brand_id'] = $request->product_brand;
    	$data['product_status'] = $request->product_status;
    	$get_image = $request->file('product_image');
    	if($get_image){
    		$get_name_image = $get_image->getClientOriginalName();
    		$name_image = current(explode('.',$get_name_image)); //  hàm curent phân tách tên hình ảnh qua dấu chấm: linh     .      jpg

    		$new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
    		$get_image->move('public/uploads/product',$new_image);
    		$data['product_image'] = $new_image;
    		DB::table('tbl_product')->where('product_id', $product_id)->update($data);
	    	Session::put('massage','Cập nhật thành công!');
	    	return Redirect::to('/all-product');
    	}

    	DB::table('tbl_product')->where('product_id', $product_id)->update($data);
    	Session::put('massage','Cập nhật thành công!');
    	return Redirect::to('/all-product');
    }
    public function delete_product($product_id){
    	$this->AthuLogin();
    	DB::table('tbl_product')->where('product_id',$product_id)->delete();
    	Session::put('massage','Xóa thành công!');
    	return Redirect::to('/all-product');
    }

    ///////////////////
    //chi tiết sản phẩm


    public function details_product($product_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $details_product = DB::table("tbl_product")
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();

        foreach ($details_product as $key => $value){
            $category_id = $value->category_id;
        }
        $related_product = DB::table("tbl_product")
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();


        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)->with('product_details', $details_product)->with('related',$related_product);
    }



}
