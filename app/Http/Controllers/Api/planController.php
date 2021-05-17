<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class planController extends Controller
{
  
     public function planlist(Request $request)
    {   
        $plan = DB::table('subscription_plans')
        		   ->get();

        if(count($plan)>0){
        	$message = array('status'=>'1', 'message'=>'data found', 'data'=>$plan);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }
    }
}