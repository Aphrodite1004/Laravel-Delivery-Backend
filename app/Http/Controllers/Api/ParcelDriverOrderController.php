<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Hash;
use App\Traits\SendMail;
use App\Traits\SendSms;
 
class ParcelDriverOrderController extends Controller
{
use SendMail;
 use SendSms;
    public function parcel_dboy_completed_order(Request $request)
     {
         
        $delivery_boy_id = $request->delivery_boy_id;

        $completeorder  =   DB::table('parcel_details')
                        ->join('tbl_user', 'parcel_details.user_id', '=', 'tbl_user.user_id')
                         ->join('source_address','parcel_details.source_address_id', '=', 'source_address.source_address_id')
                         ->join('destination_address','parcel_details.destination_address_id', '=', 'destination_address.destination_address_id')
                          ->join('parcel_city', 'parcel_details.city_id','=', 'parcel_city.city_id')
                          ->join('vendor', 'parcel_details.vendor_id','=', 'vendor.vendor_id')
                          ->Join('delivery_boy','parcel_details.dboy_id', '=','delivery_boy.delivery_boy_id')    	           
                          ->where('parcel_details.order_status',"Completed")
                          ->where('parcel_details.dboy_id',$delivery_boy_id)
                          ->orderBy('parcel_details.pickup_time', 'desc')
                          ->get();
    	 		   
                          if(count($completeorder)>0){
                            foreach($completeorder as $ords){
                            $data[]=array('parcel_id'=>$ords->parcel_id,'source_address_id'=>$ords->source_address_id,'source_lat'=>$ords->source_lat,'source_lng'=>$ords->source_lng,'source_phone'=>$ords->source_phone,'source_name'=>$ords->source_name,'destination_lat'=>$ords->destination_lat,'destination_lng'=>$ords->destination_lng,'destination_name'=>$ords->destination_name,'destination_phone'=>$ords->destination_phone,'destination_address_id'=>$ords->destination_address_id,'cart_id'=>$ords->cart_id,'user_id'=>$ords->user_id,'vendor_id'=>$ords->vendor_id,'weight'=>$ords->weight,'length'=>$ords->length,'height'=>$ords->height,'width'=>$ords->width,'pickup_time'=>$ords->pickup_time,'pickup_date'=>$ords->pickup_date,'city_id'=>$ords->city_id,'lat'=>$ords->lat,'lng'=>$ords->lng,'charges'=>$ords->charges,'distance'=>$ords->distance,'payment_method'=>$ords->payment_method,'order_status'=>$ords->order_status,'payment_status'=>$ords->payment_status,'wallet'=>$ords->wallet,'dboy_id'=>$ords->dboy_id,'user_name'=>$ords->user_name,'user_email'=>$ords->user_email,'user_image'=>$ords->user_image,'user_phone'=>$ords->user_phone,'user_password'=>$ords->user_password,'device_id'=>$ords->device_id,'wallet_credits'=>$ords->wallet_credits,'rewards'=>$ords->rewards,'otp'=>$ords->otp,'phone_verified'=>$ords->phone_verified,'referral_code'=>$ords->referral_code,'source_pincode'=>$ords->source_pincode,'source_houseno'=>$ords->source_houseno,'source_landmark'=>$ords->source_landmark,'source_add'=>$ords->source_add,'source_state'=>$ords->source_state,'source_city'=>$ords->source_city,'destination_pincode'=>$ords->destination_pincode,'destination_houseno'=>$ords->destination_houseno,'destination_landmark'=>$ords->destination_landmark,'destination_add'=>$ords->destination_add,'destination_state'=>$ords->destination_state,'destination_city'=>$ords->destination_city,'city_name'=>$ords->city_name,'city_image'=>$ords->city_image,'vendor_name'=>$ords->vendor_name,'owner'=>$ords->owner,'vendor_email'=>$ords->vendor_email,'vendor_phone'=>$ords->vendor_phone,'vendor_logo'=>$ords->vendor_logo,'vendor_loc'=>$ords->vendor_loc,'lat'=>$ords->lat,'lng'=>$ords->lng,'opening_time'=>$ords->opening_time,'closing_time'=>$ords->closing_time,'vendor_pass'=>$ords->vendor_pass,'vendor_category_id'=>$ords->vendor_category_id,'comission'=>$ords->comission,'delivery_range'=>$ords->delivery_range,'ui_type'=>$ords->ui_type,'online_status'=>$ords->online_status,'delivery_boy_id'=>$ords->delivery_boy_id,'delivery_boy_name'=>$ords->delivery_boy_name,'delivery_boy_phone'=>$ords->delivery_boy_phone,'delivery_boy_pass'=>$ords->delivery_boy_pass,'is_confirmed'=>$ords->is_confirmed,'phone_verify'=>$ords->phone_verify,'dboy_comission'=>$ords->dboy_comission); 
                                          }
                                        }
                                  else{
                                  $data[]=array('order_details'=>'no orders found');
                                          }
                                          return $data;
    
    }  
    
