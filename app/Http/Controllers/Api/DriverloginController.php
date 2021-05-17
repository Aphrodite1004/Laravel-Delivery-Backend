<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Hash;
use App\Traits\SendSms;

class DriverloginController extends Controller
{
     use SendSms;
     
     
       public function delieveryboyphoneverify(Request $request)
    {
        
        $this->validate(
            $request, 
            [
                'phone' => 'required',
            ],
            [
                'phone.required' => 'Enter Mobile...',
            ]
        );
    
    	$phone = $request->phone;
   
        $created_at = Carbon::now();
        $updated_at = Carbon::now();
      
    	$checkUser = DB::table('delivery_boy')
    					->where('delivery_boy_phone', $phone)
    					->first();
        $smsby = DB::table('smsby')
              ->first();
        if($smsby->status==1){      
        // check for otp verify
    	if($checkUser && $checkUser->phone_verify==1){
    		$message = array('status'=>'1', 'message'=>'You Already register', 'data'=>[]);
            return $message;
    	}
    	
    ///////if phone not verified/////	
    	
	elseif($checkUser && $checkUser->phone_verify==0){

    						
    						
    			$chars = "0123456789";
                $otpval = "";
                for ($i = 0; $i < 4; $i++){
                    $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
                }
                
                
                $otpmsg = $this->otpmsg($otpval,$phone);
                
                $updateOtp = DB::table('delivery_boy')
                                ->where('delivery_boy_phone', $phone)
                                ->update(['otp'=>$otpval,
                                          'phone_verify'=>1]);
    						
	    		$message = array('status'=>'1', 'message'=>'OTP Sent');
	        	return $message;
	    	}
	    	else{
	    		$message = array('status'=>'0', 'message'=>'Something went wrong');
	        return $message;
	    	}  
    	}
    	
    }

    public function driver_login(Request $request)
     {
        $phone = $request->phone;
        $otp = $request->otp;
        $device_id = $request->device_id;
        $smsby = DB::table('smsby')
              ->first();
        if($smsby->status==1){      
        // check for otp verify
        $getUser = DB::table('delivery_boy')
                    ->where('delivery_boy_phone', $phone)
                    ->first();
                    
        if($getUser){
            $getotp = $getUser->otp;
            
            if($otp == $getotp){
                // verify phone
                $getUser = DB::table('delivery_boy')
                            ->where('delivery_boy_phone', $phone)
                            ->update(['phone_verify'=>1,
                                       'phone_verify'=>0,
                                      'device_id'=>$device_id,
                            'otp'=>NULL]);
                            
                $delivery_boy = DB::table('delivery_boy')
                                    ->where('delivery_boy_phone', $phone)
                                    ->first();
                    
                $message = array('status'=>1, 'message'=>"Phone Verified! login successfully",'data'=>$delivery_boy);
                return $message;
            }
            else{
                $message = array('status'=>0, 'message'=>"Wrong OTP");
                return $message;
            }
       
        }
        else{
            $message = array('status'=>0, 'message'=>"User not registered");
            return $message;
        }
        }
        else{
              $getUser = DB::table('delivery_boy')
                            ->where('delivery_boy_phone', $phone)
                            ->update(['phone_verify'=>1,
                                       'phone_verify'=>0,
                                      'device_id'=>$device_id,
                            'otp'=>NULL]);
             $message = array('status'=>1, 'message'=>"Phone Verified! login successfully");
            return $message;
        }
    }

    public function driverprofile(Request $request)
    {   
        $boy_id = $request->delivery_boy_id;
         $diver=  DB::table('delivery_boy')
                ->where('delivery_boy_id', $boy_id )
                ->first();
                        
    if($diver){
        	$message = array('status'=>'1', 'message'=>'Delivery Boy Profile', 'data'=>$diver);
	        return $message;
              }
    	else{
    		$message = array('status'=>'0', 'message'=>'Delivery Boy not found', 'data'=>[]);
	        return $message;
    	}
        
    }
 
        public function driverstatus(Request $request)
    {   
        $boy_id = $request->delivery_boy_id;
         $diver=  DB::table('delivery_boy')
                ->where('delivery_boy_id', $boy_id )
                ->select('delivery_boy_status')
                ->first();
                        
    if($diver){
        	$message = array('status'=>'1', 'message'=>'Status', 'data'=>$diver);
	        return $message;
              }
    	else{
    		$message = array('status'=>'0', 'message'=>'Something went wrong', 'data'=>[]);
	        return $message;
    	}
        
    }
    
             public function verifyotpfirebase_driver(Request $request)
    {
        $phone = $request->delivery_boy_phone;
        $status = $request->status;
        
        $smsby = DB::table('smsby')
              ->first();
    
        // check for otp verify
        $getUser = DB::table('delivery_boy')
                    ->where('delivery_boy_phone', $phone)
                    ->first();
                    
        if($getUser){
            
            if($status == "success"){
                // verify phone
                $getUser = DB::table('delivery_boy')
                             ->where('delivery_boy_phone', $phone)
                            ->update(['phone_verify'=>1,
                            'otp'=>NULL]);
                            
                $currency =DB::table('currency')
                                ->where('currency_id', 1)
                                    ->first();  
                $user = DB::table('delivery_boy')
                    ->where('delivery_boy_phone', $phone)
                    ->first();                    
                    
                $message = array('status'=>1, 'message'=>"Phone Verified! login successfully",'data'=>$user,'Currency'=>$currency);
                return $message;
            }
            else{
                $message = array('status'=>0, 'message'=>"Wrong OTP");
                return $message;
            }
       
        }
        else{
            $message = array('status'=>0, 'message'=>"User not registered");
            return $message;
        }
        
    }
    
     public function resend_otp_driver(Request $request)
    {
        $user_phone = $request->delivery_boy_phone;
        
        $checkUser = DB::table('delivery_boy')
                    ->where('delivery_boy_phone', $user_phone)
                    ->first();
                        
        if($checkUser){
                $chars = "0123456789";
                 $otpval = "";
            for ($i = 0; $i < 4; $i++){
                $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
            } 
                
                $otpmsg = $this->otpmsg($otpval,$user_phone);
    
                $updateOtp = DB::table('delivery_boy')
                                ->where('delivery_boy_phone', $user_phone)
                                ->update(['otp'=>$otpval]);
                                
            if($updateOtp){
              $checkUser1 = DB::table('delivery_boy')
                        ->where('delivery_boy_phone', $user_phone)
                        ->first();
    		                        
    			$message = array('status'=>'1', 'message'=>'Verify OTP', 'data'=>[$checkUser1]);
	        	return $message; 
            }
            else{
                $message = array('status'=>'0', 'message'=>'Something wrong', 'data'=>[]);
	        	return $message; 
            }
        }                
        else{
            $message = array('status'=>'0', 'message'=>'User not registered', 'data'=>[]);
	        return $message;
        }
        
    }
   

}