<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Hash;
use Session;

class RestaurantVendorOrderController extends Controller
{
    public function vendor_today_order(Request $request)
    {
 
    			
    	$currentDate = date('Y-m-d');
        $day = 1;
       $current2 = date('d-m-Y', strtotime($currentDate.' + '.$day.' days'));
    			
    	 $vendor_id = $request->vendor_id;			
    	  $todayorder  =   DB::table('orders')
                           ->join('tbl_user', 'orders.user_id', '=', 'tbl_user.user_id')
    	                    ->join('user_address','orders.address_id', '=', 'user_address.address_id')
    	                    ->join('area', 'user_address.area_id','=', 'area.area_id')
    	                    
    	                    ->join('vendor', 'orders.vendor_id','=', 'vendor.vendor_id')
    	                    ->leftJoin('delivery_boy','orders.dboy_id', '=','delivery_boy.delivery_boy_id')
                          ->select('area.area_id','orders.order_id','orders.user_id','orders.delivery_date','orders.payment_method','orders.payment_status','tbl_user.user_name','orders.dboy_id','orders.delivery_charge', 'orders.total_price','orders.total_products_mrp','orders.delivery_charge','delivery_boy.delivery_boy_name','delivery_boy.delivery_boy_phone','orders.dboy_id','orders.order_status','orders.cart_id','orders.delivery_date','user_address.user_number','user_address.user_name','user_address.address','orders.time_slot','orders.delivery_charge','orders.paid_by_wallet','orders.rem_price','orders.price_without_delivery','orders.coupon_discount','vendor.vendor_name')
    	           
                            ->where('orders.ui_type', 2)
                            ->where('orders.vendor_id', $vendor_id)
                            ->where('orders.payment_status','!=', 'NULL')
                            ->where('orders.order_status','!=', 'Completed')
                             ->whereDate('orders.delivery_date', $currentDate)

    	                    ->orderBy('user_id')
                           ->get();
                
                           if(count($todayorder)>0){
                            foreach($todayorder as $ords){
                                   $cart_id = $ords->cart_id;    
                               $details  =   DB::table('order_details')
    	                 ->join('resturant_variant', 'order_details.varient_id', '=', 'resturant_variant.variant_id')
    	                ->join('resturant_product','resturant_variant.product_id', '=', 'resturant_product.product_id')
    	                ->select('resturant_product.product_name','resturant_variant.price','resturant_variant.price','resturant_variant.unit','resturant_variant.quantity','resturant_product.product_image','resturant_product.description','order_details.varient_id','order_details.store_order_id','order_details.qty')
    	               ->where('order_details.order_cart_id',$cart_id)
    	               ->groupBy('resturant_product.product_name','resturant_variant.price','resturant_variant.price','resturant_variant.unit','resturant_variant.quantity','resturant_product.product_image','resturant_product.description','order_details.varient_id','order_details.store_order_id','order_details.qty')
    	                     ->get();  
    	    $aadons = DB::table('order_details')  
    	                ->join('restaurant_addons', 'order_details.addon_id', '=', 'restaurant_addons.addon_id')
    	                ->select('order_details.addon_id','order_details.addon_price','order_details.product_name','restaurant_addons.addon_name')
    	                 ->where('order_cart_id',$cart_id)
    	                 ->get(); 

                                            $data[]=array('area_id'=>$ords->area_id,'order_id'=>$ords->order_id, 'user_id'=>$ords->user_id, 'delivery_date'=>$ords->delivery_date,'user_name'=>$ords->user_name, 'dboy_id'=>$ords->dboy_id, 'delivery_charge'=>$ords->delivery_charge, 'total_price'=>$ords->total_price,'total_product_mrp'=>$ords->total_products_mrp,'delivery_boy_name'=>$ords->delivery_boy_name,'order_status'=>$ords->order_status,'cart_id'=>$cart_id,'user_number'=>$ords->user_number,'address'=>$ords->address , 'time_slot'=>$ords->time_slot,'paid_by_wallet'=>$ords->paid_by_wallet,'remaining_price'=>$ords->rem_price,'price_without_delivery'=>$ords->price_without_delivery,'coupon_discount'=>$ords->coupon_discount,'vendor_name'=>$ords->vendor_name,'payment_method'=>$ords->payment_method,'payment_status'=>$ords->payment_status,'delivery_boy_num'=>$ords->delivery_boy_phone,'order_details'=>$details,'addons'=>$aadons); 
                                          }
                                          }
                                  else{
                                  $data[]=array('order_details'=>'no orders found');
                                          }
                                          return $data;

      }




