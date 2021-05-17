<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Hash;


class deliveryboyController extends Controller
{
    
    public function dboylogin(Request $request)
    {
    	$delivery_boy_phone = $request->delivery_boy_phone;
    	$device_id = $request->device_id;
    	
    	// check for mobile verify or not
    	$mobilecheckdeliveryboy = DB::table('delivery_boy')
    	                        ->where('delivery_boy_phone', $delivery_boy_phone)
    	                        ->where('phone_verify', '0')
            					->first();
            					
        if($mobilecheckdeliveryboy){
            $chars = "0123456789";
            $otpval = "";
            for ($i = 0; $i < 4; $i++){
                $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
            }
            
            //send otp to delivery boy's number
                $sms_api_key=  DB::table('sms_api')
                	              ->select('sms_api_key', 'sender_id')
                                  ->first();
                $api_key = $sms_api_key->sms_api_key;
                $sender_id = $sms_api_key->sender_id;
    
                $getAuthKey = $api_key;
                $getSenderId = $sender_id;
                $getInvitationMsg = "Your OTP is: ".$otpval.".\nNote: Please DO NOT SHARE this OTP with anyone."; 
    
                $authKey = $getAuthKey;
                $mobileNumber = $delivery_boy_phone;
                $senderId = $getSenderId;
                $message = $getInvitationMsg;
                $route = "4";
                $postData = array(
                    'authkey' => $authKey,
                    'mobiles' => $mobileNumber,
                    'message' => $message,
                    'sender' => $senderId,
                    'route' => $route
                );
    
                $url="https://control.msg91.com/api/sendhttp.php";
    
                $ch = curl_init();
                curl_setopt_array($ch, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $postData
                    //,CURLOPT_FOLLOWLOCATION => true
                ));
    
                //Ignore SSL certificate verification
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    
                //get response
                $output = curl_exec($ch);
    
                curl_close($ch);
                
                $updateOtpStatus = DB::table('delivery_boy')
                                        ->where('delivery_boy_phone',$delivery_boy_phone)
                                        ->update(['otp'=>$otpval]);
            
            $message = array('status'=>'4', 'message'=>'Pending for mobile verification');
	        return $message;
        }
    	
    	// check for confirmation
    	$checkdeliveryboy = DB::table('delivery_boy')
    	                        ->where('delivery_boy_phone', $delivery_boy_phone)
    	                        ->where('is_confirmed', '0')
            					->first();
            					
        if($checkdeliveryboy){
            $message = array('status'=>'2', 'message'=>'Pending for Admin Acceptance');
	        return $message;
        }
        
                
    	$checkUser = DB::table('delivery_boy')
    					->where('delivery_boy_phone', $delivery_boy_phone)
    					->first();
    				
         				

