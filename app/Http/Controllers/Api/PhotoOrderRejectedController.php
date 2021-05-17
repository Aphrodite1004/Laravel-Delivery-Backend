<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Hash;
use Session;
use App\Traits\SendMail;
use App\Traits\SendSms;

class PhotoOrderRejectedController extends Controller
{
     use SendMail;
    use SendSms;

 
 
     public function pharmacy_product_price(Request $request)
    {   
        $current = Carbon::now();
        $data= $request->order_array;
        $data_array = json_decode($data);
        $vendor_id = $request->vendor_id;
        

      
       
    foreach ($data_array as $h){
        $variant_id = $h->variant_id;
         $p =  DB::table('resturant_variant')
             ->join('resturant_product','resturant_variant.product_id','=','resturant_product.product_id')
           ->Leftjoin('resturant_deal_product','resturant_variant.variant_id','=','resturant_deal_product.variant_id')
           ->where('resturant_variant.variant_id',$variant_id)
           ->where('resturant_variant.vendor_id',$vendor_id)
           ->get();
        //  if($p->deal_price != NULL){
        //   $deal_price= $p->deal_price;    
        //   }
        // else{
        //           $price = $p->price;
        //     } 
        
          
          $data[]=array('vendor_id'=>$vendor_id,'Data'=>$p); 
        
    
       
       
 }
 

}
    
}
