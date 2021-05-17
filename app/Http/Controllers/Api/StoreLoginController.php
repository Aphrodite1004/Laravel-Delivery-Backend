<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth; 
use App\Traits\SendSms;


class StoreLoginController extends Controller
{
    use SendSms;

    public function storeverifyphone(Request $request)
    {
        $phone = $request->store_phone;

    	$checkUser = DB::table('vendor')
    					->where('vendor_phone', $phone)
    					->first();
        $smsby = DB::table('smsby')
              ->first();
        if($smsby->status==1){      
        // check for otp verify
    	if($checkUser && $checkUser->phone_verified==1){
    		$message = array('status'=>'1', 'message'=>'You Already register', 'data'=>[]);
            return $message;
        }
          ///////if phone not verified/////	
    	
	elseif($checkUser && $checkUser->phone_verified==0){            
             $chars = "0123456789";
             $otpval = "";
             for ($i = 0; $i < 4; $i++){
                    $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
             }
             
             $otpmsg = $this->otpmsg($otpval,$phone);
             
             $updateOtp = DB::table('vendor')
                             ->where('vendor_phone', $phone)
                             ->update(['otp'=>$otpval,
                                       'phone_verified'=>1]);
                         
             $message = array('status'=>'1', 'message'=>'OTP Sent','data'=>$otpval);
             return $message;
         }
         else{
             $message = array('status'=>'0', 'message'=>'Something went wrong');
         return $message;
         }  
     }


       
    }
    
    public function storelogin(Request $request)
    
    {

        $phone = $request->store_phone;
        $otp = $request->otp;
        $device_id = $request->device_id;
        $smsby = DB::table('smsby')
              ->first();
        if($smsby->status==1){      
        // check for otp verify
        $getUser = DB::table('vendor')
        ->where('vendor_phone', $phone)
        ->first();


        if($getUser){
            $getotp = $getUser->otp;
            
            if($otp == $getotp){
                // verify phone
                $getUser = DB::table('vendor')
                            ->where('vendor_phone', $phone)
                            ->update(['phone_verified'=>1,
                                       'phone_verified'=>0,
                                      'device_id'=>$device_id,
                            'otp'=>NULL]);
                            
                $vendor = DB::table('vendor')
                                    ->where('vendor_phone', $phone)
                                    ->first();
                    
               $currency =DB::table('currency')
                                ->where('currency_id', 1)
                                    ->first();
                    
                $message = array('status'=>1, 'message'=>"Phone Verified! login successfully",'data'=>$vendor,'currency'=>$currency);
                return $message;
            }
            else{
                $message = array('status'=>0, 'message'=>"Wrong OTP");
                return $message;
            }
       
        }
        else{
            $message = array('status'=>0, 'message'=>"Store not registered");
            return $message;
        }
        }
        else{
              $getUser = DB::table('vendor')
                            ->where('vendor_phone', $phone)
                            ->update(['phone_verified'=>1,
                                       'phone_verified'=>0,
                                      'device_id'=>$device_id,
                            'otp'=>NULL]);
             $message = array('status'=>1, 'message'=>"Phone Verified! login successfully");
            return $message;
        }
  
   }

    public function storeprofile(Request $request)
    {
        $vendor_id = $request->vendor_id;

    	$profile = DB::table('vendor')
    	                   ->where('vendor_id',$vendor_id)
    	                   ->get();

        if(count($profile)>0){
                                    
                 $message = array('status'=>'1', 'message'=>'profile successfully', 'data'=>[$profile]);
                 return $message;
     
         }
         else{
             $message = array('status'=>'0', 'message'=>'you are not registered');
             return $message;
         }


    }
        public function storeprofile_edit(Request $request)
    {
        $vendor_id = $request->store_id;
        
        $updated_at = date("d-m-y h:i a");
        $date=date('d-m-y');
 
            $vendor_image = $request->vendor_image;
            $fileName = date('dmyhisa').'-'.$vendor_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $vendor_image->move('vendor_img/images/'.$date.'/', $fileName);
            $vendor_image = 'vendor_img/images/'.$date.'/'.$fileName;

        

        $update = DB::table('vendor')
                 ->where('vendor_id', $vendor_id)
                 ->update([
                            'vendor_logo'=>$vendor_image,
                            ]);

                if($update){
                    
                    $detail = DB::table('vendor')
                                ->where('vendor_id',$vendor_id)
                                ->select('vendor_logo')
                                ->first();
                                            
                        $message = array('status'=>'1', 'message'=>'profile update successfully', 'data'=>$detail);
                        return $message;
            
                }
                else{
                    $message = array('status'=>'0', 'message'=>'profile not update ');
                    return $message;
                }
            

        }
        
