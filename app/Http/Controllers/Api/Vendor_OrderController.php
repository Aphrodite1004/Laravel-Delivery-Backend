<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class Vendor_OrderController extends Controller
{
    
    public function vendor_orderlist(Request $request)
      {   
        $city = DB::table('vendor')
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

}