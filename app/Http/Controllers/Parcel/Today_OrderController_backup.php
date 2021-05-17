<?php

namespace App\Http\Controllers\Parcel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class Today_OrderController extends Controller
{
    
   public function parceltoday_order(Request $request)
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
    	  $todayorder  =     DB::table('parcel_details')
							->join('tbl_user', 'parcel_details.user_id', '=', 'tbl_user.user_id')
							->join('source_address','parcel_details.source_address_id', '=', 'source_address.source_address_id')
							->join('destination_address','parcel_details.destination_address_id', '=', 'destination_address.destination_address_id')
								->join('parcel_city', 'parcel_details.city_id','=', 'parcel_city.city_id')
								->join('vendor', 'parcel_details.vendor_id','=', 'vendor.vendor_id')
								->leftJoin('delivery_boy','parcel_details.dboy_id', '=','delivery_boy.delivery_boy_id')    	           
								->where('parcel_details.vendor_id', $vendor_id)
						    	->where('parcel_details.payment_method','!=', 'NULL')
						    	->where('parcel_details.order_status','!=', 'Completed')
    	                        ->get(); 
    	
   
    	 $vendordelivery_boy =  DB::table('delivery_boy')
						  ->join('delivery_boy_area', 'delivery_boy.delivery_boy_id', '=', 'delivery_boy_area.delivery_boy_id')
						  ->join('area', 'delivery_boy_area.area_id', '=', 'area.area_id')
						  ->join('cityadmin', 'area.cityadmin_id', '=', 'cityadmin.cityadmin_id')
						  ->join('city', 'cityadmin.city_id', '=', 'city.city_id')

						  ->select('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id','city.city_id' )
    	                    ->GroupBy('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id','city.city_id')
    	                    ->where('delivery_boy.delivery_boy_status', 'online')
    	                    ->where('delivery_boy.vendor_id', $vendor_id)
							->get();
		$cityadmindelivery_boy =  DB::table('delivery_boy')
		                      ->join('delivery_boy_area', 'delivery_boy.delivery_boy_id', '=', 'delivery_boy_area.delivery_boy_id')
							  ->join('area', 'delivery_boy_area.area_id', '=', 'area.area_id')
							  ->join('cityadmin', 'area.cityadmin_id', '=', 'cityadmin.cityadmin_id')
							  ->join('city', 'cityadmin.city_id', '=', 'city.city_id') 
							  ->join('delivery_boy_vendor', 'delivery_boy.delivery_boy_id', '=', 'delivery_boy_vendor.delivery_boy_id')	  
							  ->select('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id','city.city_id' )
							  ->GroupBy('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id','city.city_id')
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

        return view('parcel.oder_incentive.today_order', compact("vendor_email", "vendor","todayorder","delivery_boy","boy_area_id"));
	 }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
      }

    public function parcelnext_day(Request $request)
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
    	  $nextdayorder  =   DB::table('parcel_details')
							->join('tbl_user', 'parcel_details.user_id', '=', 'tbl_user.user_id')
							->join('source_address','parcel_details.source_address_id', '=', 'source_address.source_address_id')
							->join('destination_address','parcel_details.destination_address_id', '=', 'destination_address.destination_address_id')
								->join('parcel_city', 'parcel_details.city_id','=', 'parcel_city.city_id')
								->join('vendor', 'parcel_details.vendor_id','=', 'vendor.vendor_id')
								->leftJoin('delivery_boy','parcel_details.dboy_id', '=','delivery_boy.delivery_boy_id')    	           
								->where('parcel_details.vendor_id', $vendor_id)
								->whereDate('pickup_date', $end)
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
    	   
    	                    
         return view('vendor.oder_incentive.next_day_order', compact("vendor_email", "vendor","nextdayorder","delivery_boy","boy_area_id"));
	 }
	else
	 {
	    return redirect()->route('cityadminlogin')->withErrors('please login first');
	 }
      }
      
