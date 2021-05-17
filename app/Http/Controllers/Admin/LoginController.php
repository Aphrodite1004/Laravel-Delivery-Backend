<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;

class LoginController extends Controller
{
	public function login(Request $request)
    {
        if(Session::has('admin')){
            return redirect()->route('admin-index');    
        }
        return view('admin.login');
    }
    public function checkAdminLogin(Request $request)
    {
    	$admin_email=$request->admin_email;
    	$admin_pass=$request->admin_pass;

    	$this->validate(
         $request,
         [
         		'admin_email'=>'required',
         		'admin_pass'=>'required',
         ],
         [

         	'admin_email.required'=>'Enter E-Mail',
         	'admin_pass.required'=>'Enter the password',
         ]

);
    	$checkAdminLogin = DB::table('admin')
    	                   ->where('admin_email',$admin_email)
    	                   ->first();


    	if($checkAdminLogin){

         if(Hash::check($admin_pass,$checkAdminLogin->admin_pass)){
           session::put('admin',$checkAdminLogin->admin_email);
           
           return redirect()->route('admin-index');
         }
         else
         {
         	return redirect()->route('login')->withErrors('wrong password');
         }
    	}
    	else
    	{
             return redirect()->route('login')->withErrors('invalid email and password');
    	}

    }
    
}
