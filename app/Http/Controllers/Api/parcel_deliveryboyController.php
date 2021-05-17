<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Hash;


class parcel_deliveryboyController extends Controller
{
    
    public function parcel_dboylogin(Request $request)
    {
    	$delivery_boy_phone = $request->delivery_boy_phone;
    	$device_id = $request->device_id;
    	
    	// check for mobile verify or not
    	$mobilecheckdeliveryboy = DB::table('parcel_delivery_boy')
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
                
                $updateOtpStatus = DB::table('parcel_delivery_boy')
                                        ->where('delivery_boy_phone',$delivery_boy_phone)
                                        ->update(['otp'=>$otpval]);
            
            $message = array('status'=>'4', 'message'=>'Pending for mobile verification');
	        return $message;
        }
    	
    	// check for confirmation
    	$checkdeliveryboy = DB::table('parcel_delivery_boy')
    	                        ->where('delivery_boy_phone', $delivery_boy_phone)
    	                        ->where('is_confirmed', '0')
            					->first();
            					
        if($checkdeliveryboy){
            $message = array('status'=>'2', 'message'=>'Pending for Admin Acceptance');
	        return $message;
        }
        
                
    	$checkUser = DB::table('parcel_delivery_boy')
    					->where('delivery_boy_phone', $delivery_boy_phone)
    					->first();
    				
         				

    	if($checkUser){
    	   if(Hash::check($delivery_boy_pass,$checkUser->delivery_boy_pass)){
    		    $updateDeviceId = DB::table('parcel_delivery_boy')
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
    
    
    
  
    

}