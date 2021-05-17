<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;

class LoginController extends Controller
{
	public function vendorlogin(Request $request)
    {
		  if(Session::has('vendor'))
     {
	  $vendor_email =Session::get('vendor');
		$checkvendor = DB::table('vendor')
    	                   ->where('vendor_email',$vendor_email)
    	                   ->first();
		if($checkvendor){
    	    $ui_type = $checkvendor->ui_type;
		if($ui_type==1) {
           return redirect()->route('pharmacy-index');
		}
	   else
	 {
        return view('vendor.login');
	 }
		}
		else
	 {
        return view('vendor.login');
	 }
		
	 }
	else
	 {
        return view('vendor.login');
	 }
    }
    public function checkvendorLogin(Request $request)
    {
    	$vendor_email=$request->vendor_email;
    	$vendor_pass=$request->vendor_pass;

    	$this->validate(
         $request,
         [
         		'vendor_email'=>'required',
         		'vendor_pass'=>'required',
         ],
         [

         	'vendor_email.required'=>'Enter E-Mail',
         	'vendor_pass.required'=>'Enter the password',
         ]

);
    	$checkvendorLogin = DB::table('vendor')
    	                   ->where('vendor_email',$vendor_email)
    	                   ->first();
       

    	if($checkvendorLogin){
    	    
    	   $ui_type = $checkvendorLogin->ui_type;
		if($ui_type==1) {

         if(Hash::check($vendor_pass,$checkvendorLogin->vendor_pass)){
           session::put('vendor',$checkvendorLogin->vendor_email);
            $ui_type = $checkvendorLogin->ui_type;
           return redirect()->route('vendor-index');
         }
         else
         {
         	return redirect()->route('vendorlogin')->withErrors('wrong password');
         }
         }
         else
         {
         	return redirect()->route('vendorlogin')->withErrors('You are Not Registered as Grocery Vendor');
         }
    	}
    	else
    	{
             return redirect()->route('vendorlogin')->withErrors('invalid email and password');
    	}

    }
    
}
