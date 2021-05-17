<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class logoController extends Controller
{
    
     public function logo(Request $request)
    {   
        $logo = DB::table('logo')
        		   ->get();

        if(count($logo)>0){
        	$message = array('status'=>'1', 'message'=>'data found', 'data'=>$logo);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }
    }
}