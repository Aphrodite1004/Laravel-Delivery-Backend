<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class RefralController extends Controller
{
     public function signUprefer(Request $request)
    {
        
        $this->validate(
            $request, 
            [
                'user_name' => 'required',
                'user_email' => 'required|email',
                'user_phone' => 'required',
                'user_password' => 'required'
            ],
            [
                'user_name.required' => 'Enter Name...',
                'user_email.required' => 'Enter email...',
                'user_phone.required' => 'Enter Mobile...',
                'user_password.required' => 'Enter password...',
            ]
        );
    	$user_name = $request->user_name;
    	$user_email = $request->user_email;
    	$user_phone = $request->user_phone;
    	$user_image = $request->user_image;
    	$user_password = $request->user_password;
    	$referral_code = $request->referral_code;
    	$device_id = $request->device_id;
        $created_at = Carbon::now();
        $updated_at = Carbon::now();
        $startingg = strtoupper(substr($user_name, 0, 3));
         $chars ="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                    $referral_code1 = "";
                    for ($i = 0; $i < 5; $i++){
                       $referral_code1 .= $chars[mt_rand(0, strlen($chars)-1)];
                    }
        if($request->referral_code){
            $getReferredUser = DB::table('tbl_user')
                                ->where('referral_code', $referral_code)
                                ->get();

            if(count($getReferredUser) == 0){
                $message = array('status'=>'0', 'message'=>'wrong referral code', 'data'=>[]);
                return $message;
            }
        }
        
    	$checkUser = DB::table('tbl_user')
    					->where('user_phone', $user_phone)
    					->first();

    	if($checkUser){
    	    if($checkUser->phone_verified==NULL){
    	        if($request->user_image){
            $user_image = $request->user_image;
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
        
    		$insertUser = DB::table('tbl_user')
    		               ->where('user_phone',$user_phone)
    						->update([
    							'user_name'=>$user_name,
    							'user_email'=>$user_email,
    							'user_image'=>$user_image,
    							'user_password'=>$user_password,
    							'referral_code'=>$startingg.$referral_code1,
    							'device_id'=>$device_id,
    							'created_at'=>$created_at,
    							'updated_at'=>$updated_at,
    						]);
            	$Userdetails = DB::table('tbl_user')
    					->where('user_phone', $user_phone)
    					->first();
    		if($insertUser){
    		     DB::table('notificationby')
    						->insert(['user_id'=> $insertUser,
    						'sms'=> '1',
    						'app'=> '1',
    						'email'=> '0']);
    						
    						
    			$chars = "0123456789";
                $otpval = "0000";
                // for ($i = 0; $i < 4; $i++){
                //     $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
                // }
                
                $sms_api_key=  DB::table('sms_api')
                	              ->select('sms_api_key', 'sender_id')
                                  ->first();
                $api_key = $sms_api_key->sms_api_key;
                $sender_id = $sms_api_key->sender_id;
    
                $getAuthKey = $api_key;
                $getSenderId = $sender_id;
                $getInvitationMsg = "Your OTP is: ".$otpval.".\nNote: Please DO NOT SHARE this OTP with anyone."; 
    
                $authKey = $getAuthKey;
                $mobileNumber = $user_phone;
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
    
                $updateOtp = DB::table('tbl_user')
                                ->where('user_phone', $user_phone)
                                ->update(['otp'=>$otpval]);
    						
	    		$message = array('status'=>'1', 'message'=>'login successfully', 'data'=>$Userdetails);
	        	return $message;
	    	}
	    	else{
	    		$message = array('status'=>'0', 'message'=>'Password is wrong');
	        return $message;
	    	}
    	        
    	    }else{
    		$message = array('status'=>'0', 'message'=>'user already registered', 'data'=>[]);
            return $message;
    	    }
    	}
    	else{
       if($request->user_image){
            $user_image = $request->user_image;
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
        
    		$insertUser = DB::table('tbl_user')
    						->insertGetId([
    							'user_name'=>$user_name,
    							'user_email'=>$user_email,
    							'user_phone'=>$user_phone,
    							'user_image'=>$user_image,
    							'user_password'=>$user_password,
    							'device_id'=>$device_id,
    							'referral_code'=>$startingg.$referral_code1,
    							'created_at'=>$created_at,
    							'updated_at'=>$updated_at,
    						]);
            	$Userdetails = DB::table('tbl_user')
    					->where('user_phone', $user_phone)
    					->first();
    					$amount = $Userdetails->wallet_credits; 
    		if($insertUser){
    		     DB::table('notificationby')
    						->insert(['user_id'=> $insertUser,
    						'sms'=> '1',
    						'app'=> '1',
    						'email'=> '0']);
    						
    						
    			$chars = "0123456789";
                $otpval = "0000";
                // for ($i = 0; $i < 4; $i++){
                //     $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
                // }
                
                $sms_api_key=  DB::table('sms_api')
                	              ->select('sms_api_key', 'sender_id')
                                  ->first();
                $api_key = $sms_api_key->sms_api_key;
                $sender_id = $sms_api_key->sender_id;
    
                $getAuthKey = $api_key;
                $getSenderId = $sender_id;
                $getInvitationMsg = "Your OTP is: ".$otpval.".\nNote: Please DO NOT SHARE this OTP with anyone."; 
    
                $authKey = $getAuthKey;
                $mobileNumber = $user_phone;
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
    
                $updateOtp = DB::table('tbl_user')
                                ->where('user_phone', $user_phone)
                                ->update(['otp'=>$otpval]);
                                
                                
                if($insertUser > 0){

                if($request->referral_code){
                    $getReferredUser = DB::table('tbl_user')
                                        ->where('referral_code', $referral_code)
                                        ->first();

                    if($getReferredUser){
                        $insertReferral = DB::table('tbl_referral')
                                            ->insert([
                                                'user_id'=>$insertUser,
                                                'referral_by'=>$getReferredUser->user_id,
                                                'created_at'=>$created_at,
                                            ]);
                                            
                                            
                    
                    
                    
                    
                     // assign scratch card on referral to new user and old user
            $getScratchCard = DB::table('tbl_scratch_card')
                                ->where('id', '9')
                                ->first();

            $limit = $getScratchCard->limit;
            $earning1 = rand($getScratchCard->min, $getScratchCard->max);
            $earningBonus1 = rand($getScratchCard->min, $getScratchCard->max);

            $earn = "You've won ₹ ".$earning1; // for new user
            $earnBonus = "You've won ₹ ".$earningBonus1; // for old user
            
            $new_amount = $amount+$earningBonus1;

            $created_at = Carbon::now();

          
               $getReferredUser = DB::table('tbl_user')
                                ->where('referral_code', $referral_code)
                                ->first();
                
                

                if($getReferredUser){

                    $countReferral = DB::table('tbl_referral')
                                        ->where('referral_by', $getReferredUser->user_id)
                                        ->get();

                    if(count($countReferral) <= $limit){
                        // for old user
                        $insertScratchCard = DB::table('tbl_user_scratch_card')
                                            ->insert([
                                                'user_id'=>$getReferredUser->user_id,
                                                'scratch_id'=>'9',
                                                'scratch_type'=>'reward',
                                                'scratch_for'=>'referral reward',
                                                'earning'=>$earn,
                                                'created_at'=>$created_at,
                                            ]);
                                            
                            $update = DB::table('tbl_user')
                                    ->where('referral_code', $referral_code)
                                    ->update([
                                              'wallet_credits'=>$new_amount,
                                             ]);

                        // for new user
                        $insertReferralBonus = DB::table('tbl_user_scratch_card')
                                            ->insert([
                                                'user_id'=>$insertUser,
                                                'scratch_id'=>'9',
                                                'scratch_type'=>'reward',
                                                'scratch_for'=>'referral reward',
                                                'earning'=>$earnBonus,
                                                'created_at'=>$created_at,
                                            ]);
                        $update1= DB::table('tbl_user')
                                    ->where('user_id', $insertUser)
                                    ->update([
                                              'wallet_credits'=>$earning1,
                                             ]);             
                    }
                }
                                            
                    }
                    else{
                        $message = array('status'=>'0', 'message'=>'wrong referral code', 'data'=>[]);
                        return $message;
                    }
                }
                
              

                $user = DB::table('tbl_user')
                        ->where('user_phone', $user_phone)
                        ->first();                
                                
    						
	    		$message = array('status'=>'1', 'message'=>'login successfully', 'data'=>$user);
	        	return $message;
	    	}
	    	else{
	    		$message = array('status'=>'0', 'message'=>'Password is wrong');
	        return $message;
	    	}
    	}
    }
}
    
    
    public function verifyPhone(Request $request)
    {
        $phone = $request->phone;
        $otp = $request->otp;
        
        // check for otp verify
        $getUser = DB::table('tbl_user')
                    ->where('user_phone', $phone)
                    ->first();
                    
        if($getUser){
            $getotp = $getUser->otp;
            
            if($otp == $getotp){
                // verify phone
                $getUser1 = DB::table('tbl_user')
                            ->where('user_phone', $phone)
                            ->update(['phone_verified'=>1]);
                    
                $message = array('status'=>1, 'message'=>"Phone Verified", "data"=>$getUser);
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


    public function login(Request $request)
    
     {
    	$user_phone = $request->user_phone;
    	$user_password = $request->user_password;
    	$device_id = $request->device_id;
    	
    	$checkUserReg = DB::table('tbl_user')
    					->where('user_phone', $user_phone)
    					->get();
    					
    	if(count($checkUserReg) == 0){
    	    $message = array('status'=>'0', 'message'=>'Phone not registered', 'data'=>[]);
	        return $message;
    	}
                
    	$checkUser = DB::table('tbl_user')
    					->where('user_phone', $user_phone)
    					->where('user_password', $user_password)
    					->first();

    	if($checkUser){
    	    
    	    if($checkUser->phone_verified == 0){
    	        $chars = "0123456789";
                $otpval = "";
                for ($i = 0; $i < 4; $i++){
                    $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
                }
                
                $sms_api_key=  DB::table('sms_api')
                	              ->select('sms_api_key', 'sender_id')
                                  ->first();
                $api_key = $sms_api_key->sms_api_key;
                $sender_id = $sms_api_key->sender_id;
    
                $getAuthKey = $api_key;
                $getSenderId = $sender_id;
                $getInvitationMsg = "Your OTP is: ".$otpval.".\nNote: Please DO NOT SHARE this OTP with anyone."; 
    
                $authKey = $getAuthKey;
                $mobileNumber = $user_phone;
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
    
                $updateOtp = DB::table('tbl_user')
                                ->where('user_phone', $user_phone)
                                ->update(['otp'=>$otpval]);
                                
                $checkUser1 = DB::table('tbl_user')
            					->where('user_phone', $user_phone)
            					->first();                
                                
    	        $message = array('status'=>'2', 'message'=>'Verify Phone', 'data'=>[$checkUser1]);
	        	return $message;
    	    }
    	   
    		   $updateDeviceId = DB::table('tbl_user')
    		                        ->where('user_phone', $user_phone)
    		                        ->update(['device_id'=>$device_id]);
    		                       
    		   $checkUser1 = DB::table('tbl_user')
            					->where('user_phone', $user_phone)
            					->where('user_password', $user_password)
            					->first();
    		                        
    			$message = array('status'=>'1', 'message'=>'login successfully', 'data'=>[$checkUser1]);
	        	return $message;
    		   
    	
    	}
    	else{
    		$message = array('status'=>'0', 'message'=>'Wrong Password', 'data'=>[]);
	        return $message;
    	}
    }
    
    
    
    
    public function myprofile(Request $request)
    {   
        $user_id = $request->user_id;
         $user =  DB::table('tbl_user')
                ->leftjoin('user_address','tbl_user.user_id', '=', 'user_address.user_id')
                ->where('tbl_user.user_id', $user_id )
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
    
    public function forgotPassword(Request $request)
    {
        $user_phone = $request->user_phone;
        
        $checkUser = DB::table('tbl_user')
                        ->where('user_phone', $user_phone)
                        ->first();
                        
        if($checkUser){
                $chars = "0123456789";
                $otpval = "";
                for ($i = 0; $i < 4; $i++){
                    $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
                }
                
                $sms_api_key=  DB::table('sms_api')
                	              ->select('sms_api_key', 'sender_id')
                                  ->first();
                $api_key = $sms_api_key->sms_api_key;
                $sender_id = $sms_api_key->sender_id;
    
                $getAuthKey = $api_key;
                $getSenderId = $sender_id;
                $getInvitationMsg = "Your OTP is: ".$otpval.".\nNote: Please DO NOT SHARE this OTP with anyone."; 
    
                $authKey = $getAuthKey;
                $mobileNumber = $user_phone;
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
    
                $updateOtp = DB::table('tbl_user')
                                ->where('user_phone', $user_phone)
                                ->update(['otp'=>$otpval]);
                                
            if($updateOtp){
              $checkUser1 = DB::table('tbl_user')
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
    
    public function verifyOtp(Request $request)
    {
        $phone = $request->user_phone;
        $otp = $request->otp;
        
        // check for otp verify
        $getUser = DB::table('tbl_user')
                    ->where('user_phone', $phone)
                    ->first();
                    
        if($getUser){
            $getotp = $getUser->otp;
            
            if($otp == $getotp){
                $message = array('status'=>1, 'message'=>"Success");
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
    
    public function changePassword(Request $request)
    {
        $user_phone = $request->user_phone;
        $password = $request->user_password;
        
        $getUser = DB::table('tbl_user')
                    ->where('user_phone', $user_phone)
                    ->first();
                    
        if($getUser){
            $updateOtp = DB::table('tbl_user')
                            ->where('user_phone', $user_phone)
                            ->update(['user_password'=>$password]);
                                
            if($updateOtp){
              $checkUser1 = DB::table('tbl_user')
            					->where('user_phone', $user_phone)
            					->first();
    		                        
    			$message = array('status'=>'1', 'message'=>'Password changed', 'data'=>[$checkUser1]);
	        	return $message; 
            }
            else{
                $message = array('status'=>'0', 'message'=>'Something wrong', 'data'=>[]);
	        	return $message; 
            }
        }
        else{
            $message = array('status'=>0, 'message'=>"User not registered");
            return $message;
        }
    }
    
    public function checkMember(Request $request)
    {
        $user_id = $request->user_id;
        $date = date('Y-m-d H:i:s');
        
        $checkMember = DB::table('member')
                         ->where('user_id', $user_id)
                         ->whereDate('end_date', '>=', $date)
                         ->orderBy('member_id', 'DESC')
                         ->first();
                         
        if($checkMember){
            $message = array('status'=>1, 'message'=>"Membership running");
            return $message;
        }
        else{
            $message = array('status'=>0, 'message'=>"No Membership");
            return $message;
        }
    }
    public function checkuser(Request $request)
    {
        $user_phone = $request->user_phone;
     
        
        $checkuser = DB::table('tbl_user')
                         ->where('user_phone', $user_phone)
                         ->first();
                         
        if($checkuser){
            $message = array('status'=>1, 'message'=>"User Already register", 'data'=>$checkuser);
            return $message;
        }
        else{
            $message = array('status'=>0, 'message'=>"Please go to Signup Page ");
            return $message;
        }
    }
}
