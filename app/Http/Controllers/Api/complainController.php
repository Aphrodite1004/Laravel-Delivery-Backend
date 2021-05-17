<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class complainController extends Controller
{
    
     public function showcomplain(Request $request)
    {   
        $complain = DB::table('cancel_for')
        		   ->get();

        if(count($complain)>0){
        	$message = array('status'=>'1', 'message'=>'Cancel reason', 'data'=>$complain);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }
    }

}