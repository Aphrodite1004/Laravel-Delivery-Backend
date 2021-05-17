<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;


class NotificationController extends Controller
{
  
   public function vendor_notification(Request $request) {
       $vendor_email=Session::get('vendor');
    
    	  $vendor=DB::table('vendor')
    			->where('vendor_email',$vendor_email)
    			->first();	
         DB::table('vendor_notification')->where('vendor_id',$vendor->vendor_id)->update(['read_by_vendor'=>1]);
        return redirect()->back(); 
     }
   
 
     public function notification2(Request $request) 
     {
         
    $message= $request->message;    
    $notification_title = $request->notification_title;    
       $message=array('title' => $notification_title, 'body' => $message ,'sound'=>'Default','image'=>'Notification Image');
        $registers = DB::table('tbl_user')
           ->select('device_id')
           ->get();
           
      foreach($registers as $regs){
             if($regs->device_id!=""){
                     $registatoin_ids[] = $regs->device_id;
                     $result = $this->send_notification($regs->device_id, $message);
                   
             }
      } 
        return redirect()->back()->withErrors('Notification sent successfully to all app users');
      }
   
    
  
      public function send_notification($registatoin_ids, $message) {
         
        
     
        
       
            $fields = array(
                        'to' => $registatoin_ids,
                        'notification' => $message,
                        'priority' => 'high',
                        'content_available' => true
                    );

        
      return  $this->send($fields);
    }
   
   
    public function send($fields){
      
        $url = 'https://fcm.googleapis.com/fcm/send';
        $registers = DB::table('fcm_key')
           ->select('user_app_key')
           ->first();
        
        $api_key = $registers->user_app_key;
        
        
        $headers = array(
            'Authorization: key=' .$api_key ,
            'Content-Type: application/json'
        );
        
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        
        // Close connection
        curl_close($ch);
        
        return $result;
        

    }
}    