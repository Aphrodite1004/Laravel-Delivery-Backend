<?php

namespace App\Http\Controllers\Cityadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class Vendor_orderController extends Controller
{
    public function vendor_list(Request $request)
        {
          if(Session::has('cityadmin'))
          {
        	 $cityadmin_email=Session::get('cityadmin');
        	 $cityadmin = DB::table('cityadmin')
        	           ->where('cityadmin_email', $cityadmin_email)
        	           ->first();
            
            $vendor= DB::table('vendor')
            ->where('cityadmin_id', $cityadmin->cityadmin_id)
                        ->get();
   
   
             return view('cityadmin.vendor_order.vendor_orderlist', compact("cityadmin_email", "cityadmin","vendor"));
    	 }
    	else
    	 {
    	    return redirect()->route('cityadminlogin')->withErrors('please login first');
    	 }
    }
    
    public function today_order1(Request $request)
        {
            
            if(Session::has('cityadmin'))
         {
            
        	 $cityadmin_email=Session::get('cityadmin');
        	 $cityadmin = DB::table('cityadmin')
        	           ->where('cityadmin_email', $cityadmin_email)
        	           ->first();
        	 $id=$request->id;
        	 
        	 $vendor= DB::table('vendor')
        	  ->where('cityadmin_id', $cityadmin->cityadmin_id)
                        ->get();
        	 
        	 
        	    $currentDate = date('d-m-Y');
                $day = 1;
                $current2 = date('d-m-Y', strtotime($currentDate.' + '.$day.' days'));
    			
    	         $cityadmin_id = $cityadmin->cityadmin_id;
    	
    	         $vendor  =   DB::table('orders')
    	                    ->join('tbl_user', 'orders.user_id', '=', 'tbl_user.user_id')
    	                    ->join('user_address','orders.address_id', '=', 'user_address.address_id')
    	                    ->join('area', 'user_address.area_id','=', 'area.area_id')
    	                    ->join('vendor_area', 'area.area_id','=', 'vendor_area.area_id')
    	                    ->join('vendor', 'vendor_area.vendor_id','=', 'vendor.vendor_id')
    	                    ->leftJoin('delivery_boy','orders.dboy_id', '=','delivery_boy.delivery_boy_id')
    	                    ->select('area.area_id','orders.order_id','orders.order_id','orders.user_id','orders.delivery_date','tbl_user.user_name','orders.dboy_id','orders.delivery_charge', 'orders.total_price','orders.total_products_mrp','orders.delivery_charge','delivery_boy.delivery_boy_name','orders.dboy_id','orders.order_status','orders.cart_id','orders.delivery_date','user_address.user_number','user_address.user_name','user_address.address','orders.time_slot','orders.delivery_charge','orders.paid_by_wallet','orders.rem_price','orders.price_without_delivery','orders.coupon_discount')
    	                 
    	                    ->where('vendor.vendor_id', $id)
    	                    ->orderBy('user_id')
    	                 ->get();
                    	  
                    	              
       	  $details  =   DB::table('orders')
    	                ->join('order_details', 'orders.cart_id', '=', 'order_details.order_cart_id') 
    	                ->join('product_varient', 'order_details.varient_id', '=', 'product_varient.varient_id')
    	                ->join('product','product_varient.product_id', '=', 'product.product_id')
    	                ->join('user_address','orders.address_id', '=', 'user_address.address_id')
    	               ->join('area', 'user_address.area_id','=', 'area.area_id')
    	               ->join('vendor_area', 'area.area_id','=', 'vendor_area.area_id')
    	               ->join('vendor', 'vendor_area.vendor_id','=', 'vendor.vendor_id')
    	                ->select('product.product_name','product_varient.price','product_varient.unit','product_varient.strick_price','product_varient.varient_image','order_details.store_order_id','orders.cart_id','order_details.qty','order_details.quantity','order_details.unit')
    	               ->where('vendor.vendor_id', $id)
    	               ->get(); 
    	
   
    	 $delivery_boy =  DB::table('delivery_boy')
    	                  ->join('delivery_boy_area', 'delivery_boy.delivery_boy_id', '=', 'delivery_boy_area.delivery_boy_id')
    	                    ->select('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id' )
    	                    ->GroupBy('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id')
    	                    ->where('delivery_boy.delivery_boy_status', 'online')
    	                    ->where('delivery_boy.vendor_id', $id)
    	                    ->get();
    	                    
        if(count($delivery_boy)>0){
    	  foreach($delivery_boy as $delivery_boy2)
    	  {
    	      $boy_area_id=$delivery_boy2->area_id;
    	  }
        }
        else{
            $boy_area_id='N/A';
        }
                	  	
                    return view('cityadmin.vendor_order.today_vendor_order_list', compact("cityadmin_email", "cityadmin","vendor","delivery_boy","boy_area_id","details"));
    	 }else
    
    	 {
    	    return redirect()->route('cityadminlogin')->withErrors('please login first');
    	 }
        	 
    }
      
