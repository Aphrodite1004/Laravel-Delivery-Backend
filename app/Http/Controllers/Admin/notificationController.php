<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;


class notificationController extends Controller
{
        public function admin_notification(Request $request) {
        $admin_email=Session::get('admin');
     
           $admin=DB::table('admin')
                 ->where('admin_email',$admin_email)
                 ->first();	
          DB::table('payout_notification')->update(['read_by_admin'=>1]);
         return redirect()->back(); 
      }
    public function adminNotification(Request $request)
    {
        $admin_email=Session::get('admin');
        
                    $admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();	

        return view('admin.send_notification',compact("admin_email","admin"));
    }

    public function adminNotificationSend(Request $request)
    {
        $this->validate(
            $request,
                [
                    'notification_title' => 'required',
                    'notification_text' => 'required',
                    'category_image' => 'required|mimes:jpeg,png,jpg|max:400',
             
                ],
                [
                    'notification_title.required' => 'Enter notification title.',
                    'notification_text.required' => 'Enter notification text.',
                    'category_image.required' => 'Enter Image for Notification',
                ]
        );

        $notification_title = $request->notification_title;
        $notification_text = $request->notification_text;
        
        $date = date('d-m-Y');
        
        if($request->hasFile('category_image')){
            $category_image = $request->category_image;
            $fileName = $category_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $category_image->move('images/category/'.$date.'/', $fileName);
            $category_image = 'images/category/'.$date.'/'.$fileName;
        }
        else{
            $category_image = 'N/A';
        }

    


            $getUser = DB::table('tbl_user')
                        ->get();

            $getDevice = DB::table('tbl_user')
                        ->where('device_id', '!=', null)
                        ->select('device_id')
                        ->groupBy('device_id')
                        ->get();
                        
        $created_at = Carbon::now();

        if(count($getDevice) == 0){
            return redirect()->back()->withErrors('something wents wrong');
        }

        
        $getFcm = DB::table('fcm_key')
                    ->where('unique_id', '1')
                    ->first();
                    
        $getFcmKey = $getFcm->user_app_key;
        
        foreach ($getDevice as $getDevices) {
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            $token = $getDevices->device_id;;
            

            $notification = [
                'title' => $notification_title,
                'body' => $notification_text,
                'image' =>$category_image,
                'sound' => true,
            ];
            
            $extraNotificationData = ["message" => $notification,'image' => $category_image,];

            $fcmNotification = [
               
                'to'        => $token, //single token
                'notification' => $notification,
                'data' => $extraNotificationData,
                'image' => $category_image,
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
        }
        $results = json_decode($result);
         foreach ($getUser as $getUsers) {
            $insertNotification = DB::table('user_notification')
                                    ->insert([
                                        'user_id'=>$getUsers->user_id,
                                        'noti_title'=>$notification_title,
                                        'noti_message'=>$notification_text,
                                        'image'=>$category_image,
                                      
                                    ]);
        }
        return redirect()->back()->withSuccess('Notification send successfully');
    }
    
    
    
     public function Notification_to_store(Request $request)
    {
        $admin_email=Session::get('admin');
        
                    $admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();	

        return view('admin.notification_store',compact("admin_email","admin"));
    }

    public function Notification_to_store_Send(Request $request)
    {
        $this->validate(
            $request,
                [
                    'notification_title' => 'required',
                    'notification_text' => 'required',
             
                ],
                [
                    'notification_title.required' => 'Enter notification title.',
                    'notification_text.required' => 'Enter notification text.',
                ]
        );

        $notification_title = $request->notification_title;
        $notification_text = $request->notification_text;
        
        $date = date('d-m-Y');

    


            $getUser = DB::table('vendor')
                        ->get();

            $getDevice = DB::table('vendor')
                        ->where('device_id', '!=', NULL)
                        ->select('device_id')
                        ->groupBy('device_id')
                        ->get();
                        
        $created_at = Carbon::now();

        if(count($getDevice) == 0){
            return redirect()->back()->withErrors('something wents wrong');
        }

        
        $getFcm = DB::table('fcm_key')
                    ->where('unique_id', '1')
                    ->first();
                    
        $getFcmKey = $getFcm->user_app_key;
        
        foreach ($getDevice as $getDevices) {
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            $token = $getDevices->device_id;;
            

            $notification = [
                'title' => $notification_title,
                'body' => $notification_text,
                'sound' => true,
            ];
            
            $extraNotificationData = ["message" => $notification];

            $fcmNotification = [
                //'registration_ids' => $tokenList, //multple token array
                'to'        => $token, //single token
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
        }
        foreach ($getUser as $getUsers) {
            $insertNotification = DB::table('vendor_notification')
                                    ->insert([
                                        'vendor_id'=>$getUsers->vendor_id,
                                        'not_title'=>$notification_title,
                                        'not_message'=>$notification_text,
                                      
                                    ]);
        }
        $results = json_decode($result);

        return redirect()->back()->withSuccess('Notification send to store successfully');
    }
    
    
    
    
    
    
}   