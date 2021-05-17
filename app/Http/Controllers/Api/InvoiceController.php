<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class InvoiceController extends Controller

{
public function invoice(Request $request)
     {
        $cart_id = $request->cart_id;
    	 		   
        $ord =DB::table('orders')
             ->join('tbl_user', 'orders.user_id', '=','tbl_user.user_id')
             ->join('user_address', 'orders.address_id','=','user_address.address_id')
             ->join('vendor', 'orders.vendor_id','=','vendor.vendor_id')
             ->select('orders.order_id','user_address.address','user_address.houseno','user_address.street','user_address.state', 'user_address.pincode','orders.cart_id','orders.total_price as cart_price','orders.paid_by_wallet','orders.coupon_discount','orders.rem_price','orders.delivery_charge','orders.price_without_delivery','vendor.vendor_loc','vendor.vendor_name')
             ->where('orders.cart_id', $cart_id)
             ->first();
       
        $details  =   DB::table('order_details')
    	               ->where('order_cart_id',$cart_id)
    	               ->get();

        if($ord){
            $message = array('status'=>'1', 'message'=>'Cart order found','invoice_no'=>$ord->order_id,'address'=>$ord->address, 'paid_by_wallet'=>$ord->paid_by_wallet,'coupon_discount'=>$ord->coupon_discount,'price_to_pay'=>$ord->rem_price,'total_price'=>$ord->cart_price, 'price_without_delivery'=>$ord->price_without_delivery, 'delivery_charge'=>$ord->delivery_charge,'vendor_loc'=>$ord->vendor_loc,'vendor_name'=>$ord->vendor_name, 'order_details'=>$details );
            return $message;
        }
        
        else{
            $message = array('status'=>'0', 'message'=>'Cart order not found');
            return $message;
        }
    }  
}