     public function store_status(Request $request)
    {
        $vendor_id = $request->vendor_id;
        $status = $request->status;

    	$profile = DB::table('vendor')
    	                   ->where('vendor_id',$vendor_id)
    	                   ->update([
    	                             'online_status'=>$status, 
    	                              ]);

        if(($profile)){
                                    
                 $message = array('status'=>'1', 'message'=>'Successfully Store','Status'=>$status);
                 return $message;
     
         }
         else{
             $message = array('status'=>'0', 'message'=>'Something Went Wrong');
             return $message;
         }


    }  
    
     public function store_current_status(Request $request)
    {
        $vendor_id = $request->vendor_id;

    	$profile = DB::table('vendor')
    	                   ->where('vendor_id',$vendor_id)
    	                   ->select('online_status')
    	                   ->first();
             

        if($profile){
                                    
                 $message = array('status'=>'1', 'message'=>'Store Status', 'data'=>[$profile]);
                 return $message;
     
         }
         else{
             $message = array('status'=>'0', 'message'=>'Oops Something Went Wrong ');
             return $message;
         }


    }
    
     public function store_timming(Request $request)
    {
        $vendor_id = $request->vendor_id;
        $opening_time = $request->opening_time;
        $closing_time = $request->closing_time;

    	$profile = DB::table('vendor')
    	                   ->where('vendor_id',$vendor_id)
    	                   ->update([
    	                                'opening_time'=>$opening_time,
    	                                'closing_time'=>$closing_time
    	                            ]);
             

        if($profile){
                                    
                 $message = array('status'=>'1', 'message'=>'Timing Updated', 'data'=>[$profile]);
                 return $message;
     
         }
         else{
             $message = array('status'=>'0', 'message'=>'Oops Something Went Wrong ');
             return $message;
         }


    }
    
           public function verifyotpfirebase_vendor(Request $request)
    {
        $phone = $request->store_phone;
        $status = $request->status;
        
        $smsby = DB::table('smsby')
              ->first();
    
        // check for otp verify
        $getUser = DB::table('vendor')
                    ->where('vendor_phone', $phone)
                    ->first();
                    
        if($getUser){
            
            if($status == "success"){
                // verify phone
                $getUser = DB::table('vendor')
                            ->where('vendor_phone', $phone)
                            ->update(['phone_verified'=>1,
                            'otp'=>NULL]);
                            
                $currency =DB::table('currency')
                                ->where('currency_id', 1)
                                    ->first();  
                $user = DB::table('vendor')
                    ->where('vendor_phone', $phone)
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
    
     public function resend_otp_vendor(Request $request)
    {
        $user_phone = $request->store_phone;
        
        $checkUser = DB::table('vendor')
                        ->where('user_phone', $user_phone)
                        ->first();
                        
        if($checkUser){
                $chars = "0123456789";
                 $otpval = "";
            for ($i = 0; $i < 4; $i++){
                $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
            } 
                
                $otpmsg = $this->otpmsg($otpval,$user_phone);
    
                $updateOtp = DB::table('vendor')
                                ->where('vendor_phone', $user_phone)
                                ->update(['otp'=>$otpval]);
                                
            if($updateOtp){
              $checkUser1 = DB::table('vendor')
                        ->where('user_phone', $user_phone)
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
