<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\carbon;
use App\Traits\SendMail;
use App\Traits\SendSms;

class MapController extends Controller
{
     use SendMail;
 use SendSms;
  
     public function show_map(Request $request)
    { 
    
        $map = DB::table('map_settings')
                    ->where('map_id','1')
                    ->first();
        $gmap =  $map->google_map;  
        $gmap_box =  $map->mapbox; 
        
        if($gmap==1)
        {
            $map1 = DB::table('map_API')
                     ->where('key_id','1')
                     ->select('map_api_key')
                    ->first();
            $key =   $map1->map_api_key;  
            	$message = array('status'=>'1', 'message'=>'Google Map is Activate','Staus'=>$gmap, 'key'=>$key);
        	return $message;        
        }
        else
        {
             $map2 = DB::table('mapbox')
                    ->where('map_id','1')
                    ->select('mapbox_api')
                    ->first();
             $key = $map2->mapbox_api;        
            	$message = array('status'=>'1', 'message'=>'Map box is Activate', 'Staus'=>2,'key'=>$key);
        	return $message; 
        }
                   
        
    }


    
}