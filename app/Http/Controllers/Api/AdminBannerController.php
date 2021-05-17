<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class AdminBannerController extends Controller
{
  
    public function adminbanner(Request $request)
    {   

        $banner = DB::table('admin_banner')
        		   ->get();

        if(count($banner)>0){
        	$message = array('status'=>'1', 'message'=>'data found', 'data'=>$banner);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }
    }
    
        public function resturant_banner(Request $request)
    {   
        $vendor_id = $request->vendor_id;
        $banner = DB::table('banner_resturant')
                    ->where('vendor_id',$vendor_id)
        		   ->get();

        if(count($banner)>0){
        	$message = array('status'=>'1', 'message'=>'data found', 'data'=>$banner);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }
    }

    public function pharmacy_banner(Request $request)
    {   
        $vendor_id = $request->vendor_id;
        $banner = DB::table('pharmacy_banner')
                    ->where('vendor_id',$vendor_id)
        		   ->get();

        if(count($banner)>0){
        	$message = array('status'=>'1', 'message'=>'data found', 'data'=>$banner);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }
    }
       public function parcel_banner(Request $request)
    {   
        $vendor_id = $request->vendor_id;
        $banner = DB::table('parcel_banner')
                     ->where('vendor_id',$vendor_id)
        		   ->get();

        if(count($banner)>0){
        	$message = array('status'=>'1', 'message'=>'data found', 'data'=>$banner);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }
    }

}    