<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class PaymentRequestController extends Controller
{
  
    public function vendor_order_list(Request $request)
    {   
        $vendor_id= $request->vendor_id;
        $banner = DB::table('comission')
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
    
    public function send_request(Request $request)
    {   
       
        $cart_id= $request->cart_id;
        $banner = DB::table('comission')
                    ->where('cart_id',$cart_id)
        		   ->update([
        		             'status'=>1,
        		             ]);

        if($banner){
        	$message = array('status'=>'1', 'message'=>'Request Send to Admin');
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'You Already send a request to admin');
        	return $message;
        }
    }

}    