     public function parcel_dboy_today_order(Request $request)
     {
         $date = date('Y-m-d');
        $delivery_boy_id = $request->delivery_boy_id;

        $todayorder  =   DB::table('parcel_details')
        ->join('tbl_user', 'parcel_details.user_id', '=', 'tbl_user.user_id')
        ->join('source_address','parcel_details.source_address_id', '=', 'source_address.source_address_id')
        ->join('destination_address','parcel_details.destination_address_id', '=', 'destination_address.destination_address_id')
         ->join('parcel_city', 'parcel_details.city_id','=', 'parcel_city.city_id')
         ->join('vendor', 'parcel_details.vendor_id','=', 'vendor.vendor_id')
         ->Join('delivery_boy','parcel_details.dboy_id', '=','delivery_boy.delivery_boy_id')    	              	           
          ->where('parcel_details.order_status','!=', 'completed')
          ->where('parcel_details.vendor_id','!=',0)
          ->where('parcel_details.dboy_id',$delivery_boy_id)
          ->whereDate('parcel_details.pickup_date', $date)
          ->get();
    	 		   
          if(count($todayorder)>0){
            foreach($todayorder as $ords){
                $data[]=array('parcel_id'=>$ords->parcel_id,'source_address_id'=>$ords->source_address_id,'source_lat'=>$ords->source_lat,'source_lng'=>$ords->source_lng,'source_phone'=>$ords->source_phone,'source_name'=>$ords->source_name,'destination_lat'=>$ords->destination_lat,'destination_lng'=>$ords->destination_lng,'destination_name'=>$ords->destination_name,'destination_phone'=>$ords->destination_phone,'destination_address_id'=>$ords->destination_address_id,'cart_id'=>$ords->cart_id,'user_id'=>$ords->user_id,'vendor_id'=>$ords->vendor_id,'weight'=>$ords->weight,'length'=>$ords->length,'height'=>$ords->height,'width'=>$ords->width,'pickup_time'=>$ords->pickup_time,'pickup_date'=>$ords->pickup_date,'city_id'=>$ords->city_id,'lat'=>$ords->lat,'lng'=>$ords->lng,'charges'=>$ords->charges,'distance'=>$ords->distance,'payment_method'=>$ords->payment_method,'order_status'=>$ords->order_status,'payment_status'=>$ords->payment_status,'wallet'=>$ords->wallet,'dboy_id'=>$ords->dboy_id,'user_name'=>$ords->user_name,'user_email'=>$ords->user_email,'user_image'=>$ords->user_image,'user_phone'=>$ords->user_phone,'user_password'=>$ords->user_password,'device_id'=>$ords->device_id,'wallet_credits'=>$ords->wallet_credits,'rewards'=>$ords->rewards,'otp'=>$ords->otp,'phone_verified'=>$ords->phone_verified,'referral_code'=>$ords->referral_code,'source_pincode'=>$ords->source_pincode,'source_houseno'=>$ords->source_houseno,'source_landmark'=>$ords->source_landmark,'source_add'=>$ords->source_add,'source_state'=>$ords->source_state,'source_city'=>$ords->source_city,'destination_pincode'=>$ords->destination_pincode,'destination_houseno'=>$ords->destination_houseno,'destination_landmark'=>$ords->destination_landmark,'destination_add'=>$ords->destination_add,'destination_state'=>$ords->destination_state,'destination_city'=>$ords->destination_city,'city_name'=>$ords->city_name,'city_image'=>$ords->city_image,'vendor_name'=>$ords->vendor_name,'owner'=>$ords->owner,'vendor_email'=>$ords->vendor_email,'vendor_phone'=>$ords->vendor_phone,'vendor_logo'=>$ords->vendor_logo,'vendor_loc'=>$ords->vendor_loc,'lat'=>$ords->lat,'lng'=>$ords->lng,'opening_time'=>$ords->opening_time,'closing_time'=>$ords->closing_time,'vendor_pass'=>$ords->vendor_pass,'vendor_category_id'=>$ords->vendor_category_id,'comission'=>$ords->comission,'delivery_range'=>$ords->delivery_range,'ui_type'=>$ords->ui_type,'online_status'=>$ords->online_status,'delivery_boy_id'=>$ords->delivery_boy_id,'delivery_boy_name'=>$ords->delivery_boy_name,'delivery_boy_phone'=>$ords->delivery_boy_phone,'delivery_boy_pass'=>$ords->delivery_boy_pass,'is_confirmed'=>$ords->is_confirmed,'phone_verify'=>$ords->phone_verify,'dboy_comission'=>$ords->dboy_comission); 
                              } 

                          }
                  else{
                  $data[]=array('order_details'=>'no orders found');
                          }
                          return $data;
        
    } 
    
    
    public function parcel_delivery_accepted_by_dboy(Request $request)
    {
       $cart_id= $request->cart_id;
       $ord = DB::table('parcel_details')
            ->where('cart_id',$cart_id)
            ->first();
        $vendor_id = $ord->vendor_id;
        $user_id=$ord->user_id;    

        $ph = DB::table('tbl_user')
                  ->select('user_phone','wallet_credits')
                  ->where('user_id',$ord->user_id)
                  ->first();
        $user_phone = $ph->user_phone;   
  
        $currency = DB::table('currency')
                  ->first();
       $status = 'Delivery Accepted';
       $update= DB::table('parcel_details')
              ->where('cart_id',$cart_id)
              ->update(['order_status'=>$status]);
              
        if($update){
            
           
    	   $message = array('status'=>'1', 'message'=>'Order Accepted By Delivery Boy');
        	return $message;
    	          }          
            else{
             $message = array('status'=>'0', 'message'=>'something went wrong');
        	return $message;
       }       
              
    }
    
    
     public function parcel_delivery_out(Request $request)
    {
       $cart_id= $request->cart_id;
       $ord = DB::table('parcel_details')
            ->where('cart_id',$cart_id)
            ->first();
        $vendor_id = $ord->vendor_id;
        $user_id=$ord->user_id;    

        $price2=0;
        $ph = DB::table('tbl_user')
                  ->select('user_phone','wallet_credits')
                  ->where('user_id',$ord->user_id)
                  ->first();
        $user_phone = $ph->user_phone;   

        $currency = DB::table('currency')
                  ->first();
             
       $status = 'Out For Delivery';
       $update= DB::table('parcel_details')
              ->where('cart_id',$cart_id)
              ->update(['order_status'=>$status]);
              
        if($update){
            
               
            $sms = DB::table('notificationby')
                      ->select('sms','app')
                      ->where('user_id',$ord->user_id)
                      ->first();
            $sms_status = $sms->sms;
            $sms_api_key=  DB::table('msg91')
    	              ->select('api_key', 'sender_id')
                      ->first();
            $api_key = $sms_api_key->api_key;
            $sender_id = $sms_api_key->sender_id;
                if($sms_status == 1){
              
                }
                
                //////send app notification////
                if($sms->app == 1){
                    if($ord->payment_method=="COD" || $ord->payment_method=="cod"){
                $notification_title = "Out For Delivery";
                $notification_text = "Out For Delivery: Your order id #".$cart_id." of price ".$currency->currency_sign." ".$price2. " is Out For Delivery.Get ready with ".$currency->currency_sign." ".$ord->rem_price. " cash.";
                
                $date = date('d-m-Y');
        
        
                $getDevice = DB::table('tbl_user')
                         ->where('user_id', $user_id)
                        ->select('device_id')
                        ->first();
                $created_at = Carbon::now();
        
                if($getDevice){
                
                
                $getFcm = DB::table('fcm_key')
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
                    else{
                        
                        $notification_title = "Out For Delivery";
                        $notification_text = "Out For Delivery: Your order id #".$cart_id." of price " .$currency->currency_sign." ".$price2. " is Out For Delivery.Get ready.";
                        $date = date('d-m-Y');
                        $getDevice = DB::table('tbl_user')
                                 ->where('user_id', $user_id)
                                ->select('device_id')
                                ->first();
                        $created_at = Carbon::now();
                        if($getDevice){
                        $getFcm = DB::table('fcm_key')
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
                }
                      /////send mail
            $email = DB::table('notificationby')
                  ->select('email')
                  ->where('user_id',$ord->user_id)
                  ->first();
            $email_status = $email->email; 
            $rem_price = $ord->rem_price;
            if($email_status == 1){
                if($ord->payment_method=="COD" || $ord->payment_method=="cod"){
                    $q = DB::table('tbl_user')
                              ->select('user_email','user_name')
                              ->where('user_id',$ord->user_id)
                              ->first();
                    $user_email = $q->user_email;   
                    $user_name = $q->user_name;
                     
                    }
                    else{
                    $q = DB::table('tbl_user')
                              ->select('user_email','user_name')
                              ->where('user_id',$ord->user_id)
                              ->first();
                    $user_email = $q->user_email;   
                    $user_name = $q->user_name;
                       
                    }
              }
    	   $message = array('status'=>'1', 'message'=>'out for delivery');
        	return $message;
    	          }          
            else{
             $message = array('status'=>'0', 'message'=>'something went wrong');
        	return $message;
       }       
              
    }
    
    public function parcel_delivery_completed(Request $request)
    {
        $created_at = Carbon::now();
       $cart_id= $request->cart_id;
       $cash_amount= $request->cash_amount;
       $delivery_boy_id= $request->delivery_boy_id;
       $currency = DB::table('currency')
            ->first();
        $ord = DB::table('parcel_details')
            ->where('cart_id',$cart_id)
            ->first();
          $total_price =  $ord->total_price;
		  $vendor_id=$ord->vendor_id;
		  $payment_method=$ord->payment_method;
          $user_id = $ord->user_id; 
          $vendor = DB::table('vendor')
                    ->select('vendor_name','comission')
                    ->where('vendor_id',$vendor_id)
                    ->first();
                    $vendor_name = $vendor->vendor_name;
                    $comission = $vendor->comission;
                    $comission_value = ($comission/100)* $total_price;
    $delivery_boy_comission = DB::table('delivery_boy')
                            ->select('delivery_boy_name','dboy_comission')
                            ->where('delivery_boy_id',$delivery_boy_id)
                            ->first();  
            
            $dboy_comission = $delivery_boy_comission->dboy_comission;
            $dboy_comission_value = ($dboy_comission/100)* $total_price;
            
            if($request->user_signature){
            $user_signature = $request->user_signature;
            $user_signature = str_replace('data:image/png;base64,', '', $user_signature);
            $fileName = str_replace(" ", "-", $user_signature);
            $fileName = date('dmyHis').'user_signature'.'.'.'png';
            $fileName = str_replace(" ", "-", $fileName);
            \File::put(public_path(). '/images/user/' . $fileName, base64_decode($user_signature));
            $user_signature = 'images/user/'.$fileName;
        }
            else{
                $user_signature = 'N/A';
            }    

        $price2=0;
        $ph = DB::table('tbl_user')
                  ->select('user_phone','wallet_credits','rewards','user_name')
                  ->where('user_id',$ord->user_id)
                  ->first();
        $user_phone = $ph->user_phone;
        $user_name = $ph->user_name;
        $rewards = $ph->rewards;

   
       $status = 'Completed';
       $update= DB::table('parcel_details')
              ->where('cart_id',$cart_id)
              ->update(['order_status'=>$status,'user_signature'=>$user_signature]);
              
        if($update){
                   
            $sms = DB::table('notificationby')
                      ->select('sms','app')
                      ->where('user_id',$ord->user_id)
                      ->first();
            $sms_status = $sms->sms;
            $sms_api_key=  DB::table('msg91')
    	              ->select('api_key', 'sender_id')
                      ->first();
            $api_key = $sms_api_key->api_key;
            $sender_id = $sms_api_key->sender_id;
                if($sms_status == 1){
                   
                   
                }
                ////send notification to app///
                if($sms->app == 1){
                $notification_title = "Order Delivered";
                $notification_text = "Delivery Completed: Your order id #".$cart_id." of price ".$currency->currency_sign." ".$price2." is Delivered Successfully.";
                
                $date = date('d-m-Y');
        
        
                $getDevice = DB::table('tbl_user')
                         ->where('user_id', $user_id)
                        ->select('device_id')
                        ->first();
                $created_at = Carbon::now();
        
                if($getDevice){
                
                
                $getFcm = DB::table('fcm_key')
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
            /////send mail
            $email = DB::table('notificationby')
                  ->select('email')
                  ->where('user_id',$ord->user_id)
                  ->first();
            $email_status = $email->email;       
            if($email_status == 1){
                    $q = DB::table('tbl_user')
                              ->select('user_email','user_name')
                              ->where('user_id',$ord->user_id)
                              ->first();
                    $user_email = $q->user_email;             
                    $user_name =$q->user_name;
                   // $successmail = $this->delcomMail($cart_id, $prod_name, $price2,$user_email,$user_name); 
              }
			  ////rewards earned////
           $checkre =DB::table('reward_points')
                    ->where('min_cart_value','<=',$ord->total_price)
                    ->orderBy('min_cart_value','desc')
                    ->first();
            if($checkre){       
           $reward_point = $checkre->reward_point;
           $updated_reward_point = $reward_point + $rewards;
           
           $inreward = DB::table('tbl_user')
                     ->where('user_id',$user_id)
                     ->update(['rewards'=>$updated_reward_point]);
           
           $cartreward = DB::table('reward_history')
                     ->insert(['cart_id'=>$cart_id, 'reward_points'=>$reward_point, 'user_id'=>$user_id,'total_amount'=>$ord->total_price,'created_at'=>$created_at]);
            $comission = DB::table('comission')   
                        ->insert(['cart_id'=>$cart_id, 'vendor_id'=>$vendor_id, 'vendor_name'=>$vendor_name,'comission_price'=>$comission_value,'order_date'=>$created_at,'user_name'=>$user_name,'status'=>'Pending','total_price'=>$total_price,'payment_method'=>$payment_method]);
            $cash_collect = DB::table('cash_collect')   
                        ->insert(['cart_id'=>$cart_id, 'vendor_id'=>$vendor_id,'user_id'=>$user_id,'amount'=>$cash_amount,'date_of_collection'=>$created_at,'delivery_boy_id'=>$delivery_boy_id,'created_at'=>$created_at,'no_of_orders'=>1]);
            $dboy_comission = DB::table('delivery_boy_comission')   
                        ->insert(['cart_id'=>$cart_id, 'vendor_id'=>$vendor_id,'comission_price'=>$dboy_comission_value,'order_date'=>$created_at,'user_name'=>$user_name,'status'=>'Pending','total_price'=>$total_price,'payment_method'=>$payment_method,'delivery_boy_id'=>$delivery_boy_id]);           
            }
    	   $message = array('status'=>'1', 'message'=>'Delivery Completed');
        	return $message;
    	          }          
            else{
             $message = array('status'=>'0', 'message'=>'something went wrong');
        	return $message;
       }       
              
    }
    
    public function cashcollect (Request $request)
    {
        $delivery_boy_id = $request->delivery_boy_id;
        $cash =  DB::table('cash_collect')
                ->select(DB::raw('SUM(amount) as sum') ,DB::raw('count(no_of_orders) as count'))
                ->where('delivery_boy_id',$delivery_boy_id)
                ->first();
    
            if($cash)
            {
                $message = array('status'=>'1', 'message'=>'Total Cash', 'data'=>$cash);
        	    return $message;
            }
            else
            {
                $message = array('status'=>'0', 'message'=>'data found');
        	    return $message;
            }
    }
    
    public function parcel_today_order_count(Request $request)
    {
        $date = date('Y-m-d');
        $delivery_boy_id = $request->delivery_boy_id;
        
        $ord =DB::table('parcel_details')
             ->where('parcel_details.order_status','=', 'Confirmed')
             ->where('parcel_details.vendor_id','!=',0)
             ->where('parcel_details.dboy_id',$delivery_boy_id)
             ->where('parcel_details.pickup_date', $date)
             ->count();
             
         if($ord>0)
            {
                $message = array('status'=>'1', 'message'=>"Today's Pending Order", 'data'=>$ord);
        	    return $message;
            }
            else
            {
                $message = array('status'=>'0', 'message'=>'data found');
        	    return $message;
            }     
    }
    

}