<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Hash;
use Session;
use App\Traits\SendMail;
use App\Traits\SendSms;

class StoreOrderController extends Controller
{
     use SendMail;
    use SendSms;
   public function store_today_order(Request $request)
    {
 
    			
    	$currentDate = date('Y-m-d');
        $day = 1;
       $current2 = date('d-m-Y', strtotime($currentDate.' + '.$day.' days'));
    			
    	 $vendor_id = $request->vendor_id;			
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
                
                           if(count($todayorder)>0){
                            foreach($todayorder as $ords){
                                   $cart_id = $ords->cart_id;    
                               $details  =   DB::table('order_details')
                                             ->join('product_varient', 'order_details.varient_id', '=', 'product_varient.varient_id')
                                             ->join('product','product_varient.product_id', '=', 'product.product_id')
                                             ->select('product.product_name','product_varient.price','product_varient.price','product_varient.unit','product_varient.quantity','product_varient.varient_image','product_varient.description','order_details.varient_id','order_details.store_order_id','order_details.qty', DB::raw('SUM(order_details.qty) as total_items'))
                                            ->where('order_details.order_cart_id',$cart_id)
                                            ->groupBy('product.product_name','product_varient.price','product_varient.price','product_varient.unit','product_varient.quantity','product_varient.varient_image','product_varient.description','order_details.varient_id','order_details.store_order_id','order_details.qty')
                                            ->get(); 

                                            $data[]=array('area_id'=>$ords->area_id,'order_id'=>$ords->order_id, 'user_id'=>$ords->user_id, 'delivery_date'=>$ords->delivery_date,'user_name'=>$ords->user_name, 'dboy_id'=>$ords->dboy_id, 'delivery_charge'=>$ords->delivery_charge, 'total_price'=>$ords->total_price,'total_product_mrp'=>$ords->total_products_mrp,'delivery_boy_name'=>$ords->delivery_boy_name,'order_status'=>$ords->order_status,'cart_id'=>$cart_id,'user_number'=>$ords->user_number,'address'=>$ords->address , 'time_slot'=>$ords->time_slot,'paid_by_wallet'=>$ords->paid_by_wallet,'remaining_price'=>$ords->rem_price,'price_without_delivery'=>$ords->price_without_delivery,'coupon_discount'=>$ords->coupon_discount,'vendor_name'=>$ords->vendor_name,'payment_method'=>$ords->payment_method,'payment_status'=>$ords->payment_status,'delivery_boy_num'=>$ords->delivery_boy_phone,'order_details'=>$details); 
                                          }
                                          }
                                  else{
                                  $data[]=array('order_details'=>'no orders found');
                                          }
                                          return $data;

      }

 

