<?php

namespace App\Http\Controllers;
//use App\Http\Request;
use DB;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();


/*return view là trả về một trang nhưng ko kèm thông bào,redirect là trả về một prefix url của trang và kèm theo thông báo*/
class AdminController extends Controller
{
    public function AthuLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function index(){
    	return view('admin_login');
    }
    public function show_dashboard(){
        $this->AthuLogin();
    	return view('admin.dashboard');
    }
    public function dashboard(Request $request){
    	$admin_email = $request->admin_email;
    	$admin_password = md5($request->admin_password);

    	$result = DB::table('tbl_admin')->where ('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
    	if($result){
    		Session::put('admin_name',$result->admin_name);
    		Session::put('admin_id',$result->admin_id);
			return Redirect::to('/dashboard');
		}else{
			Session::put('massage','Sai tài khoản hoặc mật khẩu!');
			return Redirect::to('/admin');
		}
    }
    public function logout(){
        $this->AthuLogin();
    	Session::put('admin_name',null);
    	Session::put('admin_id',null);
    	return Redirect::to('/admin');
    }
    public function register(){
        return view('admin_register');
    }    
    public function add_admin(Request $request)
    {
        $data = array();
        $data['admin_email'] = $request->register_email;
        $data['admin_name'] = $request->register_name;
        $data['admin_phone'] = $request->register_phone;
        $data['admin_password'] = md5($request->register_password);

        DB::table('tbl_admin')->insert($data);
        $admin_id = DB::table('tbl_admin')->insertGetId($data);

        Session::put('admin_name',$request->register_name);
        Session::put('admin_id',$admin_id);
        Session::put('massage','Đăng ký thành công!');
        return Redirect::to('/dashboard');
    }
}
