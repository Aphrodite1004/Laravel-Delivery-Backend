<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class financial_reportController extends Controller
{
    public function financial(Request $request)
    {
         $vendor_id = $request->vendor_id;
        $vendor=DB::table('vendor')
    			->where('vendor_id',$vendor_id)
    			->get();
    			
    	    
         $inventory = DB::table('completed_orders')
                 ->leftjoin('tbl_subscription','completed_orders.subs_id', '=', 'tbl_subscription.subs_id')
                 ->leftJoin('order_complains','completed_orders.completed_id', '=', 'order_complains.completed_id')
                 ->leftJoin('complains','order_complains.complain_id', '=', 'complains.complain_id')
                 ->join('delivery_boy','completed_orders.delivery_boy_id', '=', 'delivery_boy.delivery_boy_id')
                 ->join('product_varient', 'tbl_subscription.varient_id', '=', 'tbl_subscription.varient_id')
                 ->join('product', 'product_varient.product_id', '=', 'product.product_id')
                 ->join('subcat', 'product.subcat_id', '=', 'subcat.subcat_id')
                 ->join('tbl_category', 'subcat.category_id', '=', 'tbl_category.category_id')
                 ->select('completed_orders.completed_id','completed_orders.delivery_date', 'completed_orders.user_id','delivery_boy.delivery_boy_name', 'complains.complain_name', 'product.product_name','tbl_subscription.price','complains.complain_id','order_complains.order_complain_id', 'order_complains.settled_amt')
                 ->where('tbl_category.vendor_id', $vendor_id)
                 ->get();
                 
                  if(count($inventory)>0){
        	$message = array('status'=>'1', 'message'=>'data found', 'data'=>$inventory);
        	return $message;
                }
                else{
                	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
                	return $message;
                }
    }
    
}    