    public function next_order1(Request $request)
        {
           if(Session::has('cityadmin'))
      {
    	 $cityadmin_email=Session::get('cityadmin');

    	  $cityadmin=DB::table('cityadmin')
    			->where('cityadmin_email',$cityadmin_email)
    			->first();
    			
    			
    			 $id=$request->id;
        	 
        	 $vendor= DB::table('vendor')
                        ->get();
    			
    	 $currentDate = date('d-m-Y');
         $day = 1;
         $end = date('d-m-Y', strtotime($currentDate.' + '.$day.' days'));
    			
    	 $cityadmin_id = $cityadmin->cityadmin_id;		
           
    	   
    	   
    	    $nextdayorder  =  DB::table('orders')
    	                    ->join('tbl_user', 'orders.user_id', '=', 'tbl_user.user_id')
    	                    ->join('user_address','orders.address_id', '=', 'user_address.address_id')
    	                    ->join('area', 'user_address.area_id','=', 'area.area_id')
    	                    ->join('vendor_area', 'area.area_id','=', 'vendor_area.area_id')
    	               ->join('vendor', 'vendor_area.vendor_id','=', 'vendor.vendor_id')
    	                    ->leftJoin('delivery_boy','orders.dboy_id', '=','delivery_boy.delivery_boy_id')
    	                    ->select('area.area_id','orders.order_id','orders.order_id','orders.user_id','orders.delivery_date','tbl_user.user_name','orders.dboy_id','orders.delivery_charge', 'orders.total_price','orders.total_products_mrp','orders.delivery_charge','delivery_boy.delivery_boy_name','orders.dboy_id','orders.order_status','orders.cart_id','orders.delivery_date','user_address.user_number','user_address.user_name','user_address.address','orders.time_slot','orders.delivery_charge','orders.paid_by_wallet','orders.rem_price','orders.price_without_delivery','orders.coupon_discount')
    	                     ->whereDate('orders.delivery_date', $end)
    	                    ->where('vendor.vendor_id', $id)
    	                    ->orderBy('user_id')
    	                    ->get();      
    	                    
    	 $details  =   DB::table('orders')
    	                ->join('order_details', 'orders.cart_id', '=', 'order_details.order_cart_id') 
    	                ->join('product_varient', 'order_details.varient_id', '=', 'product_varient.varient_id')
    	                ->join('product','product_varient.product_id', '=', 'product.product_id')
    	                ->join('user_address','orders.address_id', '=', 'user_address.address_id')
    	               ->join('area', 'user_address.area_id','=', 'area.area_id')
    	               ->join('vendor_area', 'area.area_id','=', 'vendor_area.area_id')
    	               ->join('vendor', 'vendor_area.vendor_id','=', 'vendor.vendor_id')
    	                ->select('product.product_name','product_varient.price','product_varient.unit','product_varient.strick_price','product_varient.varient_image','order_details.store_order_id','orders.cart_id','order_details.qty','order_details.quantity','order_details.unit')
    	               ->where('vendor.vendor_id', $id)
    	               ->get(); 
    	
   
    	 $delivery_boy =  DB::table('delivery_boy')
    	                  ->join('delivery_boy_area', 'delivery_boy.delivery_boy_id', '=', 'delivery_boy_area.delivery_boy_id')
    	                    ->select('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id' )
    	                    ->GroupBy('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id')
    	                    ->where('delivery_boy.delivery_boy_status', 'online')
    	                    ->where('delivery_boy.vendor_id', $id)
    	                    ->get();
    	                    
        if(count($delivery_boy)>0){
    	  foreach($delivery_boy as $delivery_boy2)
    	  {
    	      $boy_area_id=$delivery_boy2->area_id;
    	  }
        }
        else{
            $boy_area_id='N/A';
        } 
    	                  
        return view('cityadmin.vendor_order.next_vendor_order_list', compact("cityadmin_email", "cityadmin", "nextdayorder","delivery_boy","boy_area_id","vendor","details"));
	 }
	else
	 {
	    return redirect()->route('cityadminlogin')->withErrors('please login first');
	 }
      }
      
