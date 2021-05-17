<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;

class sms_apiController extends Controller
{    
   public function edit_sms_api(Request $request)
   {
   
        $title="SMS/OTP By";
    	 
    	$admin_email=Session::get('admin');
    	$admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();
  
                
          $msg91 = DB::table('msg91')
                ->first();   
          $twilio = DB::table('twilio')
                ->first(); 
            $smsby = DB::table('smsby')
                ->first();        
         return view('admin.sms_api',compact("admin_email","admin",'title','msg91','twilio','smsby'));
      

    }
      public function update_sms_api(Request $request)
    {
       
         $sender = $request->sender_id;
        $api_key = $request->api;
        $this->validate(
            $request,
                [
                    'sender_id' => 'required',
                    'api'=>'required',
                ],
                [
                    'sender_id.required' => 'Enter Sender ID.',
                    'api.required' =>'Enter api key',
                ]
        );
        
        
        $check = DB::table('msg91')
               ->first();
       
    
      if($check){
        $update = DB::table('msg91')
                ->update(['sender_id'=> $sender,'api_key'=> $api_key,'active'=>1]);
    
      }
      else{
          $update = DB::table('msg91')
                ->insert(['sender_id'=> $sender,'api_key'=> $api_key,'active'=>1]);
      }
     if($update){
         $ue = DB::table('smsby')
                ->update(['msg91'=> 1,'twilio'=> 0,'status'=>1]);
         $deactivetwilio = DB::table('twilio')
                ->update(['active'=>0]);        
        return redirect()->back()->withSuccess('Updated Successfully');
     }
     else{
         return redirect()->back()->withErrors('Nothing to Update');
     }
    }
    
        public function updatetwilio(Request $request)
    {
        
         $sid = $request->sid;
        $token = $request->token;
        $phone = $request->phone;
        $this->validate(
            $request,
                [
                    'sid' => 'required',
                    'token'=>'required',
                    'phone'=>'required',
                ],
                [
                    'sid.required' => 'Enter Twilio SID.',
                    'token.required' =>'Enter Twilio Token.',
                    'phone.required' => 'Enter Twilio Phone.'
                ]
        );
        
        
        $check = DB::table('twilio')
               ->first();
       
    
      if($check){
        

        $update = DB::table('twilio')
                ->update(['twilio_sid'=> $sid,'twilio_token'=> $token, 'twilio_phone'=>$phone,'active'=>1]);
    
      }
      else{
          $update = DB::table('twilio')
                ->insert(['twilio_sid'=> $sid,'twilio_token'=> $token, 'twilio_phone'=>$phone,'active'=>1]);
      }
     if($update){
         $ue = DB::table('smsby')
            ->update(['msg91'=> 0,'twilio'=> 1,'status'=>1]); 
         $deactivemsg91 = DB::table('msg91')
                ->update(['active'=>0]);    
                
        return redirect()->back()->withSuccess('Updated Successfully');
     }
     else{
         return redirect()->back()->withErrors('Nothing to Update');
     }
    }
    public function msgoff(Request $request)
    {
     
       $ue = DB::table('smsby')
            ->update(['msg91'=> 0,'twilio'=> 0, 'status'=>0]);
            
       if($ue){
        $update = DB::table('twilio')
                ->update(['active'=>0]);
                
        $deactivemsg91 = DB::table('msg91')
                ->update(['active'=>0]);         
        return redirect()->back()->withSuccess('SMS and OTP Switched Off For App');
      }
      else{
         return redirect()->back()->withErrors('Already Switched Off');
      }
  
    }
    
}