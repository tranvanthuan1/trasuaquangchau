<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index(){

    	// lấy ra tất cả các danh mục sản phẩm và thương hiệu sản phẩm
    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
		$all_product = DB::table('tbl_product')
		->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
		->where('product_status','1')
		->select('tbl_product.*','tbl_brand.brand_name')->orderby('product_id','desc')->paginate(6);
    	return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
    }
    public function search(Request $request)
    {
    	$keywords = $request->keyword;

    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
		$search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
    	return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);
    }
}