          public function resturant_complete_order(Request $request)
          {
              
            $vendor_id = $request->vendor_id;			
                      
            $completeorder  =   DB::table('orders')
                           ->join('tbl_user', 'orders.user_id', '=', 'tbl_user.user_id')
    	                    ->join('user_address','orders.address_id', '=', 'user_address.address_id')
    	                    ->join('area', 'user_address.area_id','=', 'area.area_id')
    	                    
    	                    ->join('vendor', 'orders.vendor_id','=', 'vendor.vendor_id')
    	                    ->leftJoin('delivery_boy','orders.dboy_id', '=','delivery_boy.delivery_boy_id')
                          ->select('area.area_id','orders.order_id','orders.user_id','orders.delivery_date','orders.payment_method','orders.payment_status','tbl_user.user_name','orders.dboy_id','orders.delivery_charge', 'orders.total_price','orders.total_products_mrp','orders.delivery_charge','delivery_boy.delivery_boy_name','delivery_boy.delivery_boy_phone','orders.dboy_id','orders.order_status','orders.cart_id','orders.delivery_date','user_address.user_number','user_address.user_name','user_address.address','orders.time_slot','orders.delivery_charge','orders.paid_by_wallet','orders.rem_price','orders.price_without_delivery','orders.coupon_discount','vendor.vendor_name')
                          ->groupBy('area.area_id','orders.order_id','orders.user_id','orders.delivery_date','orders.payment_method','orders.payment_status','tbl_user.user_name','orders.dboy_id','orders.delivery_charge', 'orders.total_price','orders.total_products_mrp','orders.delivery_charge','delivery_boy.delivery_boy_name','delivery_boy.delivery_boy_phone','orders.dboy_id','orders.order_status','orders.cart_id','orders.delivery_date','user_address.user_number','user_address.user_name','user_address.address','orders.time_slot','orders.delivery_charge','orders.paid_by_wallet','orders.rem_price','orders.price_without_delivery','orders.coupon_discount','vendor.vendor_name')
              ->where('orders.order_status',"Completed")
              ->where('orders.ui_type',2)
             ->where('orders.vendor_id', $vendor_id)
             ->orderBy('user_id')
             ->get();
            
            if(count($completeorder)>0){
           foreach($completeorder as $ords){
                  $cart_id = $ords->cart_id;    
              $details  =   DB::table('order_details')
                                             ->join('resturant_variant', 'order_details.varient_id', '=', 'resturant_variant.variant_id')
                                             ->join('resturant_product','resturant_variant.product_id', '=', 'resturant_product.product_id')
                                             ->leftjoin('restaurant_addons','resturant_product.product_id', '=', 'restaurant_addons.product_id')
                                             ->select('resturant_product.product_name','resturant_variant.price','resturant_variant.unit','resturant_variant.quantity','resturant_product.product_image','resturant_product.description','order_details.varient_id','restaurant_addons.addon_name','restaurant_addons.addon_price','order_details.store_order_id','order_details.qty')
                                            ->where('order_details.order_cart_id',$cart_id)
                                            ->groupBy('resturant_product.product_name','resturant_variant.price','resturant_variant.price','resturant_variant.unit','resturant_variant.quantity','resturant_product.product_image','resturant_product.description','order_details.varient_id','order_details.store_order_id','order_details.qty','restaurant_addons.addon_name','restaurant_addons.addon_price')
                                            ->get(); 
                       
             
             $data[]=array('area_id'=>$ords->area_id,'order_id'=>$ords->order_id, 'user_id'=>$ords->user_id, 'delivery_date'=>$ords->delivery_date,'user_name'=>$ords->user_name, 'dboy_id'=>$ords->dboy_id, 'delivery_charge'=>$ords->delivery_charge, 'total_price'=>$ords->total_price,'total_product_mrp'=>$ords->total_products_mrp,'delivery_boy_name'=>$ords->delivery_boy_name,'order_status'=>$ords->order_status,'cart_id'=>$cart_id,'user_number'=>$ords->user_number,'address'=>$ords->address , 'time_slot'=>$ords->time_slot,'paid_by_wallet'=>$ords->paid_by_wallet,'remaining_price'=>$ords->rem_price,'price_without_delivery'=>$ords->price_without_delivery,'coupon_discount'=>$ords->coupon_discount,'vendor_name'=>$ords->vendor_name,'payment_method'=>$ords->payment_method,'payment_status'=>$ords->payment_status,'delivery_boy_num'=>$ords->delivery_boy_phone,'order_details'=>$details); 
             }
             }
             else{
                 $data[]=array('order_details'=>'no orders found');
             }
             return $data;     
         } 



