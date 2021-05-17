<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class subController extends Controller
{
 
  
  
  public function reasonofcancellist(Request $request)
    { 
   $pauseorder = DB::table('cancel_reason')
                  ->get();
      
       if($pauseorder){
        	$message = array('status'=>'1', 'message'=>'data found', 'data'=>$pauseorder);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'no data available', 'data'=>[]);
        	return $message;
        }
  }

  
}