public function parcel_complete_order(Request $request)
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
    	  $nextdayorder  =   DB::table('parcel_details')
							->join('tbl_user', 'parcel_details.user_id', '=', 'tbl_user.user_id')
							->join('source_address','parcel_details.source_address_id', '=', 'source_address.source_address_id')
							->join('destination_address','parcel_details.destination_address_id', '=', 'destination_address.destination_address_id')
								->join('parcel_city', 'parcel_details.city_id','=', 'parcel_city.city_id')
								->join('vendor', 'parcel_details.vendor_id','=', 'vendor.vendor_id')
								->leftJoin('delivery_boy','parcel_details.dboy_id', '=','delivery_boy.delivery_boy_id')    	           
								->where('parcel_details.vendor_id', $vendor_id)
								->where('order_status', "Completed")
    	                        ->get(); 
    	

    	
   
    	 $vendordelivery_boy =  DB::table('delivery_boy')
						  ->join('delivery_boy_area', 'delivery_boy.delivery_boy_id', '=', 'delivery_boy_area.delivery_boy_id')
						  ->join('area', 'delivery_boy_area.area_id', '=', 'area.area_id')
						  ->join('cityadmin', 'area.cityadmin_id', '=', 'cityadmin.cityadmin_id')
						  ->join('city', 'cityadmin.city_id', '=', 'city.city_id')

						  ->select('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id','city.city_id' )
    	                    ->GroupBy('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' , 'delivery_boy_area.area_id','city.city_id')
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
    	   
    	                    
         return view('parcel.oder_incentive.complete_order', compact("vendor_email", "vendor","nextdayorder","delivery_boy","boy_area_id"));
      
	 }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
     }
      
      
      public function parcel_assigned_order(Request $request)
    {
     if(Session::has('vendor'))
      {
    	
    	 $vendor_email=Session::get('vendor');
    	  $vendor=DB::table('vendor')
                        ->where('vendor_email',$vendor_email)
                        ->first();
    // 	$delivery_boy_id = $request->delivery_boy_id;
    	$delivery_boy = $request->delivery_boy_name;
    // 	$incentive = $request->incentive;
    	$order_id = $request->order_id;
    	 $update = DB::table('parcel_details')
    	          ->where('parcel_id',$order_id)
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

     public function parcel_order_details(Request $request)
    {
      if(Session::has('vendor'))
      {
    	 $vendor_email=Session::get('vendor');

    	  $vendor=DB::table('vendor')
    			->where('vendor_email',$vendor_email)
    			->first();
    			
    	 $vendor_id = $vendor->vendor_id;	
    	 $order_cart_id = $request->store_order_id;

    	  $details  =   DB::table('parcel_details')
    	                ->join('product_varient', 'order_details.varient_id', '=', 'product_varient.varient_id')
    	                ->join('product','product_varient.product_id', '=', 'product.product_id')
    	                ->select('product.product_name','product_varient.unit','product_varient.quantity','product_varient.varient_image')
    	                    ->where('order_details.store_order_id', $order_cart_id)
    	                    ->get(); 
    	 
   
        return view('vendor.oder_incentive.today_order', compact("vendor_email", "details","vendor","todayorder","delivery_boy"));
           //return view('admin.index',compact(""));
	 }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
      }
      
//       public function parcel_low_stock(Request $request)
//       {
//           if(Session::has('vendor'))
//           {
//         	 $vendor_email=Session::get('vendor');
    
//         	  $vendor=DB::table('vendor')
//         			->where('vendor_email',$vendor_email)
//         			->first();
        			
//         		$product = DB::table('product_varient')
//         		         ->join('product','product_varient.product_id','=','product.product_id')
//         		      //   ->where('stock','<',10)
//         		      ->where('product.vendor_id', $vendor->vendor_id)
//         		      ->orderBy('product_varient.stock', 'ASC')
//         		         ->paginate(10);
        	
//         	 return view('vendor.stock.low_stock', compact("vendor_email", "vendor","product"));
//           }
//           else
// 	 {
// 	    return redirect()->route('vendorlogin')->withErrors('please login first');
// 	 }
      
         
//       }
      
//         public function update_stock(Request $request)
//       {
//           if(Session::has('vendor'))
//           {
//         	 $vendor_email=Session::get('vendor');
//               $varient_id = $request->varient_id;
//               $st = $request->st;
//         	  $vendor=DB::table('vendor')
//         			->where('vendor_email',$vendor_email)
//         			->first();
        			
//         		$product = DB::table('product_varient')
//         		         ->where('product_varient.varient_id',$varient_id)
//         		         ->update(['stock'=>$st]);
        	
//         	 return redirect()->back()->withErrors('Stock Updated');
//           }
//           else
// 	 {
// 	    return redirect()->route('vendorlogin')->withErrors('please login first');
// 	 }
      
         
//       }
//      	  public function searchstock(Request $request)
// 	  {
  
// 		$this->validate($request,[
// 		   'productname' => 'required',
// 	   ]);
// 		$productname=$request->productname;
  
// 		  if(Session::has('vendor'))
// 			{
// 				   $vendor_email=Session::get('vendor');
		  
// 					  $vendor=DB::table('vendor')
// 					  ->where('vendor_email',$vendor_email)
// 					  ->first();
// 					  $id=$vendor->vendor_id;
// 				 If($productname!=null && $id!=null){
// 					$product = $this->getSearch($productname,$id);
  
  
// 					return view('vendor.stock.low_stock', compact("vendor_email", "vendor","product"));
  
// 				 }else{
  
// 					$product = DB::table('product_varient')
//         		         ->join('product','product_varient.product_id','=','product.product_id')
//         		      ->orderBy('product_varient.stock', 'ASC')
//         		         ->paginate(10);
        	
//         	 return view('vendor.stock.low_stock', compact("vendor_email", "vendor","product"));
// 				  }
			  
// 			}
// 		  else
// 			   {
// 				  return redirect()->route('vendorlogin')->withErrors('please login first');
// 			   }
  
  
// 	  }
// 	  public function getSearch($productname,$id)
//   {
// 	  if($productname!=null && $id!=null){
		  
// 	   $od = DB::table('product_varient')
// 	   ->join('product','product_varient.product_id','=','product.product_id')
// 	    ->orderBy('product_varient.stock', 'ASC')
// 	   ->where('product.vendor_id', $id)
// 	   ->where([['product_name','=',$productname]])->paginate(10);
// 		 return $od;
// 	  }
//   } 

  }