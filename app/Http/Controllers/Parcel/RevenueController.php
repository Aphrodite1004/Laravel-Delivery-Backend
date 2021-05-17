<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class Today_OrderController extends Controller
{
    
    public function RevenueController(Request $request)
    {
      if(Session::has('vendor'))
      {
    	 $vendor_email=Session::get('vendor');

    	  $vendor=DB::table('vendor')
    			->where('vendor_email',$vendor_email)
    			->first();
   
    	 $vendor_id = $vendor->vendor_id;			
    	  $todayorder  =   DB::table('orders')
    	                    ->join('tbl_user', 'orders.user_id', '=', 'tbl_user.user_id')
    	                    ->join('user_address','orders.address_id', '=', 'user_address.address_id')
    	                    ->join('area', 'user_address.area_id','=', 'area.area_id')
    	                    ->join('vendor_area', 'area.area_id','=', 'vendor_area.area_id')
    	                    ->join('vendor', 'vendor_area.vendor_id','=', 'vendor.vendor_id')
    	                    ->leftJoin('delivery_boy','orders.dboy_id', '=','delivery_boy.delivery_boy_id')
    	                    ->select('area.area_id','orders.order_id','orders.order_id','orders.user_id','orders.delivery_date','tbl_user.user_name','orders.dboy_id','orders.delivery_charge', 'orders.total_price','orders.total_products_mrp','orders.delivery_charge','delivery_boy.delivery_boy_name','orders.dboy_id','orders.order_status','orders.cart_id','orders.delivery_date','user_address.user_number','user_address.user_name','user_address.address','orders.time_slot','orders.delivery_charge','orders.paid_by_wallet','orders.rem_price','orders.price_without_delivery','orders.coupon_discount')
    	                    ->where('order_status','=','Completed')
    	                    
    	                    ->where('vendor.vendor_id', $vendor_id)
    	                    ->orderBy('user_id')
    	                    ->get(); 
    

        return view('vendor.oder_incentive.today_order', compact("vendor_email","details", "vendor","todayorder","delivery_boy","boy_area_id"));
	 }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
      }

     

  }