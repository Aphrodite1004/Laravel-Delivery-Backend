<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Hash;


class managerController extends Controller
{
    
     public function managerlogin(Request $request)
    
     {
    	$cityadmin_phone = $request->cityadmin_phone;
    	$cityadmin_pass = $request->cityadmin_pass;
    	$device_id = $request->device_id;
       
        
                
    	$checkUser = DB::table('cityadmin')
    					->where('cityadmin_phone', $cityadmin_phone)
    					->first();

    	if($checkUser){
    	   
    	   if(Hash::check($cityadmin_pass,$checkUser->cityadmin_pass)){
    		    $updateDeviceId = DB::table('cityadmin')
    		                        ->where('cityadmin_phone', $cityadmin_phone)
    		                        ->update(['device_id'=>$device_id]);
    		                       
    		                        
    			$message = array('status'=>'1', 'message'=>'login successfully', 'data'=>[$checkUser]);
	        	return $message;
    		   
    	
    	}
    	else{
    	    $message = array('status'=>'2', 'message'=>'password is wrong');
    	    return $message;
    	}
    	}
    	else{
    		$message = array('status'=>'0', 'message'=>'you are not registered', 'data'=>[]);
	        return $message;
    	}
    }
    
    
    
    
    public function managerprofile(Request $request)
    {   
        $cityadmin_id = $request->cityadmin_id;
         $user =  DB::table('cityadmin')
                ->where('cityadmin_id', $cityadmin_id )
                ->get();
                        
         if(count($user)>0){
            $data['response']=true;
            $data['user']=$user;
        }
        else
        {
            $data['response']=false;
            $data['user']=$user;
        }
   
        return ($data);  
        
    }     
    
    
    
    
    public function managertoday_orders(Request $request)
    {
    	$vendor_id = $request->vendor_id;
    
        $currentDate = date('d-m-Y');
    	  $todayorder  =   DB::table('tbl_subscription')
    	                    ->join('product_varient' , 'tbl_subscription.varient_id','=','product_varient.varient_id')
    	                    ->join('product' , 'product_varient.product_id','=','product.product_id')
    	                    ->join('subcat','product.subcat_id','=','subcat.subcat_id')
    	                    ->join('tbl_category', 'subcat.category_id', '=', 'tbl_category.category_id')
    	                    
    	                    ->join('vendor', 'tbl_category.vendor_id', '=', 'vendor.vendor_id')
    	                    ->join('user_address','tbl_subscription.address_id', '=', 'user_address.address_id')
    	                    ->leftJoin('delivery_boy','tbl_subscription.delivery_boy_id', '=','delivery_boy.delivery_boy_id'  )
    	                    ->join('tbl_subscription', 'vendor.vendor_id', '=', 'tbl_subscription.vendor_id')
    	                    ->join('city', 'cityadmin.city_id', '=', 'city.city_id')
    	                    ->join('tbl_user', 'tbl_subscription.user_id', '=', 'tbl_user.user_id')
    	                    ->select('tbl_subscription.subs_id','tbl_subscription.user_id','tbl_subscription.delivery_boy_incentive','tbl_subscription.delivery_boy_id','tbl_subscription.delivery_date', 'vendor.vendor_name','city.city_name','product.product_name', 'tbl_subscription.order_qty','tbl_subscription.price','tbl_subscription.order_type', 'user_address.address_id', 'user_address.area_id', 'user_address.address','tbl_user.wallet_credits','delivery_boy.delivery_boy_name')
    	                    ->where('vendor.vendor_id', $vendor_id)
    	                  
    	                    ->get(); 
    	          if(count($todayorder)>0){
    	               $message = array('status'=>'2', 'message'=>'orders for today', 'data'=>$todayorder);
        	         return $message;
    	          }          
                  else{
                     $message = array('status'=>'1', 'message'=>'no orders found');
                	return $message;
       }
    	              
    	
      }



