<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();

class CheckoutController extends Controller
{
    public function AthuLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function login_checkout()
    {
    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
    	return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function add_customer(Request $request)
    {
    	$data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_password'] = md5($request->customer_password);
    	$data['customer_phone'] = $request->customer_phone;

    	$customer_id = DB::table('tbl_customers')->insertGetId($data);

    	Session::put('customer_id',$customer_id);
    	Session::put('customer_name',$request->customer_name);
    	return Redirect('/checkout');

    }
    public function checkout()
    {
    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
    	return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function save_checkout_customer(Request $request)
    {
    	$data = array();
    	$data['shipping_name'] = $request->shipping_name;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_address'] = $request->shipping_address;
    	$data['shipping_phone'] = $request->shipping_phone;

    	$shipping_id = DB::table('tbl_shipping')->insertGetId($data);

    	Session::put('shipping_id',$shipping_id);
    	return Redirect('/payment');
    }
    public function payment()
    {
    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
		return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function logout_checkout()
    {
    	Session::flush();
    	return Redirect('/login-checkout');
    }
    public function login_customer(Request $request )
    {
    	$email = $request->email_account; 
    	$password =md5($request->password_account);
    	$result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();

    	Session::put('customer_id',$result->customer_id);
    	return Redirect('/checkout');
    }
    public function order_place(Request $request)
    {
    	//get payment method
    	$data = array();
    	$data['payment_method'] = $request->payment_option;
    	$data['payment_status'] = 'đang chờ xử lý';
    	$payment_id = DB::table('tbl_payment')->insertGetId($data);

    	//insert order
    	$order_data = array();
    	$order_data['customer_id'] = Session::get('customer_id');
    	$order_data['shipping_id'] = Session::get('shipping_id');
    	$order_data['payment_id'] = $payment_id;
    	$order_data['order_total'] = Cart::total();
    	$order_data['order_status'] = 'đang chờ xử lý';
    	$order_id = DB::table('tbl_order')->insertGetId($order_data);

    	//insert order detail
    	$content = Cart::content();
    	foreach ($content as $v_content) {
    		$order_d_data = array();
	    	$order_d_data['order_id'] = $order_id;
	    	$order_d_data['product_id'] = $v_content->id;
	    	$order_d_data['product_name'] = $v_content->name;
	    	$order_d_data['product_price'] = $v_content->price;
	    	$order_d_data['product_sales_quantity'] = $v_content->qty;
	    	DB::table('tbl_order_detail')->insert($order_d_data);
    	}
    	if ($data['payment_method'] == 1 ) {
    		echo 'thanh toán bằng ATM';
    	}else{
    		Cart::destroy();
    		$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
			$brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
    		return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product);
    	}

    }
    public function manage_order()
    {   
        $this->AthuLogin();
        $all_order = DB::table("tbl_order")
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->join('tbl_order_detail','tbl_order_detail.order_id','=','tbl_order.order_id')
        ->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')
        ->select('tbl_order.*','tbl_customers.customer_name','tbl_order_detail.product_name','tbl_order_detail.product_sales_quantity','tbl_shipping.shipping_address')
        ->orderby('tbl_order.order_id','desc')->get();
        // join lấy ra những sản phẩm thuộc danh mục nào, thương hiệu nào
        $manager_order = view('admin.manage_order')->with('all_order', $all_order);
        return view('admin_layout')->with('admin.manager_order',$manager_order);
    }
    public function manage_customer()
    {   
        $this->AthuLogin();
        $all_customer = DB::table("tbl_customers")
        ->select('tbl_customers.*')
        ->orderby('tbl_customers.customer_id','desc')->get();
        // join lấy ra những sản phẩm thuộc danh mục nào, thương hiệu nào
        $manage_customer = view('admin.manage_customer')->with('all_customer', $all_customer);
        return view('admin_layout')->with('admin.manage_customer',$manage_customer);
    }
    public function delete_customer($customer_id){
        $this->AthuLogin();
        DB::table('tbl_customers')->where('customer_id',$customer_id)->delete();
        Session::put('massage','Xóa thành công!');
        return Redirect::to('/manage_customer');
    }

}