    public function completed_order1(Request $request)
        {
          
      if(Session::has('cityadmin'))
      {
    	 $cityadmin_email=Session::get('cityadmin');
    	 
    	 	 $id=$request->id;
        	 
        	 $vendor= DB::table('vendor')
        	  
                        ->get();

    	  $cityadmin=DB::table('cityadmin')
    			->where('cityadmin_email',$cityadmin_email)
    			->first();
    			
    	$current = Carbon::now();
        $current->toDateString();
        $day = 1;
       $current2 = date('d-m-Y', strtotime($current.' + '.$day.' days'));
    			
    	 $cityadmin_id = $cityadmin->cityadmin_id;		
    	 
    	                    
    	  $nextdayorder = DB::table('orders')
    	                    ->join('tbl_user', 'orders.user_id', '=', 'tbl_user.user_id')
    	                    ->join('user_address','orders.address_id', '=', 'user_address.address_id')
    	                    ->join('area', 'user_address.area_id','=', 'area.area_id')
    	                    ->join('vendor_area', 'area.area_id','=', 'vendor_area.area_id')
    	                     ->join('vendor', 'vendor_area.vendor_id','=', 'vendor.vendor_id')
    	                    ->leftJoin('delivery_boy','orders.dboy_id', '=','delivery_boy.delivery_boy_id')
    	                    ->select('area.area_id','orders.order_id','orders.order_id','orders.user_id','orders.delivery_date','tbl_user.user_name','orders.dboy_id','orders.delivery_charge', 'orders.total_price','orders.total_products_mrp','orders.delivery_charge','delivery_boy.delivery_boy_name','orders.dboy_id','orders.order_status','orders.cart_id','orders.delivery_date','user_address.user_number','user_address.user_name','user_address.address','orders.time_slot','orders.delivery_charge','orders.paid_by_wallet','orders.rem_price','orders.price_without_delivery','orders.coupon_discount')
    	                     ->where('orders.order_status',"Completed")
    	                    ->where('vendor.vendor_id', $id)
    	                    ->orderBy('user_id')
    	                    ->get(); 
    	
    	  $details  =   DB::table('orders')
    	                ->join('order_details', 'orders.cart_id', '=', 'order_details.order_cart_id') 
    	                ->join('product_varient', 'order_details.varient_id', '=', 'product_varient.varient_id')
    	                ->join('product','product_varient.product_id', '=', 'product.product_id')
    	                ->join('user_address','orders.address_id', '=', 'user_address.address_id')
    	               ->join('area', 'user_address.area_id','=', 'area.area_id')
    	               ->join('vendor_area', 'area.area_id','=', 'vendor_area.area_id')
    	               ->join('vendor', 'vendor_area.vendor_id','=', 'vendor.vendor_id')
    	                ->select('product.product_name','product_varient.price','product_varient.unit','product_varient.strick_price','product_varient.varient_image','order_details.store_order_id','orders.cart_id','order_details.qty','order_details.quantity','order_details.unit')
    	               ->where('vendor.vendor_id', $id)
    	               ->get(); 
    	
   
    	 $delivery_boy =  DB::table('delivery_boy')
    	                  ->join('delivery_boy_area', 'delivery_boy.delivery_boy_id', '=', 'delivery_boy_area.delivery_boy_id')
    	                    ->select('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id' )
    	                    ->GroupBy('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id')
    	                    ->where('delivery_boy.delivery_boy_status', 'online')
    	                    ->where('delivery_boy.vendor_id', $id)
    	                    ->get();
    	                    
        if(count($delivery_boy)>0){
    	  foreach($delivery_boy as $delivery_boy2)
    	  {
    	      $boy_area_id=$delivery_boy2->area_id;
    	  }
        }
        else{
            $boy_area_id='N/A';
        }
        return view('cityadmin.vendor_order.completed_vendor_order', compact("cityadmin_email", "cityadmin", "nextdayorder","vendor","details","delivery_boy","boy_area_id"));
          
	 }
	else
	 {
	    return redirect()->route('cityadminlogin')->withErrors('please login first');
	 }
     }
      

  }