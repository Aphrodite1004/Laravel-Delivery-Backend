<?php

namespace App\Http\Controllers\Cityadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;


class notiController extends Controller
{
  
   public function notification1(Request $request) {
       $cityadmin_email=Session::get('cityadmin');
    
    	  $cityadmin=DB::table('cityadmin')
    			->where('cityadmin_email',$cityadmin_email)
    			->first();	
 
        return view('cityadmin.send_noti', compact("cityadmin_email", "cityadmin"));
   }
   
 
      public function notification2(Request $request) {
     $cityadmin_email=Session::get('cityadmin');
    	 
	 $cityadmin=DB::table('cityadmin')
			->where('cityadmin_email',$cityadmin_email)
			->first();
			
	 $cityadmin_id = $cityadmin->cityadmin_id;   
    $message= $request->message;    
    $notification_title = $request->notification_title;    
       $message=array('title' => $notification_title, 'body' => $message ,'sound'=>'Default','image'=>'Notification Image');
        $registers = DB::table('tbl_user')
           ->join('user_address', 'tbl_user.user_id', '=', 'user_address.user_id')
           ->join('city', 'user_address.city_id', '=', 'city.city_id')
           ->join('cityadmin', 'city.city_id', '=', 'cityadmin.city_id')
           ->select('tbl_user.device_id')
           ->where('cityadmin.cityadmin_id', $cityadmin_id)
           ->get();
           
      foreach($registers as $regs){
             if($regs->device_id!=""){
                     $registatoin_ids[] = $regs->device_id;
                     $result = $this->send_notification($regs->device_id, $message);
             }
      } 
        return redirect()->back()->withErrors('Notification sent successfully to all app users of this city');
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
        
       $api_key = "AAAAlOsLxCY:APA91bFZDjaj1MjY3ihA_sKtKPD-MzDh97m_4FJjFgFxoOE8JbJkHsT8JjbWu3s1C7xXoMnJzIHa2_3AcVrM4Dr7aTBZN2lcPkayIdCPKEeik7BBULzjH3R4WVjxytrqo1szZojl9Ila";
        
        
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