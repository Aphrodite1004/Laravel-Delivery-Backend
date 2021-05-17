<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;

class Fcm_Controller extends Controller
{    
      public function edit_fcm_api(Request $request)
    {
      if(Session::has('admin'))
       {
    	 $admin_email=Session::get('admin');
    	  $admin=DB::table('admin')
    			->where('admin_email',$admin_email)
    			->first();
    	   
    			
    	   $api_key=  DB::table('fcm_key')
    	              ->select('*')
                      ->first();
              $user_api_key = $api_key->user_app_key;
              $dboy_api_key = $api_key->dboy_app_key;
              
            	return view('admin.fcm_api', compact("admin_email", "admin", "user_api_key", "dboy_api_key"));
            	
    			
    	
	 }
	else
	 {
	    return redirect()->route('adminlogin')->withErrors('please login first');
	 }
    }
    
    
    
      
     public function update_fcm_api(Request $request)
    {
      if(Session::has('admin'))
     {
    	 $admin_email=Session::get('admin');
    
    	  $admin=DB::table('admin')
    			->where('admin_email',$admin_email)
    			->first();
          $user_key = $request->user_key;
          $dboy_id= $request->dboy_key;
          
        $update= DB::table('fcm_key')
     		     ->update(['user_app_key'=>$user_key,
     		                 'dboy_app_key'=>$dboy_id]);
	
     if($update){
            return redirect()->back()->withErrors('API key set');
        }
        else{
            return redirect()->back()->withErrors("Something wents wrong");
        }
	 }
	else
	 {
	    return redirect()->route('adminlogin')->withErrors('please login first');
	 }
    }
    
          public function edit_countrycode(Request $request)
    {
      if(Session::has('admin'))
       {
    	 $admin_email=Session::get('admin');
    	  $admin=DB::table('admin')
    			->where('admin_email',$admin_email)
    			->first();
    	   
    			
    	   $api_key=  DB::table('country_code')
    	              ->select('*')
                      ->first();
              $country_code = $api_key->country_code;
              $number_limit = $api_key->number_limit;
              
            	return view('admin.fcm_api', compact("admin_email", "admin","country_code","number_limit"));
            	
    			
    	
	 }
	else
	 {
	    return redirect()->route('adminlogin')->withErrors('please login first');
	 }
    }
    
    
    
      
     public function update_countrycode(Request $request)
    {
      if(Session::has('admin'))
     {
    	 $admin_email=Session::get('admin');
    
    	  $admin=DB::table('admin')
    			->where('admin_email',$admin_email)
    			->first();
          $country_code = $request->country_code;
          $number_limit= $request->number_limit;
          
        $update= DB::table('country_code')
     		     ->update(['country_code'=>$country_code,
     		                 'number_limit'=>$number_limit]);
	
     if($update){
            return redirect()->back()->withErrors('Updated Sucessfully');
        }
        else{
            return redirect()->back()->withErrors("Something wents wrong");
        }
	 }
	else
	 {
	    return redirect()->route('adminlogin')->withErrors('please login first');
	 }
    }
    
            public function edit_firebase(Request $request)
    {
      if(Session::has('admin'))
       {
    	 $admin_email=Session::get('admin');
    	  $admin=DB::table('admin')
    			->where('admin_email',$admin_email)
    			->first();
    	   
    			
    	   $api_key=  DB::table('firebase')
    	              ->select('*')
                      ->first();
              
            	return view('admin.fcm_api', compact("admin_email", "admin"));
            	
    			
    	
	 }
	else
	 {
	    return redirect()->route('adminlogin')->withErrors('please login first');
	 }
    }
    
    
    
      
     public function update_firebase(Request $request)
    {
      if(Session::has('admin'))
     {
    	 $admin_email=Session::get('admin');
    
    	  $admin=DB::table('admin')
    			->where('admin_email',$admin_email)
    			->first();
          $country_code = $request->coupon_type;
          
        $update= DB::table('firebase')
     		     ->update(['status'=>$country_code,
     		                 ]);
	
     if($update){
            return redirect()->back()->withErrors('Updated Sucessfully');
        }
        else{
            return redirect()->back()->withErrors("Something wents wrong");
        }
	 }
	else
	 {
	    return redirect()->route('adminlogin')->withErrors('please login first');
	 }
    }
}