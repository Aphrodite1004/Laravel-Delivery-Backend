<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class Today_OrderController extends Controller
{
    
   public function today_order_vendor(Request $request)
    {
      if(Session::has('vendor'))
      {
    	 $vendor_email=Session::get('vendor');

    	  $vendor=DB::table('vendor')
    			->where('vendor_email',$vendor_email)
    			->first();
    			
				$currentDate = date('Y-m-d');
				$day = 1;
       $current2 = date('d-m-Y', strtotime($currentDate.' + '.$day.' days'));
    			
    	 $vendor_id = $vendor->vendor_id;			
    	  $todayorder  =   DB::table('orders')
						   ->join('vendor', 'orders.vendor_id','=', 'vendor.vendor_id')
                           ->join('tbl_user', 'orders.user_id', '=', 'tbl_user.user_id')
    	                    ->join('user_address','orders.address_id', '=', 'user_address.address_id')
    	                    ->join('area', 'user_address.area_id','=', 'area.area_id')
    	                    ->leftJoin('delivery_boy','orders.dboy_id', '=','delivery_boy.delivery_boy_id')
                          ->select('area.area_id','orders.order_id','orders.user_id','orders.delivery_date','orders.payment_method','orders.payment_status','tbl_user.user_name','orders.dboy_id','orders.delivery_charge', 'orders.total_price','orders.total_products_mrp','orders.delivery_charge','delivery_boy.delivery_boy_name','delivery_boy.delivery_boy_phone','orders.dboy_id','orders.order_status','orders.cart_id','orders.delivery_date','user_address.user_number','user_address.user_name','user_address.address','orders.time_slot','orders.delivery_charge','orders.paid_by_wallet','orders.rem_price','orders.price_without_delivery','orders.coupon_discount','vendor.vendor_name')
                          ->groupBy('area.area_id','orders.order_id','orders.user_id','orders.delivery_date','orders.payment_method','orders.payment_status','tbl_user.user_name','orders.dboy_id','orders.delivery_charge', 'orders.total_price','orders.total_products_mrp','orders.delivery_charge','delivery_boy.delivery_boy_name','delivery_boy.delivery_boy_phone','orders.dboy_id','orders.order_status','orders.cart_id','orders.delivery_date','user_address.user_number','user_address.user_name','user_address.address','orders.time_slot','orders.delivery_charge','orders.paid_by_wallet','orders.rem_price','orders.price_without_delivery','orders.coupon_discount','vendor.vendor_name')
                          
    	                    ->where('orders.vendor_id', $vendor_id)
                            ->where('orders.payment_status','!=', 'NULL')
                           ->where('orders.order_status','!=', 'Cancelled')
                            ->where('orders.ui_type','=', '1')
                            ->where('orders.order_status','!=', 'Completed')
                             ->whereDate('orders.delivery_date', $currentDate)

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
    	                ->select('product.product_name','product_varient.price','product_varient.unit','product_varient.strick_price','product_varient.varient_image','order_details.store_order_id','orders.cart_id','order_details.qty','order_details.quantity','order_details.unit','orders.price_without_delivery','product_varient.price')
    	               ->where('vendor.vendor_id', $vendor_id)
    	               ->get(); 
    	
   
    	 $vendordelivery_boy =  DB::table('delivery_boy')
    	                  ->join('delivery_boy_area', 'delivery_boy.delivery_boy_id', '=', 'delivery_boy_area.delivery_boy_id')
						  ->select('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id' )
    	                    ->GroupBy('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id')
    	                    ->where('delivery_boy.delivery_boy_status', 'online')
    	                    ->where('delivery_boy.vendor_id', $vendor_id)
							->get();
		$cityadmindelivery_boy =  DB::table('delivery_boy')
		                      ->join('delivery_boy_area', 'delivery_boy.delivery_boy_id', '=', 'delivery_boy_area.delivery_boy_id')
		                      ->join('delivery_boy_vendor', 'delivery_boy.delivery_boy_id', '=', 'delivery_boy_vendor.delivery_boy_id')	  
							  ->select('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name', 'delivery_boy_area.area_id' )
							  ->GroupBy('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id') 
							  ->where('delivery_boy.delivery_boy_status', 'online') 
							  ->where('delivery_boy_vendor.vendor_id', $vendor_id)
							  ->get();
							  $arr1 = json_decode($vendordelivery_boy);
							  $arr2 = json_decode($cityadmindelivery_boy);
							  $delivery_boy = array_merge($arr1, $arr2);

        if(count($delivery_boy)>0){
    	  foreach($delivery_boy as $delivery_boy2)
    	  {
    	      $boy_area_id=$delivery_boy2->area_id;
    	  }
        }
        else{
            $boy_area_id='N/A';
        } 

        return view('vendor.oder_incentive.today_order', compact("vendor_email","details", "vendor","todayorder","delivery_boy","boy_area_id"));
	 }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
      }

    public function next_day(Request $request)
    {
       
      if(Session::has('vendor'))
      {
    	 $currentDate = date('Y-m-d');
         $day = 1;
         $end = date('Y-m-d', strtotime($currentDate.' + '.$day.' days'));
         
          $vendor_email=Session::get('vendor');

    	  $vendor=DB::table('vendor')
    			->where('vendor_email',$vendor_email)
    			->first();
    	 $vendor_id = $vendor->vendor_id;			
    	  $nextdayorder  =   DB::table('orders')
    	                    ->join('tbl_user', 'orders.user_id', '=', 'tbl_user.user_id')
    	                    ->join('user_address','orders.address_id', '=', 'user_address.address_id')
    	                    ->join('area', 'user_address.area_id','=', 'area.area_id')
    	                    ->join('vendor_area', 'area.area_id','=', 'vendor_area.area_id')
    	               ->join('vendor', 'vendor_area.vendor_id','=', 'vendor.vendor_id')
    	                    ->leftJoin('delivery_boy','orders.dboy_id', '=','delivery_boy.delivery_boy_id')
    	                    ->select('area.area_id','orders.order_id','orders.order_id','orders.user_id','orders.delivery_date','tbl_user.user_name','orders.dboy_id','orders.delivery_charge', 'orders.total_price','orders.total_products_mrp','orders.delivery_charge','delivery_boy.delivery_boy_name','orders.dboy_id','orders.order_status','orders.cart_id','orders.delivery_date','user_address.user_number','user_address.user_name','user_address.address','orders.time_slot','orders.delivery_charge','orders.paid_by_wallet','orders.rem_price','orders.price_without_delivery','orders.coupon_discount')
    	                     ->whereDate('orders.delivery_date', $end)
    	                    ->where('orders.vendor_id', $vendor_id)
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
    	               ->where('vendor.vendor_id', $vendor_id)
    	               ->get(); 
    	
   
    	 $vendordelivery_boy =  DB::table('delivery_boy')
    	                  ->join('delivery_boy_area', 'delivery_boy.delivery_boy_id', '=', 'delivery_boy_area.delivery_boy_id')
						  ->select('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id' )
    	                    ->GroupBy('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id')
    	                    ->where('delivery_boy.delivery_boy_status', 'online')
    	                    ->where('delivery_boy.vendor_id', $vendor_id)
    	                    ->get();
		$cityadmindelivery_boy =  DB::table('delivery_boy')
							->join('delivery_boy_area', 'delivery_boy.delivery_boy_id', '=', 'delivery_boy_area.delivery_boy_id')
							->join('delivery_boy_vendor', 'delivery_boy.delivery_boy_id', '=', 'delivery_boy_vendor.delivery_boy_id')	  
							->select('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name', 'delivery_boy_area.area_id' )
							->GroupBy('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id') 
							->where('delivery_boy.delivery_boy_status', 'online') 
							->where('delivery_boy_vendor.vendor_id', $vendor_id)
							->get();
							$arr1 = json_decode($vendordelivery_boy);
							$arr2 = json_decode($cityadmindelivery_boy);
							$delivery_boy = array_merge($arr1, $arr2);
        if(count($delivery_boy)>0){
    	  foreach($delivery_boy as $delivery_boy2)
    	  {
    	      $boy_area_id=$delivery_boy2->area_id;
    	  }
        }
        else{
            $boy_area_id='N/A';
        } 
    	   
    	                    
         return view('vendor.oder_incentive.next_day_order', compact("vendor_email","details", "vendor","nextdayorder","delivery_boy","boy_area_id"));
	 }
	else
	 {
	    return redirect()->route('cityadminlogin')->withErrors('please login first');
	 }
      }
      
public function complete_order(Request $request)
    {
       
      if(Session::has('vendor'))
      {
     $currentDate = date('Y-m-d');
         $day = 1;
         $end = date('Y-m-d', strtotime($currentDate.' + '.$day.' days'));
         
          $vendor_email=Session::get('vendor');

    	  $vendor=DB::table('vendor')
    			->where('vendor_email',$vendor_email)
    			->first();
    	 $vendor_id = $vendor->vendor_id;			
    	  $nextdayorder  =   DB::table('orders')
    	                    ->join('tbl_user', 'orders.user_id', '=', 'tbl_user.user_id')
    	                    ->join('user_address','orders.address_id', '=', 'user_address.address_id')
    	                    ->join('area', 'user_address.area_id','=', 'area.area_id')
    	                    ->join('vendor_area', 'area.area_id','=', 'vendor_area.area_id')
    	                     ->join('vendor', 'vendor_area.vendor_id','=', 'vendor.vendor_id')
    	                    ->leftJoin('delivery_boy','orders.dboy_id', '=','delivery_boy.delivery_boy_id')
    	                    ->select('area.area_id','orders.order_id','orders.order_id','orders.user_id','orders.delivery_date','tbl_user.user_name','orders.dboy_id','orders.delivery_charge', 'orders.total_price','orders.total_products_mrp','orders.delivery_charge','delivery_boy.delivery_boy_name','orders.dboy_id','orders.order_status','orders.cart_id','orders.delivery_date','user_address.user_number','user_address.user_name','user_address.address','orders.time_slot','orders.delivery_charge','orders.paid_by_wallet','orders.rem_price','orders.price_without_delivery','orders.coupon_discount')
    	                     ->where('orders.order_status',"Completed")
    	                    ->where('orders.vendor_id', $vendor_id)
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
    	               ->where('vendor.vendor_id', $vendor_id)
    	               ->get(); 
    	
   
    	 $vendordelivery_boy =  DB::table('delivery_boy')
    	                  ->join('delivery_boy_area', 'delivery_boy.delivery_boy_id', '=', 'delivery_boy_area.delivery_boy_id')
    	                    ->select('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id' )
    	                    ->GroupBy('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id')
    	                    ->where('delivery_boy.delivery_boy_status', 'online')
    	                    ->where('delivery_boy.vendor_id', $vendor_id)
							->get();
		$cityadmindelivery_boy =  DB::table('delivery_boy')
							->join('delivery_boy_area', 'delivery_boy.delivery_boy_id', '=', 'delivery_boy_area.delivery_boy_id')
							->join('delivery_boy_vendor', 'delivery_boy.delivery_boy_id', '=', 'delivery_boy_vendor.delivery_boy_id')	  
							->select('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name', 'delivery_boy_area.area_id' )
							->GroupBy('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id') 
							->where('delivery_boy.delivery_boy_status', 'online') 
							->where('delivery_boy_vendor.vendor_id', $vendor_id)
							->get();
							$arr1 = json_decode($vendordelivery_boy);
							$arr2 = json_decode($cityadmindelivery_boy);
							$delivery_boy = array_merge($arr1, $arr2);
    	                    
        if(count($delivery_boy)>0){
    	  foreach($delivery_boy as $delivery_boy2)
    	  {
    	      $boy_area_id=$delivery_boy2->area_id;
    	  }
        }
        else{
            $boy_area_id='N/A';
        } 
    	   
    	                    
         return view('vendor.oder_incentive.complete_order', compact("vendor_email","details", "vendor","nextdayorder","delivery_boy","boy_area_id"));
      
	 }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
     }
      
      
      public function assigned_order(Request $request)
    {
       
     if(Session::has('vendor'))
      {
    	
    	 $vendor_email=Session::get('vendor');
    	  $vendor=DB::table('vendor')
                        ->where('vendor_email',$vendor_email)
                        ->first();
    
    	$delivery_boy = $request->delivery_boy_name;
    
    	$order_id = $request->order_id;
    	 $update = DB::table('orders')
    	          ->where('order_id',$order_id)
    	          ->update(['dboy_id'=>$delivery_boy,
    	          'order_status'=>"Confirmed"
    	          ]);
    	          
               
    	          
    	  if($update){
            return redirect()->back()->withErrors('Delivery boy assigned successfully');
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

     public function order_details(Request $request)
    {
      if(Session::has('vendor'))
      {
    	 $vendor_email=Session::get('vendor');

    	  $vendor=DB::table('vendor')
    			->where('vendor_email',$vendor_email)
    			->first();
    			
    	 $vendor_id = $vendor->vendor_id;	
    	 $order_cart_id = $request->store_order_id;

    	  $details  =   DB::table('order_details')
    	                ->join('product_varient', 'order_details.varient_id', '=', 'product_varient.varient_id')
    	                ->join('product','product_varient.product_id', '=', 'product.product_id')
    	                ->select('product.product_name','product_varient.unit','product_varient.quantity','product_varient.varient_image')
    	                    ->where('order_details.store_order_id', $order_cart_id)
    	                    ->get(); 
    	 
   
        return view('vendor.oder_incentive.today_order', compact("vendor_email", "details","vendor","todayorder","delivery_boy"));
          
	 }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
      }
      
      public function low_stock(Request $request)
      {
           if(Session::has('vendor'))
          {
        	 $vendor_email=Session::get('vendor');
    
        	  $vendor=DB::table('vendor')
        			->where('vendor_email',$vendor_email)
        			->first();
        			
        		$product = DB::table('product_varient')
        		         ->join('product','product_varient.product_id','=','product.product_id')
        		     
        		      ->where('product.vendor_id', $vendor->vendor_id)
        		      ->orderBy('product_varient.stock', 'ASC')
        		         ->paginate(10);
        	
        	 return view('vendor.stock.low_stock', compact("vendor_email", "vendor","product"));
          }
          else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
      
         
      }
      
        public function update_stock(Request $request)
      {
           if(Session::has('vendor'))
          {
        	 $vendor_email=Session::get('vendor');
               $varient_id = $request->varient_id;
               $st = $request->st;
        	  $vendor=DB::table('vendor')
        			->where('vendor_email',$vendor_email)
        			->first();
        			
        		$product = DB::table('product_varient')
        		         ->where('product_varient.varient_id',$varient_id)
        		         ->update(['stock'=>$st]);
        	
        	 return redirect()->back()->withErrors('Stock Updated');
          }
          else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
      
         
      }
     	  public function searchstock(Request $request)
	  {
  
		$this->validate($request,[
		   'productname' => 'required',
	   ]);
		$productname=$request->productname;
  
		  if(Session::has('vendor'))
			{
				   $vendor_email=Session::get('vendor');
		  
					  $vendor=DB::table('vendor')
					  ->where('vendor_email',$vendor_email)
					  ->first();
					  $id=$vendor->vendor_id;
				 If($productname!=null && $id!=null){
					$product = $this->getSearch($productname,$id);
  
  
					return view('vendor.stock.low_stock', compact("vendor_email", "vendor","product"));
  
				 }else{
  
					$product = DB::table('product_varient')
        		         ->join('product','product_varient.product_id','=','product.product_id')
        		      ->orderBy('product_varient.stock', 'ASC')
        		         ->paginate(10);
        	
        	 return view('vendor.stock.low_stock', compact("vendor_email", "vendor","product"));
				  }
			  
			}
		  else
			   {
				  return redirect()->route('vendorlogin')->withErrors('please login first');
			   }
  
  
	  }
	  public function getSearch($productname,$id)
  {
	  if($productname!=null && $id!=null){
		  
	   $od = DB::table('product_varient')
	   ->join('product','product_varient.product_id','=','product.product_id')
	    ->orderBy('product_varient.stock', 'ASC')
	   ->where('product.vendor_id', $id)
	   ->where([['product_name','=',$productname]])->paginate(10);
		 return $od;
	  }
  } 

  }