      public function store_next_day_order(Request $request)
      {
   
                  
        $currentDate = date('Y-m-d');
        $day = 1;
        $end = date('Y-m-d', strtotime($currentDate.' + '.$day.' days'));
                  
           $vendor_id = $request->vendor_id;			
           $nextdayorder  =   DB::table('orders')
           ->join('tbl_user', 'orders.user_id', '=', 'tbl_user.user_id')
           ->join('user_address','orders.address_id', '=', 'user_address.address_id')
           ->join('area', 'user_address.area_id','=', 'area.area_id')
           ->join('vendor_area', 'area.area_id','=', 'vendor_area.area_id')
      ->join('vendor', 'vendor_area.vendor_id','=', 'vendor.vendor_id')
           ->leftJoin('delivery_boy','orders.dboy_id', '=','delivery_boy.delivery_boy_id')
           ->select('area.area_id','orders.order_id','orders.user_id','orders.delivery_date','orders.payment_method','orders.payment_status','tbl_user.user_name','orders.dboy_id','orders.delivery_charge', 'orders.total_price','orders.total_products_mrp','orders.delivery_charge','delivery_boy.delivery_boy_name','delivery_boy.delivery_boy_phone','orders.dboy_id','orders.order_status','orders.cart_id','orders.delivery_date','user_address.user_number','user_address.user_name','user_address.address','orders.time_slot','orders.delivery_charge','orders.paid_by_wallet','orders.rem_price','orders.price_without_delivery','orders.coupon_discount','vendor.vendor_name')
           ->groupBy('area.area_id','orders.order_id','orders.user_id','orders.delivery_date','orders.payment_method','orders.payment_status','tbl_user.user_name','orders.dboy_id','orders.delivery_charge', 'orders.total_price','orders.total_products_mrp','orders.delivery_charge','delivery_boy.delivery_boy_name','delivery_boy.delivery_boy_phone','orders.dboy_id','orders.order_status','orders.cart_id','orders.delivery_date','user_address.user_number','user_address.user_name','user_address.address','orders.time_slot','orders.delivery_charge','orders.paid_by_wallet','orders.rem_price','orders.price_without_delivery','orders.coupon_discount','vendor.vendor_name')
           ->whereDate('orders.delivery_date', $end)
            ->where('orders.payment_status','!=', 'NULL')
           ->where('orders.vendor_id', $vendor_id)
           ->where('orders.order_status','!=', 'Cancelled')
            ->where('orders.ui_type','=', '1')
            ->where('orders.order_status','!=', 'Completed')
           ->orderBy('user_id')
           ->get();  

           if(count($nextdayorder)>0){
            foreach($nextdayorder as $ords){
                   $cart_id = $ords->cart_id;    
               $details  =   DB::table('order_details')
                             ->join('product_varient', 'order_details.varient_id', '=', 'product_varient.varient_id')
                             ->join('product','product_varient.product_id', '=', 'product.product_id')
                             ->select('product.product_name','product_varient.price','product_varient.price','product_varient.unit','product_varient.quantity','product_varient.varient_image','product_varient.description','order_details.varient_id','order_details.store_order_id','order_details.qty', DB::raw('SUM(order_details.qty) as total_items'))
                            ->where('order_details.order_cart_id',$cart_id)
                            ->groupBy('product.product_name','product_varient.price','product_varient.price','product_varient.unit','product_varient.quantity','product_varient.varient_image','product_varient.description','order_details.varient_id','order_details.store_order_id','order_details.qty')
                            ->get(); 

       
  
   
                              
                            $data[]=array('area_id'=>$ords->area_id,'order_id'=>$ords->order_id, 'user_id'=>$ords->user_id, 'delivery_date'=>$ords->delivery_date,'user_name'=>$ords->user_name, 'dboy_id'=>$ords->dboy_id, 'delivery_charge'=>$ords->delivery_charge, 'total_price'=>$ords->total_price,'total_product_mrp'=>$ords->total_products_mrp,'delivery_boy_name'=>$ords->delivery_boy_name,'order_status'=>$ords->order_status,'cart_id'=>$cart_id,'user_number'=>$ords->user_number,'address'=>$ords->address , 'time_slot'=>$ords->time_slot,'paid_by_wallet'=>$ords->paid_by_wallet,'remaining_price'=>$ords->rem_price,'price_without_delivery'=>$ords->price_without_delivery,'coupon_discount'=>$ords->coupon_discount,'vendor_name'=>$ords->vendor_name,'payment_method'=>$ords->payment_method,'payment_status'=>$ords->payment_status,'delivery_boy_num'=>$ords->delivery_boy_phone,'order_details'=>$details); 
                          }
                          }
                  else{
                  $data[]=array('order_details'=>'no orders found');
                          }
                          return $data;
        }



