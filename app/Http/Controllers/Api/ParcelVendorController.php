<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DateTime;
use Carbon\Carbon;
use App\Traits\SendMail;
use App\Traits\SendSms;

class ParcelVendorController extends Controller
{
 use SendMail;
 use SendSms;
    public function parcel_city(Request $request)
    {
        $vendor_id = $request->vendor_id;
        $parcel_char= DB::table('parcel_city')
        ->where('vendor_id', $vendor_id)
       ->get();	

       if(count($parcel_char)>0)	{                     
        $message = array('status'=>'1', 'message'=>'data found', 'data'=>$parcel_char);
        return $message;
     }
    else
     {
        $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[] );
        return $message;
     }		

    }
    public function parcel_listcharges(Request $request)
    {
        $vendor_id = $request->vendor_id;
        $parcel_char= DB::table('parcel_charges')
        ->join('parcel_city', 'parcel_charges.city_from','=', 'parcel_city.city_id')
        ->where('parcel_charges.vendor_id', $vendor_id)
       ->get();	

       if(count($parcel_char)>0)	{                     
        $message = array('status'=>'1', 'message'=>'data found', 'data'=>$parcel_char);
        return $message;
     }
    else
     {
        $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[] );
        return $message;
     }		

    }
    public function parcel_addcharges(Request $request)
    { 
        $city_id= $request->city_id;
        $charges = $request->charges;
        $description= $request->description;
        $vendor_id = $request->vendor_id;


        $insert = DB::table('parcel_charges')
        ->insert([
                'city_from'=>$city_id,
                'parcel_charge'=>$charges,
                'charge_description'=>$description,
                'vendor_id'=>$vendor_id

                 ]);
                 if($insert){
                    $message = array('status'=>'1', 'message'=>'data found', 'data'=>$insert);
                    return $message;
                }
                
                else{
                    $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
                    return $message;
                }
    }
    public function parcel_updatecharges(Request $request)
    { 
        $city_id= $request->city_id;
        $charges = $request->charges;
        $description= $request->description;
        $charge_id= $request->charge_id;

        $insert = DB::table('parcel_charges')
        ->where('charge_id',$charge_id)
        ->update([
                'city_from'=>$city_id,
                'parcel_charge'=>$charges,
                'charge_description'=>$description
                 ]);
                 if($insert){
                    $message = array('status'=>'1', 'message'=>'update Successfully', 'data'=>$insert);
                    return $message;
                }
                
                else{
                    $message = array('status'=>'0', 'message'=>'data not update', 'data'=>[]);
                    return $message;
                }
    }
    public function parcel_deletecharges(Request $request)
    {
        $charge_id=$request->charge_id;

    	$delete=DB::table('parcel_charges')->where('charge_id',$charge_id)->delete();
        if($delete)
        {
         
         $delete = array('status'=>'1', 'message'=>'Deleted Successfully');

        return $delete;
        }
        else
        {
         $delete = array('status'=>'0', 'message'=>'Unsuccessfull Delete');
         return $delete;        }
    }

    public function parcel_today_order(Request $request)
    {
 
    			
    	$currentDate = date('Y-m-d');
        $day = 1;
       $current2 = date('d-m-Y', strtotime($currentDate.' + '.$day.' days'));
    			
    	 $vendor_id = $request->vendor_id;			
    	  $todayorder  =   DB::table('parcel_details')
                          ->join('tbl_user', 'parcel_details.user_id', '=', 'tbl_user.user_id')
    	                   ->join('source_address','parcel_details.source_address_id', '=', 'source_address.source_address_id')
                           ->join('destination_address','parcel_details.destination_address_id', '=', 'destination_address.destination_address_id')
                            ->join('parcel_city', 'parcel_details.city_id','=', 'parcel_city.city_id')
    	                    ->join('vendor', 'parcel_details.vendor_id','=', 'vendor.vendor_id')
    	                    ->leftJoin('delivery_boy','parcel_details.dboy_id', '=','delivery_boy.delivery_boy_id')    	           
                            ->where('parcel_details.vendor_id', $vendor_id)
                             ->where('parcel_details.payment_status','!=', 'NULL')
                             ->where('parcel_details.order_status','!=', 'Cancelled')
                             ->where('parcel_details.order_status','!=', 'Completed')
                           
                            ->get();
                
                           if(count($todayorder)>0){
                            foreach($todayorder as $ords){
                                $data[]=array('parcel_id'=>$ords->parcel_id,'source_lat'=>$ords->source_lat,'source_lng'=>$ords->source_lng,'source_phone'=>$ords->source_phone,'source_name'=>$ords->source_name,'destination_lat'=>$ords->destination_lat,'destination_lng'=>$ords->destination_lng,'destination_name'=>$ords->destination_name,'destination_phone'=>$ords->destination_phone,'lat'=>$ords->lat,'lng'=>$ords->lng,'source_address_id'=>$ords->source_address_id,'destination_address_id'=>$ords->destination_address_id,'cart_id'=>$ords->cart_id,'user_id'=>$ords->user_id,'vendor_id'=>$ords->vendor_id,'weight'=>$ords->weight,'length'=>$ords->length,'height'=>$ords->height,'width'=>$ords->width,'pickup_time'=>$ords->pickup_time,'pickup_date'=>$ords->pickup_date,'city_id'=>$ords->city_id,'lat'=>$ords->lat,'lng'=>$ords->lng,'charges'=>$ords->charges,'distance'=>$ords->distance,'payment_method'=>$ords->payment_method,'order_status'=>$ords->order_status,'payment_status'=>$ords->payment_status,'wallet'=>$ords->wallet,'dboy_id'=>$ords->dboy_id,'user_name'=>$ords->user_name,'user_email'=>$ords->user_email,'user_image'=>$ords->user_image,'user_phone'=>$ords->user_phone,'user_password'=>$ords->user_password,'device_id'=>$ords->device_id,'wallet_credits'=>$ords->wallet_credits,'rewards'=>$ords->rewards,'otp'=>$ords->otp,'phone_verified'=>$ords->phone_verified,'referral_code'=>$ords->referral_code,'source_pincode'=>$ords->source_pincode,'source_houseno'=>$ords->source_houseno,'source_landmark'=>$ords->source_landmark,'source_add'=>$ords->source_add,'source_state'=>$ords->source_state,'source_city'=>$ords->source_city,'destination_pincode'=>$ords->destination_pincode,'destination_houseno'=>$ords->destination_houseno,'destination_landmark'=>$ords->destination_landmark,'destination_add'=>$ords->destination_add,'destination_state'=>$ords->destination_state,'destination_city'=>$ords->destination_city,'city_name'=>$ords->city_name,'city_image'=>$ords->city_image,'vendor_name'=>$ords->vendor_name,'owner'=>$ords->owner,'vendor_email'=>$ords->vendor_email,'vendor_phone'=>$ords->vendor_phone,'vendor_logo'=>$ords->vendor_logo,'vendor_loc'=>$ords->vendor_loc,'opening_time'=>$ords->opening_time,'closing_time'=>$ords->closing_time,'vendor_pass'=>$ords->vendor_pass,'vendor_category_id'=>$ords->vendor_category_id,'comission'=>$ords->comission,'delivery_range'=>$ords->delivery_range,'ui_type'=>$ords->ui_type,'online_status'=>$ords->online_status,'delivery_boy_id'=>$ords->delivery_boy_id,'delivery_boy_name'=>$ords->delivery_boy_name,'delivery_boy_phone'=>$ords->delivery_boy_phone,'delivery_boy_pass'=>$ords->delivery_boy_pass,'is_confirmed'=>$ords->is_confirmed,'phone_verify'=>$ords->phone_verify,'dboy_comission'=>$ords->dboy_comission); 
                                              } 

                                          }
                                  else{
                                  $data[]=array('order_details'=>'no orders found');
                                          }
                                          return $data;

    }

    public function parcel_next_day_order(Request $request)
    {
 
    			
        $currentDate = date('Y-m-d');
        $day = 1;
        $end = date('Y-m-d', strtotime($currentDate.' + '.$day.' days'));
    			
    	 $vendor_id = $request->vendor_id;			
    	  $nextdayorder  =   DB::table('parcel_details')
                          ->join('tbl_user', 'parcel_details.user_id', '=', 'tbl_user.user_id')
    	                   ->join('source_address','parcel_details.source_address_id', '=', 'source_address.source_address_id')
                           ->join('destination_address','parcel_details.destination_address_id', '=', 'destination_address.destination_address_id')
                            ->join('parcel_city', 'parcel_details.city_id','=', 'parcel_city.city_id')
    	                    ->join('vendor', 'parcel_details.vendor_id','=', 'vendor.vendor_id')
    	                    ->leftJoin('delivery_boy','parcel_details.dboy_id', '=','delivery_boy.delivery_boy_id')    	           
                            ->where('parcel_details.vendor_id', $vendor_id)
                             ->where('parcel_details.payment_status','!=', 'NULL')
                             ->where('parcel_details.order_status','!=', 'Cancelled')
                             ->where('parcel_details.order_status','!=', 'Completed')
                            ->whereDate('pickup_date', $end)
                            ->get();
                
                           if(count($nextdayorder)>0){
                            foreach($nextdayorder as $ords){
                                $data[]=array('parcel_id'=>$ords->parcel_id,'source_lat'=>$ords->source_lat,'source_lng'=>$ords->source_lng,'source_phone'=>$ords->source_phone,'source_name'=>$ords->source_name,'destination_lat'=>$ords->destination_lat,'destination_lng'=>$ords->destination_lng,'destination_name'=>$ords->destination_name,'destination_phone'=>$ords->destination_phone,'lat'=>$ords->lat,'lng'=>$ords->lng,'source_address_id'=>$ords->source_address_id,'destination_address_id'=>$ords->destination_address_id,'cart_id'=>$ords->cart_id,'user_id'=>$ords->user_id,'vendor_id'=>$ords->vendor_id,'weight'=>$ords->weight,'length'=>$ords->length,'height'=>$ords->height,'width'=>$ords->width,'pickup_time'=>$ords->pickup_time,'pickup_date'=>$ords->pickup_date,'city_id'=>$ords->city_id,'lat'=>$ords->lat,'lng'=>$ords->lng,'charges'=>$ords->charges,'distance'=>$ords->distance,'payment_method'=>$ords->payment_method,'order_status'=>$ords->order_status,'payment_status'=>$ords->payment_status,'wallet'=>$ords->wallet,'dboy_id'=>$ords->dboy_id,'user_name'=>$ords->user_name,'user_email'=>$ords->user_email,'user_image'=>$ords->user_image,'user_phone'=>$ords->user_phone,'user_password'=>$ords->user_password,'device_id'=>$ords->device_id,'wallet_credits'=>$ords->wallet_credits,'rewards'=>$ords->rewards,'otp'=>$ords->otp,'phone_verified'=>$ords->phone_verified,'referral_code'=>$ords->referral_code,'source_pincode'=>$ords->source_pincode,'source_houseno'=>$ords->source_houseno,'source_landmark'=>$ords->source_landmark,'source_add'=>$ords->source_add,'source_state'=>$ords->source_state,'source_city'=>$ords->source_city,'destination_pincode'=>$ords->destination_pincode,'destination_houseno'=>$ords->destination_houseno,'destination_landmark'=>$ords->destination_landmark,'destination_add'=>$ords->destination_add,'destination_state'=>$ords->destination_state,'destination_city'=>$ords->destination_city,'city_name'=>$ords->city_name,'city_image'=>$ords->city_image,'vendor_name'=>$ords->vendor_name,'owner'=>$ords->owner,'vendor_email'=>$ords->vendor_email,'vendor_phone'=>$ords->vendor_phone,'vendor_logo'=>$ords->vendor_logo,'vendor_loc'=>$ords->vendor_loc,'opening_time'=>$ords->opening_time,'closing_time'=>$ords->closing_time,'vendor_pass'=>$ords->vendor_pass,'vendor_category_id'=>$ords->vendor_category_id,'comission'=>$ords->comission,'delivery_range'=>$ords->delivery_range,'ui_type'=>$ords->ui_type,'online_status'=>$ords->online_status,'delivery_boy_id'=>$ords->delivery_boy_id,'delivery_boy_name'=>$ords->delivery_boy_name,'delivery_boy_phone'=>$ords->delivery_boy_phone,'delivery_boy_pass'=>$ords->delivery_boy_pass,'is_confirmed'=>$ords->is_confirmed,'phone_verify'=>$ords->phone_verify,'dboy_comission'=>$ords->dboy_comission); 
                                              }                                          }
                                  else{
                                  $data[]=array('order_details'=>'no orders found');
                                          }
                                          return $data;

    }
    public function parcel_complete_order(Request $request)
    {
 
    			
        $currentDate = date('Y-m-d');
        $day = 1;
        $end = date('Y-m-d', strtotime($currentDate.' + '.$day.' days'));
    			
    	 $vendor_id = $request->vendor_id;			
    	  $completeorder  =   DB::table('parcel_details')
                          ->join('tbl_user', 'parcel_details.user_id', '=', 'tbl_user.user_id')
    	                   ->join('source_address','parcel_details.source_address_id', '=', 'source_address.source_address_id')
                           ->join('destination_address','parcel_details.destination_address_id', '=', 'destination_address.destination_address_id')
                            ->join('parcel_city', 'parcel_details.city_id','=', 'parcel_city.city_id')
    	                    ->join('vendor', 'parcel_details.vendor_id','=', 'vendor.vendor_id')
    	                    ->leftJoin('delivery_boy','parcel_details.dboy_id', '=','delivery_boy.delivery_boy_id')    	           
                            ->where('parcel_details.vendor_id', $vendor_id)
                            ->where('parcel_details.order_status',"Completed")
                            ->get();
                
                           if(count($completeorder)>0){
                            foreach($completeorder as $ords){
                            $data[]=array('parcel_id'=>$ords->parcel_id,'source_lat'=>$ords->source_lat,'source_lng'=>$ords->source_lng,'source_phone'=>$ords->source_phone,'source_name'=>$ords->source_name,'destination_lat'=>$ords->destination_lat,'destination_lng'=>$ords->destination_lng,'destination_name'=>$ords->destination_name,'destination_phone'=>$ords->destination_phone,'lat'=>$ords->lat,'lng'=>$ords->lng,'source_address_id'=>$ords->source_address_id,'destination_address_id'=>$ords->destination_address_id,'cart_id'=>$ords->cart_id,'user_id'=>$ords->user_id,'vendor_id'=>$ords->vendor_id,'weight'=>$ords->weight,'length'=>$ords->length,'height'=>$ords->height,'width'=>$ords->width,'pickup_time'=>$ords->pickup_time,'pickup_date'=>$ords->pickup_date,'city_id'=>$ords->city_id,'lat'=>$ords->lat,'lng'=>$ords->lng,'charges'=>$ords->charges,'distance'=>$ords->distance,'payment_method'=>$ords->payment_method,'order_status'=>$ords->order_status,'payment_status'=>$ords->payment_status,'wallet'=>$ords->wallet,'dboy_id'=>$ords->dboy_id,'user_name'=>$ords->user_name,'user_email'=>$ords->user_email,'user_image'=>$ords->user_image,'user_phone'=>$ords->user_phone,'user_password'=>$ords->user_password,'device_id'=>$ords->device_id,'wallet_credits'=>$ords->wallet_credits,'rewards'=>$ords->rewards,'otp'=>$ords->otp,'phone_verified'=>$ords->phone_verified,'referral_code'=>$ords->referral_code,'source_pincode'=>$ords->source_pincode,'source_houseno'=>$ords->source_houseno,'source_landmark'=>$ords->source_landmark,'source_add'=>$ords->source_add,'source_state'=>$ords->source_state,'source_city'=>$ords->source_city,'destination_pincode'=>$ords->destination_pincode,'destination_houseno'=>$ords->destination_houseno,'destination_landmark'=>$ords->destination_landmark,'destination_add'=>$ords->destination_add,'destination_state'=>$ords->destination_state,'destination_city'=>$ords->destination_city,'city_name'=>$ords->city_name,'city_image'=>$ords->city_image,'vendor_name'=>$ords->vendor_name,'owner'=>$ords->owner,'vendor_email'=>$ords->vendor_email,'vendor_phone'=>$ords->vendor_phone,'vendor_logo'=>$ords->vendor_logo,'vendor_loc'=>$ords->vendor_loc,'opening_time'=>$ords->opening_time,'closing_time'=>$ords->closing_time,'vendor_pass'=>$ords->vendor_pass,'vendor_category_id'=>$ords->vendor_category_id,'comission'=>$ords->comission,'delivery_range'=>$ords->delivery_range,'ui_type'=>$ords->ui_type,'online_status'=>$ords->online_status,'delivery_boy_id'=>$ords->delivery_boy_id,'delivery_boy_name'=>$ords->delivery_boy_name,'delivery_boy_phone'=>$ords->delivery_boy_phone,'delivery_boy_pass'=>$ords->delivery_boy_pass,'is_confirmed'=>$ords->is_confirmed,'phone_verify'=>$ords->phone_verify,'dboy_comission'=>$ords->dboy_comission); 
                                          }
                                        }
                                  else{
                                  $data[]=array('order_details'=>'no orders found');
                                          }
                                          return $data;

    }
     public function parcel_store_order(Request $request)
         {
         
             $delivery_id = $request->delivery_boy_id;
             $order_id = $request->parcel_id;
              $update = DB::table('parcel_details')
                       ->where('parcel_id',$order_id)
                       ->update(['dboy_id'=>$delivery_id,
                       'order_status'=>"Confirmed"
                       ]);
                       
                       if($update)	{
      
       
                                  
                        $mess = array('status'=>'1', 'message'=>'Delivery boy assigned successfully', 'data'=>$update);
                        return $mess;
                     }
                    else
                     {
                        $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
                        return $message;
                     }     
                       		
      
         }

}