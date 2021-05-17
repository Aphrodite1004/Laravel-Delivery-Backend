<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class notificationbyController extends Controller
{
  
     public function notificationby(Request $request)
    {   
        $user_id = $request->user_id;
        $sms = $request->sms;
        $app = $request->app;
        $email = $request->email;
        $update =DB::table('notificationby')
              ->where('user_id',$user_id)
               ->update(['sms'=>$sms,
               'app'=>$app,
               'email'=>$email]);
                        
    if($update){
         $message = array('status'=>'1', 'message'=>'updated');
             return $message;
              }		
     else{
              $message = array('status'=>'0', 'message'=>'something went wrong');
	           return $message;
    	}
}
}