    	if($checkUser){
    	   if(Hash::check($delivery_boy_pass,$checkUser->delivery_boy_pass)){
    		    $updateDeviceId = DB::table('delivery_boy')
    		                        ->where('delivery_boy_phone', $delivery_boy_phone)
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
    		$message = array('status'=>'0', 'message'=>'you are not registered');
	        return $message;
    	}
    }
    
    
    public function dboyprofile(Request $request)
    {   
        $delivery_boy_id = $request->delivery_boy_id;
         $user =  DB::table('delivery_boy')
                ->where('delivery_boy_id', $delivery_boy_id )
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
    
    public function dboy_status(Request $request)
    {
    	$delivery_boy_id = $request->delivery_boy_id; 
    	$status = $request->status; 
    	
    	if($status==1){
    	    $user =  DB::table('delivery_boy')
                ->where('delivery_boy_id', $delivery_boy_id )
                ->update(['delivery_boy_status'=> 'online']);
             if($user) {  
            $message = array('status'=>'1', 'message'=>'you are online now');
        	         return $message;
        	         }
        	  else{
        	     $message = array('status'=>'0', 'message'=>'something went wrong');
        	         return $message;
        	  }    
                
    	}
    	else{
    	    $user =  DB::table('delivery_boy')
                ->where('delivery_boy_id', $delivery_boy_id )
                ->update(['delivery_boy_status'=> 'offline']);
            
        	         
          if($user) {  
           $message = array('status'=>'2', 'message'=>'you are offline now');
        	         return $message;   
        	         }
        	  else{
        	     $message = array('status'=>'3', 'message'=>'something went wrong');
        	         return $message;
        	  }    	         
    	}
  
    } 
    
    
    



 






      
      
    // send otp for mark delivered
    public function sendotpformarked(Request $request)
    {
        $subs_id = $request->subs_id;
        // generate otp
        $order = DB::table('tbl_subscription')
                    ->join('tbl_user', 'tbl_user.user_id', '=', 'tbl_subscription.user_id')
                    ->where('tbl_subscription.subs_id', $subs_id)
                    ->first();
                    
        $chars = "0123456789";
        $otpval = "";
        for ($i = 0; $i < 4; $i++){
            $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
        }
            
        //send otp to delivery boy's number
        $sms_api_key=  DB::table('sms_api')
            	              ->select('sms_api_key', 'sender_id')
                              ->first();
        $api_key = $sms_api_key->sms_api_key;
        $sender_id = $sms_api_key->sender_id;
    
        $getAuthKey = $api_key;
        $getSenderId = $sender_id;
        $getInvitationMsg = "Your OTP is: ".$otpval.".\nNote: This OTP is only for mark delivered. Please SHARE this OTP with delivery boy."; 
    
        $authKey = $getAuthKey;
        $mobileNumber = $order->user_phone;
        $senderId = $getSenderId;
        $message = $getInvitationMsg;
        $route = "4";
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route
        );
    
        $url="https://control.msg91.com/api/sendhttp.php";
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));
    
        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    
        //get response
        $output = curl_exec($ch);
    
        curl_close($ch);
                
        $updateOtpStatus = DB::table('tbl_subscription')
                                ->where('subs_id', $subs_id)
                                ->update(['otp'=>$otpval]);
                                
        if($updateOtpStatus){
            $message = array('status'=>'1', 'message'=>'OTP sent to user');
	        return $message;
        }
        else{
            $message = array('status'=>'0', 'message'=>'Something Wrong');
	        return $message;
        }
    }
     
    // verify otp for mark delivered
    public function verifyotpformarked(Request $request)
    {
        $subs_id = $request->subs_id;
        $otp = $request->otp;
        
        // verify otp
        $order = DB::table('tbl_subscription')
                    ->where('subs_id', $subs_id)
                    ->first();
                    
        if($otp == $order->otp && $otp != '' && $otp != NULL){
            // chenage otp
            $orderOtp = DB::table('tbl_subscription')
                        ->where('subs_id', $subs_id)
                        ->update(['otp'=>NULL]);
                        
            $message = array('status'=>'1', 'message'=>'Correct OTP.');
	        return $message;
        }
        else{
            $message = array('status'=>'0', 'message'=>'Wrong OTP.');
	        return $message;
        }
    }
     
  public function marked(Request $request)
   {
      $cart_id= $request->cart_id;
      $datasub = DB::table('tbl_orders')
                  ->join('tbl_subscription', 'tbl_orders.order_cart_id','=','tbl_subscription.cart_id')
                  ->leftJoin('subscription_plans', 'tbl_orders.plan_id', '=','subscription_plans.plan_id')
                  ->select('tbl_subscription.varient_id','tbl_orders.user_id','tbl_orders.total_price','tbl_orders.status','tbl_orders.delivery_boy_id','tbl_orders.delivery_date','tbl_orders.delivery_boy_incentive','tbl_orders.pause_start','tbl_orders.pause_end','subscription_plans.skip_days','tbl_orders.end_date','tbl_subscription.order_qty','tbl_subscription.varient_id')
                  ->where('tbl_orders.order_cart_id', $cart_id)
                  ->get();
    foreach($datasub as $datasubs)
    {
      $user_id = $datasubs->user_id;             
      $price = $datasubs->total_price;
      $order_qty = $datasubs->order_qty;
      $product_idd = $datasubs->varient_id;
       $status = $datasubs->status;
      $delivery_date = $datasubs->delivery_date;
      $delivery_boy_id = $datasubs->delivery_boy_id;
      $delivery_boy_incentive = $datasubs->delivery_boy_incentive;
      $pause_start_date = $datasubs->pause_start;
      $pause_end_date = $datasubs->pause_end;
      $skip_days = $datasubs->skip_days;
      $end_date = $datasubs->end_date;
      $s = DB::table('product_varient')
         ->select('stock')
         ->where('varient_id', $product_idd)
         ->first();
        $st = $s->stock;
        $nst = $st-$order_qty;
      }
      $created_at = Carbon::now();
      $updated_at = Carbon::now();
      $current = Carbon::now();
      $current->toDateString();
      $deliv = date('d-m-Y', strtotime($current.' + '.$skip_days.' days'));
      $day = 1;
      $end = date('d-m-Y', strtotime($pause_end_date.' + '.$day.' days'));
      $delivery = date('d-m-Y', strtotime($delivery_date.' + '.$skip_days.' days'));
      //paused
       
      if($status=='paused' && strtotime($pause_start_date) >strtotime($deliv))
      {
          
           $pauseorder= DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                     'delivery_date'=>$deliv,
                    'updated_at'=>$updated_at]);
                    
        if($pauseorder)
           {  
               
            foreach($datasub as $datasubs){
			$s = DB::table('product_varient')
				 ->select('stock')
				 ->where('varient_id', $datasubs->varient_id)
				 ->first();
				$st = $s->stock;
				$nst = $st-$order_qty;
             DB::table('product_varient')
                ->where('varient_id', $datasubs->varient_id)
                   ->update(['stock'=>$nst]);
            }
               
                DB::table('completed_orders')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_incentive'=>$delivery_boy_incentive,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
                        
                $boy_incentive = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->first();
                $total_incentive = $boy_incentive->total_incentive;
                $total_incentive = $delivery_boy_incentive+$total_incentive;
                $remaining_incentive= $boy_incentive->remaining_incentive;
                $total_remaining_incentive=$remaining_incentive+$delivery_boy_incentive;    
               
                $checkwallet = DB::table('tbl_user')
                             ->select('wallet_credits')
                             ->where('user_id', $user_id)
                             ->first();
                $amountt = $checkwallet->wallet_credits;
                $new_amt = $amountt- $price;
            if($amountt >= $price)
            {
                 DB::table('tbl_user')
                 ->where('user_id', $user_id)
                 ->update(['wallet_credits'=>$new_amt]);
            }
            else
            {
                DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                     'delivery_date'=>$delivery,
                     'status'=>'balance_low',
                     'updated_at'=>$updated_at]);
                     
                DB::table('completed_orders')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_incentive'=>$delivery_boy_incentive,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
                        
                 $boy_incentive = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->first();
                  $total_incentive = $boy_incentive->total_incentive;
                  $total_incentive = $delivery_boy_incentive+$total_incentive;
                  $remaining_incentive= $boy_incentive->remaining_incentive;
                  $total_remaining_incentive=$remaining_incentive+$delivery_boy_incentive;       
                     
                $message = array('status'=>'5', 'message'=>'user balance is low', 'data'=>$pauseorder);
        	    return $message;
            }
                         
            
            
             $check_delivery_boy = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->get();  
                   
             if(count($check_delivery_boy)>0)
             {
                  DB::table('incentive')
                  ->where('delivery_boy_id', $delivery_boy_id)
                  ->update(['total_incentive'=> $total_incentive,
                  'remaining_incentive'=> $total_remaining_incentive]);
                  
                  
             }           
            else
            {
                DB::table('incentive')
                  ->insert(['total_incentive'=> $delivery_boy_incentive,
                  'remaining_incentive'=> $delivery_boy_incentive,
                  'delivery_boy_id'=>$delivery_boy_id]);
            
            }            
        	$message = array('status'=>'1', 'message'=>'completed', 'data'=>$pauseorder);
        	return $message;
        }
        else
        {
        	$message = array('status'=>'0', 'message'=>'mark complete', 'data'=>[]);
        	return $message;
        }
      }
      
      //paused
      elseif($status=='paused' && strtotime($pause_start_date) <= strtotime($deliv))
      {
           $pauseorder= DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                     'delivery_date'=>$end,
                    'updated_at'=>$updated_at]);
        
        
        
        if($pauseorder){
            foreach($datasub as $datasubs){
			$s = DB::table('product_varient')
				 ->select('stock')
				 ->where('varient_id', $datasubs->varient_id)
				 ->first();
				$st = $s->stock;
				$nst = $st-$order_qty;
             DB::table('product_varient')
                ->where('varient_id', $datasubs->varient_id)
                   ->update(['stock'=>$nst]);
            }
            DB::table('completed_orders')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_incentive'=>$delivery_boy_incentive,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
                        
             $boy_incentive = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->first();
                  $total_incentive = $boy_incentive->total_incentive;
                  $total_incentive = $delivery_boy_incentive+$total_incentive;
                  $remaining_incentive= $boy_incentive->remaining_incentive;
                  $total_remaining_incentive=$remaining_incentive+$delivery_boy_incentive;    
               
            $checkwallet = DB::table('tbl_user')
                         ->select('wallet_credits')
                         ->where('user_id', $user_id)
                         ->first();
            $amountt = $checkwallet->wallet_credits;
            $new_amt = $amountt- $price;
            if($amountt >= $price){
             DB::table('tbl_user')
             ->where('user_id', $user_id)
             ->update(['wallet_credits'=>$new_amt]);
            }
            else{
                DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                     'delivery_date'=>$delivery,
                     'status'=>'balance_low',
                     'updated_at'=>$updated_at]);
                     
                DB::table('completed_orders')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_incentive'=>$delivery_boy_incentive,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
                        
                 $boy_incentive = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->first();
                  $total_incentive = $boy_incentive->total_incentive;
                  $total_incentive = $delivery_boy_incentive+$total_incentive;
                  $remaining_incentive= $boy_incentive->remaining_incentive;
                  $total_remaining_incentive=$remaining_incentive+$delivery_boy_incentive;       
                     
                $message = array('status'=>'5', 'message'=>'user balance is low', 'data'=>$pauseorder);
        	    return $message;
            }
                         
            
            
             $check_delivery_boy = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->get();  
                   
             if(count($check_delivery_boy)>0){
                  DB::table('incentive')
                  ->where('delivery_boy_id', $delivery_boy_id)
                  ->update(['total_incentive'=> $total_incentive,
                  'remaining_incentive'=> $total_remaining_incentive]);
                  
                  
             }           
            else{
                DB::table('incentive')
                  ->insert(['total_incentive'=> $delivery_boy_incentive,
                  'remaining_incentive'=> $delivery_boy_incentive,
                  'delivery_boy_id'=>$delivery_boy_id]);
            
            }            
        	$message = array('status'=>'1', 'message'=>'completed', 'data'=>$pauseorder);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'mark complete', 'data'=>[]);
        	return $message;
        }
              
      }
      
      
      //paused
       elseif($status=='paused' && strtotime($pause_end_date)<strtotime($current))
       {
           $pauseorder= DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                     'delivery_date'=>$delivery,
                     'status'=>'ongoing',
                     'pause_start'=>n/a,
                     'pause_end'=>n/a,
                    'updated_at'=>$updated_at]);
                    
        if($pauseorder){
            foreach($datasub as $datasubs){
			$s = DB::table('product_varient')
				 ->select('stock')
				 ->where('varient_id', $datasubs->varient_id)
				 ->first();
				$st = $s->stock;
				$nst = $st-$order_qty;
             DB::table('product_varient')
                ->where('varient_id', $datasubs->varient_id)
                   ->update(['stock'=>$nst]);
            }
                   
            DB::table('completed_orders')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_incentive'=>$delivery_boy_incentive,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
                        
             $boy_incentive = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->first();
                  $total_incentive = $boy_incentive->total_incentive;
                  $total_incentive = $delivery_boy_incentive+$total_incentive;
                  $remaining_incentive= $boy_incentive->remaining_incentive;
                  $total_remaining_incentive=$remaining_incentive+$delivery_boy_incentive;    
               
            $checkwallet = DB::table('tbl_user')
                         ->select('wallet_credits')
                         ->where('user_id', $user_id)
                         ->first();
            $amountt = $checkwallet->wallet_credits;
            $new_amt = $amountt- $price;
            if($amountt >= $price){
             DB::table('tbl_user')
             ->where('user_id', $user_id)
             ->update(['wallet_credits'=>$new_amt]);
            }
            else{
                DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                     'delivery_date'=>$delivery,
                     'status'=>'balance_low',
                     'updated_at'=>$updated_at]);
                     
                DB::table('completed_orders')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_incentive'=>$delivery_boy_incentive,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
                        
                 $boy_incentive = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->first();
                  $total_incentive = $boy_incentive->total_incentive;
                  $total_incentive = $delivery_boy_incentive+$total_incentive;
                  $remaining_incentive= $boy_incentive->remaining_incentive;
                  $total_remaining_incentive=$remaining_incentive+$delivery_boy_incentive;       
                     
                $message = array('status'=>'5', 'message'=>'user balance is low', 'data'=>$pauseorder);
        	    return $message;
            }
                         
            
            
             $check_delivery_boy = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->get();  
                   
             if(count($check_delivery_boy)>0){
                  DB::table('incentive')
                  ->where('delivery_boy_id', $delivery_boy_id)
                  ->update(['total_incentive'=> $total_incentive,
                  'remaining_incentive'=> $total_remaining_incentive]);
                  
                  
             }           
            else{
                DB::table('incentive')
                  ->insert(['total_incentive'=> $delivery_boy_incentive,
                  'remaining_incentive'=> $delivery_boy_incentive,
                  'delivery_boy_id'=>$delivery_boy_id]);
            
            }            
        	$message = array('status'=>'1', 'message'=>'completed', 'data'=>$pauseorder);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'mark complete', 'data'=>[]);
        	return $message;
        }
              
      }
      
      
      //ongoing
       elseif($status=='ongoing'){
           $pauseorder= DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                     'delivery_date'=>$delivery,
                    'updated_at'=>$updated_at]);
                    
    if($pauseorder){
           foreach($datasub as $datasubs){
			$s = DB::table('product_varient')
				 ->select('stock')
				 ->where('varient_id', $datasubs->varient_id)
				 ->first();
				$st = $s->stock;
				$nst = $st-$order_qty;
             DB::table('product_varient')
                ->where('varient_id', $datasubs->varient_id)
                   ->update(['stock'=>$nst]);
            }
            DB::table('completed_orders')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_incentive'=>$delivery_boy_incentive,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
                        
             $boy_incentive = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->first();
            if($boy_incentive) {     
                  $total_incentive = $boy_incentive->total_incentive;
                  $total_incentive = $delivery_boy_incentive+$total_incentive;
                  $remaining_incentive= $boy_incentive->remaining_incentive;
                  $total_remaining_incentive=$remaining_incentive+$delivery_boy_incentive; 
            }
               
            $checkwallet = DB::table('tbl_user')
                         ->select('wallet_credits')
                         ->where('user_id', $user_id)
                         ->first();
            $amountt = $checkwallet->wallet_credits;
            $new_amt = $amountt- $price;
            if($amountt >= $price){
             DB::table('tbl_user')
             ->where('user_id', $user_id)
             ->update(['wallet_credits'=>$new_amt]);
            }
            else{
                DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                     'delivery_date'=>$delivery,
                     'status'=>'balance_low',
                     'updated_at'=>$updated_at]);
                     
                DB::table('completed_orders')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_incentive'=>$delivery_boy_incentive,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
                        
                 $boy_incentive = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->first();
                  $total_incentive = $boy_incentive->total_incentive;
                  $total_incentive = $delivery_boy_incentive+$total_incentive;
                  $remaining_incentive= $boy_incentive->remaining_incentive;
                  $total_remaining_incentive=$remaining_incentive+$delivery_boy_incentive;       
                     
                $message = array('status'=>'5', 'message'=>'user balance is low', 'data'=>$pauseorder);
        	    return $message;
            }
                         
            
            
             $check_delivery_boy = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->get();  
                   
             if(count($check_delivery_boy)>0){
                  DB::table('incentive')
                  ->where('delivery_boy_id', $delivery_boy_id)
                  ->update(['total_incentive'=> $total_incentive,
                  'remaining_incentive'=> $total_remaining_incentive]);
                  
                  
             }           
            else{
                DB::table('incentive')
                  ->insert(['total_incentive'=> $delivery_boy_incentive,
                  'remaining_incentive'=> $delivery_boy_incentive,
                  'delivery_boy_id'=>$delivery_boy_id]);
            
            }            
        	$message = array('status'=>'1', 'message'=>'completed', 'data'=>$pauseorder);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'mark complete', 'data'=>[]);
        	return $message;
        }
      
      }
      
      
    //buyonce  
      elseif($status=='buyonce'){
           $pauseorder1= DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                      'status'=>'completed',
                    'updated_at'=>$updated_at]);
            
      if($pauseorder1){
            DB::table('completed_orders')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_incentive'=>$delivery_boy_incentive,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
                        
             $boy_incentive = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->first();
                  $total_incentive = $boy_incentive->total_incentive;
                  $total_incentive = $delivery_boy_incentive+$total_incentive;
                  $remaining_incentive= $boy_incentive->remaining_incentive;
                  $total_remaining_incentive=$remaining_incentive+$delivery_boy_incentive;    
               
             $check_delivery_boy = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->get();  
               
                   
             if(count($check_delivery_boy)>0){
                  DB::table('incentive')
                  ->where('delivery_boy_id', $delivery_boy_id)
                  ->update(['total_incentive'=> $total_incentive,
                  'remaining_incentive'=> $total_remaining_incentive]);
                  
                  
             }           
            else{
                DB::table('incentive')
                  ->insert(['total_incentive'=> $delivery_boy_incentive,
                  'remaining_incentive'=> $delivery_boy_incentive,
                  'delivery_boy_id'=>$delivery_boy_id]);
            
            }            
        	$message = array('status'=>'1', 'message'=>'completed', 'data'=>$pauseorder1);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'mark complete', 'data'=>[]);
        	return $message;
        }        
                    
                    
      }
      
      //free subscription
      elseif($status=='free'){
          
          if(strtotime($end_date) >strtotime($delivery_date)){
             
               $pauseorder= DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                     'delivery_date'=>$delivery,
                    'updated_at'=>$updated_at]);
                    
                    
     if($pauseorder){
          foreach($datasub as $datasubs){
			$s = DB::table('product_varient')
				 ->select('stock')
				 ->where('varient_id', $datasubs->varient_id)
				 ->first();
				$st = $s->stock;
				$nst = $st-$order_qty;
             DB::table('product_varient')
                ->where('varient_id', $datasubs->varient_id)
                   ->update(['stock'=>$nst]);
            }
            DB::table('completed_orders')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_incentive'=>$delivery_boy_incentive,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
                        
             $boy_incentive = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->first();
                  $total_incentive = $boy_incentive->total_incentive;
                  $total_incentive = $delivery_boy_incentive+$total_incentive;
                  $remaining_incentive= $boy_incentive->remaining_incentive;
                  $total_remaining_incentive=$remaining_incentive+$delivery_boy_incentive;    
               
            $checkwallet = DB::table('tbl_user')
                         ->select('wallet_credits')
                         ->where('user_id', $user_id)
                         ->first();
            $amountt = $checkwallet->wallet_credits;
            $new_amt = $amountt- $price;
            if($amountt >= $price){
             DB::table('tbl_user')
             ->where('user_id', $user_id)
             ->update(['wallet_credits'=>$new_amt]);
            }
            else{
                DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                     'delivery_date'=>$delivery,
                     'status'=>'balance_low',
                     'updated_at'=>$updated_at]);
                     
                DB::table('completed_orders')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_incentive'=>$delivery_boy_incentive,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
                        
                 $boy_incentive = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->first();
                  $total_incentive = $boy_incentive->total_incentive;
                  $total_incentive = $delivery_boy_incentive+$total_incentive;
                  $remaining_incentive= $boy_incentive->remaining_incentive;
                  $total_remaining_incentive=$remaining_incentive+$delivery_boy_incentive;       
                     
                $message = array('status'=>'5', 'message'=>'user balance is low', 'data'=>$pauseorder);
        	    return $message;
            }
                         
            
            
             $check_delivery_boy = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->get();  
                   
             if(count($check_delivery_boy)>0){
                  DB::table('incentive')
                  ->where('delivery_boy_id', $delivery_boy_id)
                  ->update(['total_incentive'=> $total_incentive,
                  'remaining_incentive'=> $total_remaining_incentive]);
                  
                  
             }           
            else{
                DB::table('incentive')
                  ->insert(['total_incentive'=> $delivery_boy_incentive,
                  'remaining_incentive'=> $delivery_boy_incentive,
                  'delivery_boy_id'=>$delivery_boy_id]);
            
            }            
        	$message = array('status'=>'1', 'message'=>'completed', 'data'=>$pauseorder);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'mark complete', 'data'=>[]);
        	return $message;
        }
      
          }
          else{
              $pauseorder= DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                      'status'=>'completed',
                    'updated_at'=>$updated_at]);
                    
                    
         if($pauseorder){
            DB::table('completed_orders')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_incentive'=>$delivery_boy_incentive,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
                        
             $boy_incentive = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->first();
                  $total_incentive = $boy_incentive->total_incentive;
                  $total_incentive = $delivery_boy_incentive+$total_incentive;
                  $remaining_incentive= $boy_incentive->remaining_incentive;
                  $total_remaining_incentive=$remaining_incentive+$delivery_boy_incentive;    
               
            $checkwallet = DB::table('tbl_user')
                         ->select('wallet_credits')
                         ->where('user_id', $user_id)
                         ->first();
            $amountt = $checkwallet->wallet_credits;
            $new_amt = $amountt- $price;
            if($amountt >= $price){
             DB::table('tbl_user')
             ->where('user_id', $user_id)
             ->update(['wallet_credits'=>$new_amt]);
            }
            else{
                DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                     'delivery_date'=>$delivery,
                     'status'=>'balance_low',
                     'updated_at'=>$updated_at]);
                     
                DB::table('completed_orders')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_incentive'=>$delivery_boy_incentive,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
                        
                 $boy_incentive = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->first();
                  $total_incentive = $boy_incentive->total_incentive;
                  $total_incentive = $delivery_boy_incentive+$total_incentive;
                  $remaining_incentive= $boy_incentive->remaining_incentive;
                  $total_remaining_incentive=$remaining_incentive+$delivery_boy_incentive;       
                     
                $message = array('status'=>'5', 'message'=>'user balance is low', 'data'=>$pauseorder);
        	    return $message;
            }
                         
            
            
             $check_delivery_boy = DB::table('incentive')
                    ->select('total_incentive','remaining_incentive')
                   ->where('delivery_boy_id', $delivery_boy_id)
                   ->get();  
                   
             if(count($check_delivery_boy)>0){
                  DB::table('incentive')
                  ->where('delivery_boy_id', $delivery_boy_id)
                  ->update(['total_incentive'=> $total_incentive,
                  'remaining_incentive'=> $total_remaining_incentive]);
                  
                  
             }           
            else{
                DB::table('incentive')
                  ->insert(['total_incentive'=> $delivery_boy_incentive,
                  'remaining_incentive'=> $delivery_boy_incentive,
                  'delivery_boy_id'=>$delivery_boy_id]);
            
            }            
        	$message = array('status'=>'1', 'message'=>'completed', 'data'=>$pauseorder);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'mark complete', 'data'=>[]);
        	return $message;
        }
              
                  
          }
          
      }
      else{
           	$message = array('status'=>'0', 'message'=>'mark complete', 'data'=>[]);
        	return $message;
      }
  } 
   
   
   //delivery boy not_accepted
 public function not_accepted(Request $request){
      $cart_id = $request->cart_id;
      $cart_id= $request->cart_id;
      $datasubs = DB::table('tbl_orders')
               ->leftJoin('subscription_plans', 'tbl_orders.plan_id', '=','subscription_plans.plan_id')
              ->where('order_cart_id', $cart_id)
              ->first();
      $user_id = $datasubs->user_id;             
      $price = $datasubs->total_price;
      $status = $datasubs->status;
      $delivery_date = $datasubs->delivery_date;
      $delivery_boy_id = $datasubs->delivery_boy_id;
      $created_at = Carbon::now();
      $updated_at = Carbon::now();
      $current = Carbon::now();
      $current->toDateString();
      $pause_start_date = $datasubs->pause_start;
      $pause_end_date = $datasubs->pause_end;
      $skip_days = $datasubs->skip_days;
      $deliv = date('d-m-Y', strtotime($current.' + '.$skip_days.' days'));
      $day = 1;
      $end = date('d-m-Y', strtotime($pause_end_date.' + '.$day.' days'));
      $end_date = $datasubs->end_date;
      $delivery = date('d-m-Y', strtotime($delivery_date.' + '.$skip_days.' days'));
      //paused
      if($status=='paused' && strtotime($pause_start_date) >strtotime($deliv))
      {
           $pauseorder= DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                     'delivery_date'=>$deliv,
                    'updated_at'=>$updated_at]);
        if($pauseorder)
           {  
                DB::table('not_accepted')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
        	$message = array('status'=>'1', 'message'=>'not accepted', 'data'=>$pauseorder);
        	return $message;
        }
        else
        {
        	$message = array('status'=>'0', 'message'=>'something went wrong', 'data'=>[]);
        	return $message;
        }
      }
      //paused
      elseif($status=='paused' && strtotime($pause_start_date) <= strtotime($deliv))
      {
           $pauseorder= DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                     'delivery_date'=>$end,
                    'updated_at'=>$updated_at]);
         if($pauseorder)
           {  
                DB::table('not_accepted')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
        	$message = array('status'=>'1', 'message'=>'not accepted', 'data'=>$pauseorder);
        	return $message;
        }
        else
        {
        	$message = array('status'=>'0', 'message'=>'something went wrong', 'data'=>[]);
        	return $message;
        }       
      }
      //paused
       elseif($status=='paused' && strtotime($pause_end_date)<strtotime($current))
       {
           $pauseorder= DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                     'delivery_date'=>$delivery,
                     'status'=>'not accepted',
                     'pause_start'=>n/a,
                     'pause_end'=>n/a,
                    'updated_at'=>$updated_at]);
          if($pauseorder)
           {  
                DB::table('not_accepted')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
        	$message = array('status'=>'1', 'message'=>'not accepted', 'data'=>$pauseorder);
        	return $message;
        }
        else
        {
        	$message = array('status'=>'0', 'message'=>'something went wrong', 'data'=>[]);
        	return $message;
        }
      }
      //ongoing
       elseif($status=='ongoing'){
           $pauseorder= DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                     'delivery_date'=>$delivery,
                    'updated_at'=>$updated_at]);
      if($pauseorder)
           {  
                DB::table('not_accepted')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
        	$message = array('status'=>'1', 'message'=>'not accepted', 'data'=>$pauseorder);
        	return $message;
        }
        else
        {
        	$message = array('status'=>'0', 'message'=>'something went wrong', 'data'=>[]);
        	return $message;
        }
      }
    //buyonce  
      elseif($status=='buyonce'){
           $pauseorder1= DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                      'status'=>'not accepted',
                    'updated_at'=>$updated_at]);
        if($pauseorder1)
           {  
                DB::table('not_accepted')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
        	$message = array('status'=>'1', 'message'=>'not accepted', 'data'=>$pauseorder1);
        	return $message;
        }
        else
        {
        	$message = array('status'=>'0', 'message'=>'something went wrong', 'data'=>[]);
        	return $message;
        }
      }
      //free subscription
      elseif($status=='free'){
          
          if(strtotime($end_date) >strtotime($delivery_date)){
             
               $pauseorder= DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                     'delivery_date'=>$delivery,
                    'updated_at'=>$updated_at]);
                    
     if($pauseorder)
           {  
                DB::table('not_accepted')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
        	$message = array('status'=>'1', 'message'=>'not accepted', 'data'=>$pauseorder);
        	return $message;
        }
        else
        {
        	$message = array('status'=>'0', 'message'=>'something went wrong', 'data'=>[]);
        	return $message;
        }
          }
          else{
              $pauseorder= DB::table('tbl_orders')
                  ->where('order_cart_id', $cart_id)
                  ->update([
                      'status'=>'not accepted',
                    'updated_at'=>$updated_at]);
     
          if($pauseorder)
           {  
                DB::table('not_accepted')
                   ->insert(['user_id'=>$user_id,
                        'cart_id'=> $cart_id,
                        'delivery_boy_id'=>$delivery_boy_id,
                        'delivery_date'=> $delivery_date,
                        'created_at'=>$created_at]);
        	$message = array('status'=>'1', 'message'=>'not accepted', 'data'=>$pauseorder);
        	return $message;
        }
        else
        {
        	$message = array('status'=>'0', 'message'=>'something went wrong', 'data'=>[]);
        	return $message;
        }          
          }
      }
      else{
           	$message = array('status'=>'0', 'message'=>'something went wrong', 'data'=>[]);
        	return $message;
      }
      
    

  }
  
  
    public function delieveryboycity(Request $request)
    {
        $delieveryboycity = DB::table('city')->whereIn('city_id', function($query){
                                    $query->select('city_id')
                                        ->from('cityadmin');
                                    })->get();
                                    
        $i=0;
        $result = array();
        
        foreach($delieveryboycity as $delieveryboycitys){
            array_push($result, $delieveryboycitys);
            
            //cityadmin_id
            $cityAdminId = DB::table('cityadmin')->where('city_id', $delieveryboycitys->city_id)->pluck('cityadmin_id')->first();
            $result[$i]->cityadmin_id = $cityAdminId;
            
            // get area according to city
            $getArea = DB::table('area')->where('city_id', $delieveryboycitys->city_id)->get();
            $result[$i]->area = $getArea;
            $i++;
        }
        
        if(count($delieveryboycity)>0){
            $message = array('status'=>'1', 'message'=>'City and area list', 'data'=>$result);
        	return $message;
        }
        else{
            $message = array('status'=>'0', 'message'=>'something went wrong', 'data'=>[]);
        	return $message;
        }                            
    }
    
    public function delieveryboysignup(Request $request)
    {
        $delivery_boy_name = $request->name;
        $delivery_boy_phone = $request->phone;
        $delivery_boy_pass = Hash::make($request->password);
        $lat = $request->lat;
        $lng = $request->lng;
        $device_id = $request->device_id;
        $delivery_boy_status = 'offline';
        $cityadmin_id = $request->cityadmin_id;
        $area_id = $request->area_id;
        
        // check for already registered
        $checkBoy = DB::table('delivery_boy')->where('delivery_boy_phone',$delivery_boy_phone)->get();
        if(count($checkBoy)>0){
            $message = array('status'=>'0', 'message'=>'Phone already registered');
        	return $message;
        }
        
        if($request->delivery_boy_image){
            $user_image = $request->delivery_boy_image;
            $user_image = str_replace('data:image/png;base64,', '', $user_image);
            $fileName = str_replace(" ", "-", $user_image);
            $fileName = date('dmyHis').'user_image'.'.'.'png';
            $fileName = str_replace(" ", "-", $fileName);
            \File::put(public_path(). '/images/user/' . $fileName, base64_decode($user_image));
            $user_image = 'images/user/'.$fileName;
        }
            else{
                $user_image = 'N/A';
            }

        
        $chars = "0123456789";
        $otpval = "";
        for ($i = 0; $i < 4; $i++){
            $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
        }
        
        //insert delivery boy data
        $deliveryboysignup = DB::table('delivery_boy')->insert([
                                    'cityadmin_id'=>$cityadmin_id,
                                    'delivery_boy_name'=>$delivery_boy_name,
                                    'delivery_boy_pass'=>$delivery_boy_pass,
                                    'delivery_boy_phone'=>$delivery_boy_phone,
                                    'delivery_boy_image'=>$user_image,
                                    'lat'=>$lat,
                                    'lng'=>$lng,
                                    'device_id'=>$device_id,
                                    'delivery_boy_status'=>$delivery_boy_status,
                                    'otp'=>$otpval,
                                    'created_at'=>Carbon::now(),
                                ]);
                                
        if($deliveryboysignup){
            //get delivery boy id
            $deliveryboysignupid = DB::table('delivery_boy')
                                        ->where('delivery_boy_phone', $delivery_boy_phone)
                                        ->first();
                                
            $delivery_boy_area = DB::table('delivery_boy_area')->insert([
                                        'delivery_boy_id'=>$deliveryboysignupid->delivery_boy_id,
                                        'area_id'=>$area_id,
                                    ]);
                                    
            //send otp to delivery boy's number
                $sms_api_key=  DB::table('sms_api')
                	              ->select('sms_api_key', 'sender_id')
                                  ->first();
                $api_key = $sms_api_key->sms_api_key;
                $sender_id = $sms_api_key->sender_id;
    
                $getAuthKey = $api_key;
                $getSenderId = $sender_id;
                $getInvitationMsg = "Your OTP is: ".$otpval.".\nNote: Please DO NOT SHARE this OTP with anyone."; 
    
                $authKey = $getAuthKey;
                $mobileNumber = $delivery_boy_phone;
                $senderId = $getSenderId;
                $message = $getInvitationMsg;
                $route = "4";
                $postData = array(
                    'authkey' => $authKey,
                    'mobiles' => $mobileNumber,
                    'message' => $message,
                    'sender' => $senderId,
                    'route' => $route
                );
    
                $url="https://control.msg91.com/api/sendhttp.php";
    
                $ch = curl_init();
                curl_setopt_array($ch, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $postData
                    //,CURLOPT_FOLLOWLOCATION => true
                ));
    
                //Ignore SSL certificate verification
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    
                //get response
                $output = curl_exec($ch);
    
                curl_close($ch);
            
            $message = array('status'=>'1', 'message'=>'verify phone number');
        	return $message;
        }
        else{
            $message = array('status'=>'0', 'message'=>'something went wrong');
        	return $message;
        }
    }
    
    public function delieveryboyphoneverify(Request $request)
    {
        $delivery_boy_phone = $request->phone;
        $otp = $request->otp;
        
        $checkOtp = DB::table('delivery_boy')->where('delivery_boy_phone',$delivery_boy_phone)->first();
        
        if($checkOtp){
            if($otp == $checkOtp->otp && $otp != '' && $otp != NULL){
                // update phone verify status
                $updateVerifyStatus = DB::table('delivery_boy')
                                        ->where('delivery_boy_phone',$delivery_boy_phone)
                                        ->update(['phone_verify'=>1, 'otp'=>NULL]);
                                        
                $message = array('status'=>'1', 'message'=>'Phone Verified now pending for admin acceptance.');
            	return $message;
            }
            else{
                $message = array('status'=>'0', 'message'=>'Wrong otp');
            	return $message;
            }
        }
        else{
            $message = array('status'=>'0', 'message'=>'Not registered');
            return $message;
        }
    }
    
    
    public function dboyforgetpassword(Request $request)
    {
        $delivery_boy_phone = $request->delivery_boy_phone;
        
        //check dboy register or not
        $checkdboy = DB::table('delivery_boy')
    	                ->where('delivery_boy_phone', $delivery_boy_phone)
            			->first();
            			
        if($checkdboy){
            // check for accepted or not
            if($checkdboy->is_confirmed == 1){
                //generate otp
                $chars = "0123456789";
                $otpval = "";
                for ($i = 0; $i < 4; $i++){
                    $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
                }
                
                //send otp to delivery boy's number
                $sms_api_key=  DB::table('sms_api')
                	              ->select('sms_api_key', 'sender_id')
                                  ->first();
                $api_key = $sms_api_key->sms_api_key;
                $sender_id = $sms_api_key->sender_id;
    
                $getAuthKey = $api_key;
                $getSenderId = $sender_id;
                $getInvitationMsg = "Your OTP is: ".$otpval.".\nNote: Please DO NOT SHARE this OTP with anyone."; 
    
                $authKey = $getAuthKey;
                $mobileNumber = $delivery_boy_phone;
                $senderId = $getSenderId;
                $message = $getInvitationMsg;
                $route = "4";
                $postData = array(
                    'authkey' => $authKey,
                    'mobiles' => $mobileNumber,
                    'message' => $message,
                    'sender' => $senderId,
                    'route' => $route
                );
    
                $url="https://control.msg91.com/api/sendhttp.php";
    
                $ch = curl_init();
                curl_setopt_array($ch, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $postData
                    //,CURLOPT_FOLLOWLOCATION => true
                ));
    
                //Ignore SSL certificate verification
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    
                //get response
                $output = curl_exec($ch);
    
                curl_close($ch);
                
                $updateOtpStatus = DB::table('delivery_boy')
                                        ->where('delivery_boy_phone',$delivery_boy_phone)
                                        ->update(['otp'=>$otpval]);
                
                if($updateOtpStatus){
                    $message = array('status'=>'1', 'message'=>'OTP Sent');
                    return $message;
                }
                else{
                    $message = array('status'=>'0', 'message'=>'Something Wrong');
                    return $message;
                }
            }
            else{
                $message = array('status'=>'0', 'message'=>'Pending for Acceptance');
                return $message;
            }
        }
        else{
            $message = array('status'=>'0', 'message'=>'Not registered');
            return $message;
        }
    }
      
    public function dboyverifyotp(Request $request)
    {
        $delivery_boy_phone = $request->delivery_boy_phone;
        $otp = $request->otp;
        
        //check dboy register or not
        $checkdboy = DB::table('delivery_boy')
    	                ->where('delivery_boy_phone', $delivery_boy_phone)
            			->first();
            			
        if($checkdboy){
            if($otp == $checkdboy->otp && $otp != '' && $otp != NULL){
                $updateOtpStatus = DB::table('delivery_boy')
                                        ->where('delivery_boy_phone',$delivery_boy_phone)
                                        ->update(['otp'=>NULL]);
                                        
                $message = array('status'=>'1', 'message'=>'OTP Verified');
                return $message;
            }
            else{
                $message = array('status'=>'0', 'message'=>'Wrong OTP');
                return $message;
            }
        }
        else{
            $message = array('status'=>'0', 'message'=>'Not registered');
            return $message;
        }
    }
    
    public function dboychangepassword(Request $request)
    {
        $delivery_boy_phone = $request->delivery_boy_phone;
        $delivery_boy_pass = Hash::make($request->delivery_boy_pass);
        
        //check dboy register or not
        $checkdboy = DB::table('delivery_boy')
    	                ->where('delivery_boy_phone', $delivery_boy_phone)
            			->first();
            			
        if($checkdboy){
            $updatePassword = DB::table('delivery_boy')
                                    ->where('delivery_boy_phone',$delivery_boy_phone)
                                    ->update(['delivery_boy_pass'=>$delivery_boy_pass]);
                                        
            if($updatePassword){
                $message = array('status'=>'1', 'message'=>'Password Changed');
                return $message;
            }
            else{
                $message = array('status'=>'0', 'message'=>'Something Wrong');
                return $message;
            }
        }
        else{
            $message = array('status'=>'0', 'message'=>'Not registered');
            return $message;
        }
    }
}