<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Hash;

class DriverstatusController extends Controller
{
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
        	     $message = array('status'=>'0', 'message'=>'something went wrong');
        	         return $message;
        	  }    	         
    	}
  
    } 
}