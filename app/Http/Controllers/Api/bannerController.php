<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class bannerController extends Controller
{
  
    public function vendorbanner(Request $request)
    {   
        $vendor_id= $request->vendor_id;
        $banner = DB::table('banner')
        		   ->get();

        if(count($banner)>0){
        	$message = array('status'=>'1', 'message'=>'data found', 'data'=>$banner);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }
    }

}    