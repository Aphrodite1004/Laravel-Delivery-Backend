<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class cityController extends Controller
{
    
     public function showcity(Request $request)
    {   
        $city = DB::table('city')
              ->join('cityadmin', 'city.city_id', '=','cityadmin.city_id')
        		   ->get();

        if(count($city)>0){
        	$message = array('status'=>'1', 'message'=>'data found', 'data'=>$city);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }
    }
  
      public function showarea(Request $request)
    {   
        
        $vendor_id= $request->vendor_id;
        $area = DB::table('area')
                  ->where('vendor_id', $vendor_id)
        		   ->get();

        if(count($area)>0){
        	$message = array('status'=>'1', 'message'=>'data found', 'data'=>$area);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }
    }
    
    
    public function showvendors(Request $request)
    {   
        
        $cityadmin_id= $request->cityadmin_id;
        $vendor = DB::table('vendor')
                  ->where('cityadmin_id', $cityadmin_id)
        		   ->get();

        if(count($vendor)>0){
        	$message = array('status'=>'1', 'message'=>'data found', 'data'=>$vendor);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'No Vendors in This City', 'data'=>[]);
        	return $message;
        }
    }
    
  
  
     public function city(Request $request)
    {   
        $city_id= $request->city_id;
        $cityadmin = DB::table('cityadmin')
                   ->where('city_id', $city_id)
        		   ->get();

        if(count($cityadmin)>0){
        	$message = array('status'=>'1', 'message'=>'data found', 'data'=>$cityadmin);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }
    }
}