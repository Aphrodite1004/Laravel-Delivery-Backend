<?php

namespace App\Http\Controllers\Resturant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;

class RestaurantLoginController extends Controller
{
	public function resturantlogin(Request $request)
    {    if(Session::has('vendor'))
     {
        $vendor_email =Session::get('vendor');
		$checkvendor = DB::table('vendor')
    	                   ->where('vendor_email',$vendor_email)
    	                   ->first();
		if($checkvendor){
    	    $ui_type = $checkvendor->ui_type;
		if($ui_type==2) {
           return redirect()->route('resturant-index');
		}
	   else
	 {
        return view('resturant.login');
	 }
		}
		else
	 {
        return view('resturant.login');
	 }
		
	 }
	else
	 {
        return view('resturant.login');
	 }
    }
    public function checkresturantLogin(Request $request)
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
    	                   
           

    		$checkvendor = DB::table('vendor')
    	                   ->where('vendor_email',$vendor_email)
    	                   ->first();
    	                   
           

    	if($checkvendor){
    	    $ui_type = $checkvendor->ui_type;
    	   if($ui_type==2) {

         if(Hash::check($vendor_pass,$checkvendor->vendor_pass)){
           session::put('vendor',$checkvendor->vendor_email);
           return redirect()->route('resturant-index');
         }
         else
         {
         	return redirect()->route('res_login')->withErrors('wrong password');
         }
    	   }
         else
         {
         	return redirect()->route('res_login')->withErrors('You are Not Registered as Parcel Vendor');
         }
    	}
    	else
    	{
             return redirect()->route('res_login')->withErrors('invalid email and password');
    	}

    }
    
}