          public function store_complete_order(Request $request)
          {
              
            $vendor_id = $request->vendor_id;			
                      
            $completeorder  =   DB::table('orders')
             ->join('tbl_user', 'orders.user_id', '=', 'tbl_user.user_id')
             ->join('user_address','orders.address_id', '=', 'user_address.address_id')
             ->join('area', 'user_address.area_id','=', 'area.area_id')
             ->join('vendor_area', 'area.area_id','=', 'vendor_area.area_id')
              ->join('vendor', 'vendor_area.vendor_id','=', 'vendor.vendor_id')
             ->leftJoin('delivery_boy','orders.dboy_id', '=','delivery_boy.delivery_boy_id')
             ->select('area.area_id','orders.order_id','orders.user_id','orders.delivery_date','orders.payment_method','orders.payment_status','tbl_user.user_name','orders.dboy_id','orders.delivery_charge', 'orders.total_price','orders.total_products_mrp','orders.delivery_charge','delivery_boy.delivery_boy_name','orders.dboy_id','orders.order_status','orders.cart_id','orders.delivery_date','user_address.user_number','user_address.user_name','user_address.address','orders.time_slot','orders.delivery_charge','orders.paid_by_wallet','orders.rem_price','orders.price_without_delivery','orders.coupon_discount','vendor.vendor_name')
             ->groupBy('area.area_id','orders.order_id','orders.user_id','orders.delivery_date','orders.payment_method','orders.payment_status','tbl_user.user_name','orders.dboy_id','orders.delivery_charge', 'orders.total_price','orders.total_products_mrp','orders.delivery_charge','delivery_boy.delivery_boy_name','orders.dboy_id','orders.order_status','orders.cart_id','orders.delivery_date','user_address.user_number','user_address.user_name','user_address.address','orders.time_slot','orders.delivery_charge','orders.paid_by_wallet','orders.rem_price','orders.price_without_delivery','orders.coupon_discount','vendor.vendor_name')
              ->where('orders.order_status',"Completed")
               ->where('orders.ui_type','=', '1')
             ->where('orders.vendor_id', $vendor_id)
             ->orderBy('user_id')
             ->get();
            
            if(count($completeorder)>0){
           foreach($completeorder as $ords){
                  $cart_id = $ords->cart_id;    
              $details  =   DB::table('order_details')
                            ->join('product_varient', 'order_details.varient_id', '=', 'product_varient.varient_id')
                            ->join('product','product_varient.product_id', '=', 'product.product_id')
                            ->select('product.product_name','product_varient.price','product_varient.price','product_varient.unit','product_varient.quantity','product_varient.varient_image','product_varient.description','order_details.varient_id','order_details.store_order_id','order_details.qty', DB::raw('SUM(order_details.qty) as total_items'))
                           ->where('order_details.order_cart_id',$cart_id)
                           ->groupBy('product.product_name','product_varient.price','product_varient.price','product_varient.unit','product_varient.quantity','product_varient.varient_image','product_varient.description','order_details.varient_id','order_details.store_order_id','order_details.qty')
                           ->get(); 
                       
             
             $data[]=array('area_id'=>$ords->area_id,'order_id'=>$ords->order_id, 'user_id'=>$ords->user_id, 'delivery_date'=>$ords->delivery_date,'user_name'=>$ords->user_name, 'dboy_id'=>$ords->dboy_id, 'delivery_charge'=>$ords->delivery_charge, 'total_price'=>$ords->total_price,'total_product_mrp'=>$ords->total_products_mrp,'delivery_boy_name'=>$ords->delivery_boy_name,'order_status'=>$ords->order_status,'cart_id'=>$cart_id,'user_number'=>$ords->user_number,'address'=>$ords->address , 'time_slot'=>$ords->time_slot,'paid_by_wallet'=>$ords->paid_by_wallet,'remaining_price'=>$ords->rem_price,'price_without_delivery'=>$ords->price_without_delivery,'coupon_discount'=>$ords->coupon_discount,'vendor_name'=>$ords->vendor_name,'payment_method'=>$ords->payment_method,'payment_status'=>$ords->payment_status,'order_details'=>$details); 
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
                       
                       $notification_title = "New Order Assign";
                
                       $getDevice = DB::table('delivery_boy')
                         ->where('delivery_boy_id', $delivery_id)
                        ->select('device_id','delivery_boy_name')
                        ->first();
                        $delivery_boy_name = $getDevice->delivery_boy_name;
                          $created_at = Carbon::now();
                          
                          $notification_text = "Hi, .$delivery_boy_name. you received new order please check the details ";
                       
                       if($update)
                       
                       {
                                $getFcm = DB::table('fcm_key')
                                 ->first();
                                        
                            $getFcmKey = $getFcm->dboy_app_key;
                            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                            $token = $getDevice->device_id;
                    
        
                    $notification = [
                        'title' => $notification_title,
                        'body' => $notification_text,
                        'sound' => true,
                    ];
                    
                    $extraNotificationData = ["message" => $notification];
        
                    $fcmNotification = [
                        'to'        => $token,
                        'notification' => $notification,
                        'data' => $extraNotificationData,
                    ];
        
                    $headers = [
                        'Authorization: key='.$getFcmKey,
                        'Content-Type: application/json'
                    ];
        
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,$fcmUrl);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                    $result = curl_exec($ch);
                    curl_close($ch);
                    
             
                
                    
                $results = json_decode($result);
                
                            
                $mess = array('status'=>'1', 'message'=>'Delivery boy assigned successfully', 'data'=>$update);
                        return $mess;
                } 
                 else{
                        
                        
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
         
         
          public function order_generate_by_store(Request $request)
    {   
        $current = Carbon::now();
        $data= $request->order_array;
        $data_array = json_decode($data);
        $user_id= $request->user_id;
        $delivery_date = $request-> delivery_date;
        $time_slot= $request->time_slot;
        $vendor_id = $request->vendor_id;
        $ui_type = $request->ui_type;
        $address_id = $request->address_id;
        $ord_id = $request->ord_id;
        
        $address = DB::table('user_address')
                    ->select('area_id')
                    ->where('address_id',$address_id)
                    ->first();
        $vendor_area =   DB::table('vendor_area')
                    ->select('delivery_charge')
                    ->where('area_id',$address->area_id)
                    ->where('vendor_id',$vendor_id)
                    ->first(); 
                    
        $delivery_charge1 =    $vendor_area->delivery_charge;        
          
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $val = "";
                for ($i = 0; $i < 4; $i++){
                    $val .= $chars[mt_rand(0, strlen($chars)-1)];
                }
                
        $chars2 = "0123456789";
                $val2 = "";
                for ($i = 0; $i < 2; $i++){
                    $val2 .= $chars2[mt_rand(0, strlen($chars2)-1)];
                }        
        $cr  = substr(md5(microtime()),rand(0,26),2);
        $cart_id = $val.$val2.$cr;
        $price2=0;
        $price5=0;
        $ph = DB::table('tbl_user')
                  ->select('user_phone','wallet_credits')
                  ->where('user_id',$user_id)
                  ->first();
        $user_phone = $ph->user_phone;
      
       
    foreach ($data_array as $h){
        $varient_id = $h->varient_id;
         $p =  DB::table('product_varient')
             ->join('product','product_varient.product_id','=','product.product_id')
           ->Leftjoin('deal_product','product_varient.varient_id','=','deal_product.varient_id')
           ->where('product_varient.varient_id',$varient_id)
           ->where('product_varient.vendor_id',$vendor_id)
           ->first();
         if($p->deal_price != NULL &&  $p->valid_from < $current && $p->valid_to > $current){
          $price= $p->deal_price;    
        }else{
      $price = $p->price;
        } 
        
        $mrpprice = $p->strick_price;
        $order_qty = $h->qty;
        $price2+= $price*$order_qty;
        $price5+=$mrpprice*$order_qty;
        $unit[] = $p->unit;
        $qty[]= $p->quantity;
        $p_name[] = $p->product_name."(".$p->quantity.$p->unit.")*".$order_qty;
        $prod_name = implode(',',$p_name);
        
    }    
    
    foreach ($data_array as $h)
    { 
        $varient_id = $h->varient_id;
        $p =  DB::table('product_varient')
             ->join('product','product_varient.product_id','=','product.product_id')
           ->Leftjoin('deal_product','product_varient.varient_id','=','deal_product.varient_id')
           ->where('product_varient.varient_id',$varient_id)
           ->where('product_varient.vendor_id',$vendor_id)
           ->first();
        if($p->deal_price != NULL &&  $p->valid_from < $current && $p->valid_to > $current){
          $price= $p->deal_price;    
        }else{
      $price = $p->price;
        } 
        $mrp = $p->strick_price;
        $order_qty = $h->qty;
        $price1= $price*$order_qty;
        $total_mrp = $mrp*$order_qty;
        $order_qty = $h->qty;
       
        $n =$p->product_name;
     

        $insert = DB::table('order_details')
                ->insertGetId([
                        'varient_id'=>$varient_id,
                        'qty'=>$order_qty,
                        'product_name'=>$n,
                        'varient_image'=>$p->varient_image,
                        'quantity'=>$p->quantity,
                        'unit'=>$p->unit,
                        'total_mrp'=>$total_mrp,
                        'order_cart_id'=>$cart_id,
                        'order_date'=>$current,
                        'addon_price'=>0,
                        'price'=>$price1]);
      
 }
 
 
  if($insert){
        $oo = DB::table('orders')
            ->insertGetId(['cart_id'=>$cart_id,
            'total_price'=>$price2 + $delivery_charge1,
            'price_without_delivery'=>$price2,
            'total_products_mrp'=>$price5,
            'delivery_charge'=>$delivery_charge1,
            'user_id'=>$user_id,
            'dboy_incentive'=>0,
            'vendor_id'=>$vendor_id,
            'rem_price'=>$price2 + $delivery_charge1,
            'order_date'=> $current,
            'delivery_date'=> $delivery_date,
            'time_slot'=>$time_slot,
            'ui_type'=>$ui_type,
            'address_id'=>$address_id,
            'payment_method'=>'COD',
            'payment_status'=>'COD',
            ]); 
            
             $dellist= DB::table('order_by_photo')
                     ->where('ord_id',$ord_id)
                     ->delete();
            
    
                    
          $ordersuccessed = DB::table('orders')
                          ->where('order_id',$oo)
                          ->first();
        
  
        }
        $sms = DB::table('notificationby')
                       ->select('sms')
                       ->where('user_id',$user_id)
                       ->first();
            $sms_status = $sms->sms;
            
                if($sms_status == 1){
                    $orderplacedmsg = $this->ordersuccessfull($cart_id,$prod_name,$price2,$delivery_date,$time_slot,$user_phone);
                }
                      /////send mail
            $email = DB::table('notificationby')
                   ->select('email','app')
                   ->where('user_id',$user_id)
                   ->first();
             $q = DB::table('tbl_user')
                              ->select('user_email','user_name')
                              ->where('user_id',$user_id)
                              ->first();
            $user_email = $q->user_email;             
                 
            $user_name = $q->user_name;       
            $email_status = $email->email;       
            if($email_status == 1){
                   
                    $codorderplaced = $this->photoorderplacedMail($cart_id,$prod_name,$price2,$delivery_date,$user_email,$user_name);
               }
             if($email->app ==1){
                  $notification_title = "Hey ".$user_name.", Your Order is Placed";
                $notification_text = "Order Successfully Placed: Your order id #".$cart_id." contains of " .$prod_name." of price rs ".$price2. " is placed Successfully.You can expect your item(s) will be delivered on ".$delivery_date;
                
                $date = date('d-m-Y');
        
        
                $getDevice = DB::table('tbl_user')
                         ->where('user_id', $user_id)
                        ->select('device_id')
                        ->first();
                $created_at = Carbon::now();
        
                if($getDevice){
                
                
                $getFcm = DB::table('fcm_key')
                            ->where('unique_id', '1')
                            ->first();
                            
                $getFcmKey = $getFcm->user_app_key;
                $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                $token = $getDevice->device_id;
                    
        
                    $notification = [
                        'title' => $notification_title,
                        'body' => $notification_text,
                        'sound' => true,
                    ];
                    
                    $extraNotificationData = ["message" => $notification];
        
                    $fcmNotification = [
                        'to'        => $token,
                        'notification' => $notification,
                        'data' => $extraNotificationData,
                    ];
        
                    $headers = [
                        'Authorization: key='.$getFcmKey,
                        'Content-Type: application/json'
                    ];
        
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,$fcmUrl);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                    $result = curl_exec($ch);
                    curl_close($ch);
                    
             
                $dd = DB::table('user_notification')
                    ->insert(['user_id'=>$user_id,
                     'noti_title'=>$notification_title,
                     'noti_message'=>$notification_text]);
                    
                $results = json_decode($result);
                }
             }  
                $orderr1 = DB::table('orders')
                       ->where('cart_id', $cart_id)
                       ->first();   
           
                ///////send notification to store//////
                $getD = DB::table('vendor')
                         ->where('vendor_id', $vendor_id)
                        ->first();
                        
                $store_n = $getD->vendor_name;        
                $notification_title = "Hey ".$store_n.", You Got a New Order";
                $notification_text = "Order with cart id #".$cart_id." contains of " .$prod_name." of price rs ".$price2. " has been created successfully. It will have to delivered on ".$delivery_date.".";
                
                $date = date('d-m-Y');
                $getUser = DB::table('vendor')
                                ->get();
        
                $getDevice = DB::table('vendor')
                         ->where('vendor_id', $vendor_id)
                        ->select('device_id')
                        ->first();
                $created_at = Carbon::now();
        
                if($getDevice){
                
                
                $getFcm = DB::table('fcm_key')
                            ->where('unique_id', '1')
                            ->first();
                            
                $getFcmKey = $getFcm->vendor_app_key;
                $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                $token = $getDevice->device_id;
                    
        
                    $notification = [
                        'title' => $notification_title,
                        'body' => $notification_text,
                        'sound' => true,
                    ];
                    
                    $extraNotificationData = ["message" => $notification];
        
                    $fcmNotification = [
                        'to'        => $token,
                        'notification' => $notification,
                        'data' => $extraNotificationData,
                    ];
        
                    $headers = [
                        'Authorization: key='.$getFcmKey,
                        'Content-Type: application/json'
                    ];
        
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,$fcmUrl);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                    $result = curl_exec($ch);
                    curl_close($ch);
                    
                     ///////send notification to store//////
             
                $dd = DB::table('vendor_notification')
                    ->insert(['vendor_id'=>$vendor_id,
                     'not_title'=>$notification_title,
                     'not_message'=>$notification_text,
                     'read_by_vendor'=>'0']);
                    
                $results = json_decode($result);
                }
            
        
          if($oo){
        	$message = array('status'=>'1', 'message'=>'Order Created Successfully ', 'data'=>$ordersuccessed );
        	return $message;
        }
        
        else{
        	$message = array('status'=>'0', 'message'=>'insertion failed', 'data'=>[]);
        	return $message;
        }
       
       
 }
 
 
           public function reject_by_vendor(Request $request)
    {
         $ord_id=$request->id;
         $cause = $request->cause;
    			
    	 $ord = DB::table('order_by_photo')
    	 		->where('ord_id',$ord_id)
    	 		->first();	
    	 $user_id = $ord->user_id;		
    	 $user = DB::table('tbl_user')
    	 		->where('user_id',$user_id)
    	 		->first();
         
         
         $checknotificationby = DB::table('notificationby')
                              ->where('user_id',$user_id)
                              ->first();
         if($checknotificationby->sms == 1){
         $sendmsg = $this->sendrejectmsgbystore($cause,$user,$ord_id);
         }
         if($checknotificationby->app == 1){
         //////send notification to user//////////
             $notification_title = "Sorry! we are reject your order";
                        $notification_text = 'Hello '.$user->user_name.', We are cancelling your order no. = '.$ord_id.' due to following reason:  '.$cause;
                        $date = date('d-m-Y');
                        $getDevice = DB::table('tbl_user')
                                 ->where('user_id', $user_id)
                                ->select('device_id')
                                ->first();
                        $created_at = Carbon::now();
                        if($getDevice){
                        $getFcm = DB::table('fcm_key')
                                    ->where('unique_id', '1')
                                    ->first();
                                    
                        $getFcmKey = $getFcm->user_app_key;
                        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                        $token = $getDevice->device_id;
                            $notification = [
                                'title' => $notification_title,
                                'body' => $notification_text,
                                'sound' => true,
                            ];
                            $extraNotificationData = ["message" => $notification];
                            $fcmNotification = [
                                'to'        => $token,
                                'notification' => $notification,
                                'data' => $extraNotificationData,
                            ];
                
                            $headers = [
                                'Authorization: key='.$getFcmKey,
                                'Content-Type: application/json'
                            ];
                
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL,$fcmUrl);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                            $result = curl_exec($ch);
                            curl_close($ch);
                        $dd = DB::table('user_notification')
                            ->insert(['user_id'=>$user_id,
                             'noti_title'=>$notification_title,
                             'noti_message'=>$notification_text]);
                            
                        $results = json_decode($result);
                        }
         }
         
          $ord =DB::table('order_by_photo')
                         ->where('ord_id', $ord_id)
                         ->update(['reason'=>"Cancelled by Store due to the following reason: ".$cause,
                         'processed'=>"2"]);
                         
                         
           if($ord){
                $message = array('status'=>'1', 'message'=>'Order Cancelled Successfully ');
                return $message;
                            }		
          else{
                 $message = array('status'=>'0', 'message'=>'something went wrong');
	            return $message;
    	}
    }
 

}