      public function managernextday_orders(Request $request)
    {
    	$cityadmin_id = $request->cityadmin_id;
        $currentDate = date('d-m-Y');
        $day = 1;
       $end = date('d-m-Y', strtotime($currentDate.' + '.$day.' days'));
        
    	    $nextdayorder  =   DB::table('tbl_subscription')
    	                     ->join('product' , 'tbl_subscription.product_id','=','product.product_id')
    	                    ->join('subcat','product.subcat_id','=','subcat.subcat_id')
    	                    ->join('tbl_category', 'subcat.category_id', '=', 'tbl_category.category_id')
    	                    ->join('cityadmin', 'tbl_category.cityadmin_id', '=', 'cityadmin.cityadmin_id')
    	                    ->join('user_address','tbl_subscription.address_id', '=', 'user_address.address_id')
    	                    ->join('city', 'cityadmin.city_id', '=', 'city.city_id')
    	                    ->join('delivery_boy','tbl_subscription.delivery_boy_id', '=','delivery_boy.delivery_boy_id'  )
    	                    ->join('tbl_user', 'tbl_subscription.user_id', '=', 'tbl_user.user_id')
    	                    ->select('tbl_subscription.subs_id','tbl_subscription.user_id','tbl_subscription.delivery_boy_incentive','tbl_subscription.delivery_boy_id','tbl_subscription.delivery_date', 'cityadmin.cityadmin_name','city.city_name','product.product_name', 'tbl_subscription.order_qty','tbl_subscription.price','tbl_subscription.order_type', 'user_address.address_id', 'user_address.area_id', 'user_address.address','tbl_user.wallet_credits','delivery_boy.delivery_boy_name')
    	                    ->where('cityadmin.cityadmin_id', $cityadmin_id)
    	                    ->where('tbl_subscription.delivery_date', $end)
    	                    ->get();      
    	          if(count($nextdayorder)>0){
    	               $message = array('status'=>'1', 'message'=>'orders for today', 'data'=>$nextdayorder);
        	         return $message;
    	          }          
                  else{
                     $message = array('status'=>'0', 'message'=>'no orders found');
                	return $message;
       }
       
    	              
    	
      }



    public function showdelivery_boys(Request $request)
        {
            $vendor_id = $request->vendor_id;
            $select = DB::table('delivery_boy')
    	          ->where('vendor_id',$vendor_id)
    	          ->where('delivery_boy_status','online')
    	          ->get();
     if(count($select)>0){
            $message = array('status'=>'1', 'message'=>'data found', 'data'=>$select);
        	return $message;
        }
        else{
            $message = array('status'=>'0', 'message'=>'no delivery boys found online', 'data'=>$select);
        	return $message;
        }		
        }


     public function appassign(Request $request)
    {
    	$delivery_boy_id = $request->delivery_boy_id;
    	$subs_id = $request->subs_id;
    	 $update = DB::table('tbl_subscription')
    	          ->where('subs_id',$subs_id)
    	          ->update(['delivery_boy_id'=>$delivery_boy_id
    	          ]);
    	          
               
    	          
    	if($update){
            $message = array('status'=>'1', 'message'=>'assigned successfully', 'data'=>$update);
        	return $message;
        }
        else{
            $message = array('status'=>'0', 'message'=>'already assigned', 'data'=>[]);
        	return $message;
        }		

    }  
     
     
     public function show_product(Request $request)
    { 
       $vendor_id = $request->vendor_id;
       $product = DB::table('product')
               ->join('subcat', 'product.subcat_id', '=', 'subcat.subcat_id')
               ->join('tbl_category', 'subcat.category_id', '=', 'tbl_category.category_id')
               ->where('tbl_category.vendor_id', $vendor_id)
               ->get();
               
               
       if(count($product)>0){
            $message = array('status'=>'1', 'message'=>'data found', 'data'=>$product);
        	return $message;
        }
        else{
            $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }		
       
    }
   
    public function incstock(Request $request)
    { 
       $varient_id = $request->varient_id;
       $incstock = $request-> incstock;
       $product1 = DB::table('product_varient')
               ->where('varient_id', $varient_id)
               ->first();
        $oldstock = $product1->stock;      
       
       $newstock = $oldstock + $incstock;
       $product = DB::table('product_varient')
               ->where('varient_id', $varient_id)
               ->update(['stock'=>$newstock]);
               
               
       	if($product){
            $message = array('status'=>'1', 'message'=>'data updated', 'data'=>$product);
        	return $message;
        }
        else{
            $message = array('status'=>'0', 'message'=>'something went wrong', 'data'=>[]);
        	return $message;
        }		
       
    }
   
    public function cancelOrder(Request $request)
    {
        $subs_id = $request->subs_id;
        
        $cancelOrder = DB::table('tbl_subscription')->where('subs_id', $subs_id)->update(['delivery_boy_id'=>'N/A']);
        
        if($cancelOrder){
            $message = array('status'=>'1', 'message'=>'Order Rejected');
        	return $message;
        }
        else{
            $message = array('status'=>'0', 'message'=>'something went wrong');
        	return $message;
        }
    }
      
}