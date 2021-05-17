<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class NearbystoreController extends Controller
{
    public function nearbystore(Request $request)
    {
       
    	$lat = $request->lat;
    	$lng = $request->lng;
    	$vendor_category_id = $request->vendor_category_id;


        $groupApp = DB::table("vendor")
     
      ->select("vendor.vendor_name","vendor.vendor_phone","vendor.vendor_id","vendor.vendor_logo","vendor.vendor_category_id","vendor.lat","vendor.lng","vendor.delivery_range","vendor.online_status","vendor.about","vendor.vendor_loc"
        ,DB::raw("6371 * acos(cos(radians(".$lat . ")) 
        * cos(radians(lat)) 
        * cos(radians(lng) - radians(" . $lng . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(lat))) AS distance"))
        ->orderBy('distance')
        ->where('vendor_category_id',$vendor_category_id)
        ->get();
        $storelist = NULL;
        foreach($groupApp as $store)
        {
            if($store->delivery_range > $store->distance){
                $storelist[] = $store; 
            }
        }
        
    if ($storelist != NULL){
            $message = array('status'=>'1', 'message'=>'NearBy Store', 'data'=>$storelist);
            return $message;
           
        }
        
        
        else{
             $message = array('status'=>'0', 'message'=>'We are Coming Soon', 'data'=>[]);
            return $message;

        }
        
         
    }
    

    
}