         public function assigned_store_order(Request $request)
         {
         
             $delivery_id = $request->delivery_boy_id;
             $order_id = $request->order_id;
              $update = DB::table('orders')
                       ->where('order_id',$order_id)
                       ->update(['dboy_id'=>$delivery_id,
                       'order_status'=>"Confirmed"
                       ]);
                       
                       if($update)	{
      
       
                                  
                        $mess = array('status'=>'1', 'message'=>'Delivery boy assigned successfully', 'data'=>$update);
                        return $mess;
                     }
                    else
                     {
                        $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
                        return $message;
                     }     
                       		
      
         }

         public function store_delivery_boy(Request $request)
         {
         
             $vendor_id = $request->vendor_id;
             $vendordelivery_boy =  DB::table('delivery_boy')
             ->select('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' ,'delivery_boy.vendor_id' ,'delivery_boy.delivery_boy_image' ,'delivery_boy.delivery_boy_phone' , 'delivery_boy.delivery_boy_pass', 'delivery_boy.lat' ,'delivery_boy.lng' ,'delivery_boy.device_id','delivery_boy.delivery_boy_status','delivery_boy.is_confirmed','delivery_boy.otp','delivery_boy.phone_verify','delivery_boy.cityadmin_id','delivery_boy.dboy_comission','delivery_boy.created_at','delivery_boy.updated_at')
             ->GroupBy('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' ,'delivery_boy.vendor_id' ,'delivery_boy.delivery_boy_image' ,'delivery_boy.delivery_boy_phone' , 'delivery_boy.delivery_boy_pass', 'delivery_boy.lat' ,'delivery_boy.lng' ,'delivery_boy.device_id','delivery_boy.delivery_boy_status','delivery_boy.is_confirmed','delivery_boy.otp','delivery_boy.phone_verify','delivery_boy.cityadmin_id','delivery_boy.dboy_comission','delivery_boy.created_at','delivery_boy.updated_at' )
             ->where('delivery_boy.delivery_boy_status', 'online')
               ->where('delivery_boy.vendor_id', $vendor_id)
   ->get();
$cityadmindelivery_boy =  DB::table('delivery_boy')
               ->join('delivery_boy_vendor', 'delivery_boy.delivery_boy_id', '=', 'delivery_boy_vendor.delivery_boy_id')	  
               ->select('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' ,'delivery_boy_vendor.vendor_id' ,'delivery_boy.delivery_boy_image' ,'delivery_boy.delivery_boy_phone' , 'delivery_boy.delivery_boy_pass', 'delivery_boy.lat' ,'delivery_boy.lng' ,'delivery_boy.device_id','delivery_boy.delivery_boy_status','delivery_boy.is_confirmed','delivery_boy.otp','delivery_boy.phone_verify','delivery_boy.cityadmin_id','delivery_boy.dboy_comission','delivery_boy.created_at','delivery_boy.updated_at')
               ->GroupBy('delivery_boy.delivery_boy_id' , 'delivery_boy.delivery_boy_name' ,'delivery_boy_vendor.vendor_id' ,'delivery_boy.delivery_boy_image' ,'delivery_boy.delivery_boy_phone' , 'delivery_boy.delivery_boy_pass', 'delivery_boy.lat' ,'delivery_boy.lng' ,'delivery_boy.device_id','delivery_boy.delivery_boy_status','delivery_boy.is_confirmed','delivery_boy.otp','delivery_boy.phone_verify','delivery_boy.cityadmin_id','delivery_boy.dboy_comission','delivery_boy.created_at','delivery_boy.updated_at' )
     ->where('delivery_boy.delivery_boy_status', 'online') 
     ->where('delivery_boy_vendor.vendor_id', $vendor_id)
     ->get();
     $arr1 = json_decode($vendordelivery_boy);
     $arr2 = json_decode($cityadmindelivery_boy);
     $data = array_merge($arr1, $arr2);
                       
                       if($data)	{             
                        $mess = array('status'=>'1', 'message'=>'data found', 'data'=>$data);
                        return $mess;
                     }
                    else
                     {
                        $message = array('status'=>'0', 'message'=>'not available delivery boy', 'data'=>[]);
                        return $message;
                     }     
                       		
      
         }
 

}
