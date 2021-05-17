<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class faqController extends Controller
{
    
     public function faq(Request $request)
    {   
        $faq = DB::table('faq')
        	->get();

        if(count($faq)>0){
        	$message = array('status'=>'1', 'message'=>'data found', 'data'=>$faq);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }
    }
    
}    