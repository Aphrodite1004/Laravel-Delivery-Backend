<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;

class PharmacyLoginController extends Controller
{
	public function pharmacylogin(Request $request)
    {  if(Session::has('vendor'))
     {
	  $vendor_email =Session::get('vendor');
		$checkvendor = DB::table('vendor')
    	                   ->where('vendor_email',$vendor_email)
    	                   ->first();
		if($checkvendor){
    	    $ui_type = $checkvendor->ui_type;
		if($ui_type==3) {
           return redirect()->route('pharmacy-index');
		}
	   else
	 {
        return view('pharmacy.login');
	 }
		}
		else
	 {
        return view('pharmacy.login');
	 }
		
	 }
	else
	 {
        return view('pharmacy.login');
	 }
    }
    public function checkpharmacyLogin(Request $request)
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
    	   if($ui_type==3){ 

         if(Hash::check($vendor_pass,$checkvendorLogin->vendor_pass)){
           session::put('vendor',$checkvendorLogin->vendor_email);
           return redirect()->route('pharmacy-index');
         }
         else
         {
         	return redirect()->route('pharmacylogin')->withErrors('wrong password');
         }
		   }
         else
         {
         	return redirect()->route('pharmacylogin')->withErrors('You are Not Registered as Pharmacy Vendor');
         }
    	}
    	else
    	{
             return redirect()->route('pharmacylogin')->withErrors('invalid email and password');
    	}

    }
    
}
