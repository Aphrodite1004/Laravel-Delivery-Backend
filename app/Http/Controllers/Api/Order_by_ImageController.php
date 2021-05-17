<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DateTime;
use Carbon\Carbon;
use App\Traits\SendMail;
use App\Traits\SendSms;

class Order_by_ImageController extends Controller
{
   public function orderlist(Request $request)
    {   $date = date('d-m-Y');
        $user_id = $request->user_id;
        $address_id = $request->address_id;
        $store_id = $request->vendor_id;
        $time_slot = $request->time_slot;
        $delivery_date = $request->delivery_date;
        $orderlist = $request->orderlist;
        $fileName = date('dmyhisa').'-'.$orderlist->getClientOriginalName();
        $fileName = str_replace(" ", "-", $fileName);
        $orderlist->move('product/images/'.$date.'/', $fileName);
        $orderlist = 'product/images/'.$date.'/'.$fileName;
        
        $check =  DB::table('order_by_photo')
                 ->where('user_id',$user_id)
                 ->where('store_id',$store_id)
                 ->where('processed', 0)
                 ->get();
       
        
    	$insert = DB::table('order_by_photo')
                    ->insertgetid([
                        'user_id'=>$user_id,
                        'list_photo'=>$orderlist,
                        'address_id'=>$address_id,
                        'store_id'=>$store_id,
                        'processed'=>0,
                        'time_slot'=>$time_slot,
                        'delivery_date'=>$delivery_date
                        ]);
                        
      if($insert){
        	$message = array('status'=>'1', 'message'=>'Order List Submitted! you will get an sms and notification once it will processed');
	        return $message;
              }
    	else{
    		$message = array('status'=>'0', 'message'=>'Please try again later', 'data'=>[]);
	        return $message;
            	}
        
        
   
 }
 
 
    public function venodr_image_order(Request $request)
    {   
       
        $store_id = $request->vendor_id;
        $oder = DB::table('order_by_photo')
                ->where('store_id',$store_id)
                ->get();
                        
      if(count($oder)>0){
        	$message = array('status'=>'1', 'message'=>'Vendor Order', 'Data'=>$oder);
	        return $message;
              }
    	else{
    		$message = array('status'=>'0', 'message'=>'Please try again later', 'data'=>[]);
	        return $message;
            	}
        
        
   
 }
        

  
  
}