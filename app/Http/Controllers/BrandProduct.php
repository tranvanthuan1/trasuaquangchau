<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class BrandProduct extends Controller
{  
    public function AthuLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }else{
            
            return Redirect::to('admin')->send();
        }
    }
	public function add_brand_product(){
        $this->AthuLogin();
    	return view('admin.add_brand_product');
    }
    public function all_brand_product(){
        $this->AthuLogin();
    	$all_brand_product = DB::table("tbl_brand")->get(); // lấy tất cả dữ liệu
    	$manager_brand_product = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
    	return view('admin_layout')->with('all_brand_product',$manager_brand_product);
    }
    public function save_brand_product(Request $request){
        $this->AthuLogin();
    	$data = array();
    	//tên cột trong DB ----------------------- name trong form
    	$data['brand_name'] = $request->brand_product_name;
    	$data['brand_decs'] = $request->brand_product_decs;
    	$data['brand_status'] = $request->brand_product_status;
    	DB::table('tbl_brand')->insert($data);
    	Session::put('massage','Thêm thương hiệu thành công!');
    	return Redirect::to('/add-brand-product');
    }

    //không kích hoạt, ko hiển thị chuyển về = 0 
    public function unactive_brand_product($brand_product_id){
        $this->AthuLogin();
    	DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status'=>0]);
    	Session::put('massage','Đã ẩn!');
    	return Redirect::to('/all-brand-product');
    }
    public function active_brand_product($brand_product_id){
        $this->AthuLogin();
    	DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status'=>1]);
    	Session::put('massage','Đã hiện!');
    	return Redirect::to('/all-brand-product');
    }
    public function edit_brand_product($brand_product_id){
        $this->AthuLogin();
    	$edit_brand_product = DB::table("tbl_brand")->where('brand_id',$brand_product_id)->get();
    	$manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
    	return view('admin_layout')->with('edit_brand_product',$manager_brand_product);
    }
    public function update_brand_product(Request $request,$brand_product_id){
        $this->AthuLogin();
    	$data = array();
    	$data['brand_name'] = $request->brand_product_name;
    	$data['brand_decs'] = $request->brand_product_decs;
    	DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
    	Session::put('massage','Cập nhật thành công!');
    	return Redirect::to('/all-brand-product');
    }
    public function delete_brand_product($brand_product_id){
        $this->AthuLogin();
    	DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
    	Session::put('massage','Xóa thành công!');
    	return Redirect::to('/all-brand-product');
    }


    public function show_brand_home($brand_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_product.brand_id',$brand_id)->get();
        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id',$brand_id)->limit(1)->get();
        return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
    }
}
