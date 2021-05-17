<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\carbon;
use App\Traits\SendMail;
use App\Traits\SendSms;

class walletController extends Controller
{
     use SendMail;
 use SendSms;
  
     public function showcredit(Request $request)
    { 
        $user_id = $request->user_id;
        $wallet_amt = DB::table('tbl_user')
                    ->select('wallet_credits')
                    ->where('user_id', $user_id)
                    ->get();
                   
                    
                    
       if($wallet_amt){
        	$message = array('status'=>'1', 'message'=>'current Wallet Amount ', 'data'=>$wallet_amt);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }             
        
    }

    
    
      public function credit_history(Request $request)
    { 
        $user_id = $request->user_id;
        $show =  DB::table('wallet_history')
              ->where('user_id',$user_id)
              ->orderBy('created_at', 'DESC' )
              ->limit(7)
              ->get();
        
        if($show){
        	$message = array('status'=>'1', 'message'=>'Wallet History','data'=>$show);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'something went wrong', 'data'=>[]);
        	return $message;
        }               
    }


    public function reffermessage(Request $request)
    { 
        $earn = DB::table('tbl_scratch_card')
                    ->select('reffer_message','app_link')
                    ->get();
                   
                    
                    
       if($earn){
        	$message = array('status'=>'1', 'data'=>$earn);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }             
        
    }
    
         public function wallet_plans(Request $request)
    { 
        $wallet_amt = DB::table('wallets_plans')
                    ->get();
                    
         $wallet_offer = DB::table('wallet_offers')
                       ->get();         
                    
                    
       if($wallet_amt){
        	$message = array('status'=>'1', 'message'=>'Wallet Plans','Nornal Plan'=>$wallet_amt, 'Offer Plan'=>$wallet_offer);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }             
        
    }
    
           public function country_code(Request $request)
    { 
        $wallet_amt = DB::table('country_code')
                    ->get();
                   
                    
                    
       if($wallet_amt){
        	$message = array('status'=>'1', 'message'=>'Country Code','Data'=>$wallet_amt);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }             
        
    }
    
     public function wallet_recharge(Request $request)
    { 
        $user_id = $request->user_id;
        $plan_id = $request->plan_id;
        $transaction_id = $request->transaction_id;
        $type = $request->type;
        $amount = $request->amount;
        $status = $request->status;
         $created_at = Carbon::now();
        
         $user = DB::table('tbl_user')
                     ->where('user_id',$user_id)
                      ->first();
        $user_wallet =   $user->wallet_credits; 
        $user_name =   $user->user_name; 
        $user_phone= $user->user_phone;
        $user_email= $user->user_email;
        if($status=='success'){
                 
        
        if($type=='offer')
            {
                
            $offer =DB::table('wallet_offers')
                    ->where('offer_amount',"<=",$amount)
                    ->orderBy("offer_amount", "DESC")
                    ->first();
                    $type1 =$offer->type;
                    $max_amount =$offer->maximum_offer;
                    $value = $offer->value;
                    $offer_amount = $offer->offer_amount;
                    
                 if($type1=='percentage')
                 {
                      $update_amount = ($value/100)*$offer_amount;  
                      
                          if($update_amount>$max_amount){
                              
                              $update = DB::table('tbl_user')
                                       ->where('user_id',$user_id)
                                        ->update([
                                                 'wallet_credits'=>$max_amount+$user_wallet+$amount,
                                                 ]);
                          }
                          else{
                               $update = DB::table('tbl_user')
                                       ->where('user_id',$user_id)
                                        ->update([
                                                 'wallet_credits'=>$update_amount+$user_wallet+$amount,
                                                 ]);
                          }
                      
                      
                    }
                  else{
                        $update = DB::table('tbl_user')
                                   ->where('user_id',$user_id)
                                    ->update([
                                             'wallet_credits'=>$value+$user_wallet+$amount,
                                             ]);
                       }
                    
            }
           
            else{
                        $update = DB::table('tbl_user')
                                   ->where('user_id',$user_id)
                                    ->update([
                                             'wallet_credits'=>$amount+$user_wallet,
                                             ]);
                       }
                       
            $history = DB::table('wallet_history')
                        ->insert([
                                  'user_id'=>$user_id,
                                  'amount'=>$amount,
                                  'type'=>'Recharge',
                                  'created_at'=>$created_at,
                                  'transaction_id'=>$transaction_id
                                 ]);
            $sms = DB::table('notificationby')
                      ->select('sms')
                      ->where('user_id',$user_id)
                      ->first();
            $sms_status = $sms->sms;
            
                if($sms_status == 1){
                    $orderplacedmsg = $this->rechargesms($amount,$user_name,$user_phone);
                }
                      /////send mail
            $email = DB::table('notificationby')
                  ->select('email','app')
                  ->where('user_id',$user_id)
                  ->first();
               $email_status =   $email->email;
            if($email_status == 1){
                   
                    $codorderplaced = $this->rechargeMail($user_id,$user_name, $user_email, $user_phone,$amount);
              }
             if($email->app ==1){
                $notification_title = "WooHoo! Recharge Successfull";
                $notification_text = "Your Wallet is successfully recharge";
                
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
        
       
        	$message = array('status'=>'1', 'message'=>'Wallet recharge Successfully');
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'oops, something went Wrong');
        	return $message;
        }             
        
    }

    
}