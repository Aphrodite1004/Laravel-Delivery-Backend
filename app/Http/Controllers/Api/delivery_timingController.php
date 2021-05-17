<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class delivery_timingController extends Controller
{
  
     public function delivery_timing(Request $request)
    { 
        $delivery_timing = DB::table('delivery_timing')
                        ->where('delivery_type', 'subscribe')
                         ->get();
                         
                         
        if(count($delivery_timing)>0){
    	               $message = array('status'=>'2', 'message'=>'orders for today', 'data'=>$delivery_timing);
        	         return $message;
    	          }          
                  else{
                     $message = array('status'=>'1', 'message'=>'no orders found');
                	return $message;
       }
    }
    
    
}