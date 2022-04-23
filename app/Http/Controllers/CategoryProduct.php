<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{
    public function AthuLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }else{
            
            return Redirect::to('admin')->send();
        }
    }
    //CategoryProduct: Danh mục sản phẩm
    public function add_category_product(){
        $this->AthuLogin();
    	return view('admin.add_category_product');
    }
    public function all_category_product(){
        $this->AthuLogin();
    	$all_category_product = DB::table("tbl_category_product")->get(); // lấy tất cả dữ liệu
    	$manager_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product);
    	return view('admin_layout')->with('all_category_product',$manager_category_product);
    }
    public function save_category_product(Request $request){
        $this->AthuLogin();
    	$data = array();
    	//tên cột trong DB ----------------------- name trong form
    	$data['category_name'] = $request->category_product_name;
    	$data['category_decs'] = $request->category_product_decs;
    	$data['category_status'] = $request->category_product_status;
    	DB::table('tbl_category_product')->insert($data);
    	Session::put('massage','Thêm danh mục thành công!');
    	return Redirect::to('/add-category-product');
    }

    //không kích hoạt, ko hiển thị chuyển về = 0 
    public function unactive_category_product($category_product_id){
        $this->AthuLogin();
    	DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status'=>0]);
    	Session::put('massage','Đã ẩn!');
    	return Redirect::to('/all-category-product');
    }
    public function active_category_product($category_product_id){
        $this->AthuLogin();
    	DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status'=>1]);
    	Session::put('massage','Đã hiện!');
    	return Redirect::to('/all-category-product');
    }
    public function edit_category_product($category_product_id){
        $this->AthuLogin();
    	$all_category_product = DB::table("tbl_category_product")->where('category_id',$category_product_id)->get();
    	$manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $all_category_product);
    	return view('admin_layout')->with('edit_category_product',$manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id){
        $this->AthuLogin();
    	$data = array();
    	$data['category_name'] = $request->category_product_name;
    	$data['category_decs'] = $request->category_product_decs;
    	DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
    	Session::put('massage','Cập nhật thành công!');
    	return Redirect::to('/all-category-product');
    }
    public function delete_category_product($category_product_id){
        $this->AthuLogin();
    	DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
    	Session::put('massage','Xóa thành công!');
    	return Redirect::to('/all-category-product');
    }





    //danh mục sản phẩm, thương hiệu ở index

    public function show_category_home($category_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->get();
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();
        return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name);
    }
    

}
