<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class inventoryController extends Controller
{
    
    public function inventoryvendor(Request $request)
    {
     if(Session::has('vendor'))
      {
        $vendor_email=Session::get('vendor');

    	 $vendor=DB::table('vendor')
    			->where('vendor_email',$vendor_email)
    			->first();
    			
    	 $venodr_id = $vendor->vendor_id;    
         $inventory = DB::table('completed_orders')
                 ->leftjoin('tbl_orders','completed_orders.cart_id', '=', 'tbl_orders.order_cart_id')
                 ->leftJoin('order_complains','completed_orders.completed_id', '=', 'order_complains.completed_id')
                 ->join('tbl_user','tbl_orders.user_id', '=', 'tbl_user.user_id')
                 ->leftJoin('complains','order_complains.complain_id', '=', 'complains.complain_id')
                 ->join('delivery_boy','completed_orders.delivery_boy_id', '=', 'delivery_boy.delivery_boy_id')
                 ->select('completed_orders.completed_id','completed_orders.delivery_date', 'completed_orders.user_id','delivery_boy.delivery_boy_name','delivery_boy.delivery_boy_phone', 'complains.complain_name', 'tbl_user.user_name','tbl_orders.total_price','tbl_orders.order_cart_id','complains.complain_id','order_complains.order_complain_id', 'order_complains.settled_amt')
                 ->where('tbl_orders.vendor_id', $venodr_id)
                 ->get();
                 
       return view('vendor.financial_report.incentive', compact("vendor_email", "vendor", "inventory"));           
    }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }             
                 
    }
    
    public function paycustomervendor(Request $request)
        {
          
      if(Session::has('vendor'))
      {
    	 $vendor_email=Session::get('vendor');

    	  $vendor=DB::table('vendor')
    			->where('vendor_email',$vendor_email)
    			->first();
    	$order_complain_id = $request->order_complain_id;		
    	$user_id = 	$request->user_id;	
    	$complain_id = $request->complain_id;		
    	$pay = $request->pay;		
    	$vendor_id = $vendor->vendor_id;
    	$user_id = $request->user_id;
    	$add = DB::table('tbl_user')
    	->select('wallet_credits')
    	->where('user_id', $user_id)
    	->first();
    	$add1 =$add->wallet_credits;
    	$added =$add1 + $pay;
    	$update = DB::table('tbl_user')
    	->where('user_id', $user_id)
    	->update(['wallet_credits'=>$added]);
    	
    	$up = DB::table('order_complains')
    	->where('order_complain_id', $order_complain_id)
    	->update(['settled_amt'=>$pay]);
       
       	  if($update){
            return redirect()->back()->withErrors('Rs. ' .$pay.  ' paid to user against complain id ('.$complain_id.')');
        }
        else{
            return redirect()->back()->withErrors("Something wents wrong");
        }	
	 }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
    }
   
}