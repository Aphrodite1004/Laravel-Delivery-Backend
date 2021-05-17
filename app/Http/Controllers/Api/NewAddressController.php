<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class NewAddressController extends Controller
{
     public function address(Request $request)
    {
            $user_number = $request->user_number;
            $user_name = $request->user_name;
            $user_id = $request->user_id;
            $city_id = $request->city_id;
            $area_id = $request->area_id;
            $house_no = $request->houseno;
            $state = $request->state;
            $street = $request->street;
            $type = $request->address_type;
            $city = DB::table('city')
            ->select('city_name')
            ->where('city_id', $city_id)
            ->first();
            $area = DB::table('area')
            ->select('area_name')
            ->where('area_id', $area_id)
            ->first();
            $area_name = $area->area_name;
            $city_name = $city->city_name;
            $state = $request->state;
            $pin = $request->pin;
            $lat = $request->lat;
            $lng = $request->lng;
            $status= 1;
             $address = $house_no .",".  $street .",".  $area_name .",".  $city_name .",".  $state .",". $pin; 
            $added_at= Carbon::Now();
    	    
    	    $insertaddress = DB::table('user_address')
    						->insert([
    							'user_id'=>$user_id,
    							'user_name'=>$user_name,
    							'user_number'=>$user_number,
    							'city_id'=>$city_id,
    							'area_id'=>$area_id,
    							'address'=>$address,
    							'select_status'=>0,
    							'lat' => $lat,
    							'lng' => $lng,
    							'houseno' =>$house_no,
    							'pincode' =>$pin,
    							'state' => $state,
    							'street'=>$street,
    							'type'=>$type
                            ]);
                            
          if($insertaddress){
                $message = array('status'=>'1', 'message'=>'Address Saved');
                return $message;
                            }		
          else{
                 $message = array('status'=>'0', 'message'=>'something went wrong');
	            return $message;
    	}
      }
      
    public function city(Request $request)
    {
    $vendor_id= $request->vendor_id;
    if($vendor_id != NULL){
    $cit = DB::table('vendor')
         ->where('vendor_id',$vendor_id)
         ->first();
    $city= DB::table('city')
         ->join('cityadmin', 'cityadmin.city_id','=','city.city_id')
         ->select('city.*')
         ->where('cityadmin.cityadmin_id',$cit->cityadmin_id)
         ->get();
    }
    else{
        $city= DB::table('city')
         ->get();
    }
       if(count($city)>0){
                $message = array('status'=>'1', 'message'=>'city list','data'=>$city);
                return $message;
                            }		
          else{
                 $message = array('status'=>'0', 'message'=>'city not found', 'data'=>[]);
	            return $message;
    	}    
    }
    
    public function society(Request $request)
    {
    $city_id = $request->city_id;
    $vendor_id = $request->vendor_id;
    
   
   if($city_id != NULL && $vendor_id == NULL){ 
     $society= DB::table('area')
         ->join('cityadmin','area.cityadmin_id','=','cityadmin.cityadmin_id')
         ->join('city', 'cityadmin.city_id','=','city.city_id')
         ->select('area.*')
         ->where('city.city_id',$city_id)
         ->get();
   }
   else{
    $society= DB::table('area')
         ->join('vendor_area','area.area_id','=','vendor_area.area_id')
         ->where('vendor_area.vendor_id',$vendor_id)
         ->get();
   }
         
       if(count($society)>0){
                $message = array('status'=>'1', 'message'=>'Area list','data'=>$society);
                return $message;
                            }		
          else{
                 $message = array('status'=>'0', 'message'=>'Area not found', 'data'=>[]);
	            return $message;
    	}    
     }
     
     
   public function show_address(Request $request)
    {
    $user_id = $request->user_id;
       
    $address = DB::table('user_address')
         ->where('user_address.user_id',$user_id)
      
         ->get();
    
	 
         
    if(count($address)>0){
     $message = array('status'=>'1', 'message'=>'Address list','data'=>$address);
                return $message;
                            }		
          else{
                 $message = array('status'=>'0', 'message'=>'Address not found! Add Address', 'data'=>[]);
	            return $message;
    	}    
     }
     
     
public function select_address(Request $request)
    {
    $address_id = $request->address_id;
    $user = DB::table('user_address')
         ->where('address_id',$address_id)
         ->first();
    $checkuser = $user->user_id;  
    $select1 = DB::table('user_address')
         ->where('user_id',$checkuser)
         ->update(['select_status'=> 0]);
    $select = DB::table('user_address')
         ->where('address_id',$address_id)
         ->update(['select_status'=> 1]);
         if($select){
                $message = array('status'=>'1', 'message'=>'Address Selected');
                return $message;
                            }		
          else{
                 $message = array('status'=>'0', 'message'=>'cannot select please try again later');
	            return $message;
    	}    
     }     
     
public function rem_user_address(Request $request)
    {
    $address_id = $request->address_id;
    $checkcart = DB::table('orders')
               ->where('address_id', $address_id)
               ->get();
    if(count($checkcart)==0) {
        $deladdress= DB::table('user_address')
         ->where('address_id',$address_id)
         ->delete();
        
    }  
    else{
    $deladdress= DB::table('user_address')
         ->where('address_id',$address_id)
         ->update(['select_status'=>2]);
    }
  
       if($deladdress){
         
                $message = array('status'=>'1', 'message'=>'Address Removed');
                return $message;
                            }		
          else{
                 $message = array('status'=>'0', 'message'=>'Try Again Later');
	            return $message;
    	}    
     }     
          
     
      
public function edit_add(Request $request)
    {
           $user_number = $request->user_number;
            $user_name = $request->user_name;
            $address_id = $request->address_id;
            $user_id = $request->user_id;
            $unselect= DB::table('user_address')
                     ->where('user_id' ,$user_id)
                     ->get();
                     
            if(count($unselect)>0){
            $unselect= DB::table('user_address')
                     ->where('user_id' ,$user_id)
                     ->update(['select_status'=> 0]);
            }
            $user_id = $request->user_id;
            $city_id = $request->city_id;
            $area_id = $request->area_id;
            $house_no = $request->houseno;
            $street = $request->street;
            $state = $request->state;
            $vendor_id = $request->vendor_id;
            $type = $request->address_type;
            $city = DB::table('city')
            ->select('city_name')
            ->where('city_id', $city_id)
            ->first();
            $area = DB::table('area')
            ->select('area_name')
            ->where('area_id', $area_id)
            ->first();
            $area_name = $area->area_name;
            $city_name = $city->city_name;
            $state = $request->state;
            $pin = $request->pin;
            $address = $house_no .",".  $street .",".  $area_name .",".  $city_name .",".  $state .",". $pin; 
            $status= 1;
            $lat = $request->lat;
            $lng = $request->lng;
            $added_at= Carbon::Now();
     
      
    	    
    	    $insertaddress = DB::table('user_address')
    	                    ->where('address_id',$address_id)
    						->update([
    							'user_id'=>$user_id,
    							'user_name'=>$user_name,
    							'user_number'=>$user_number,
    							'city_id'=>$city_id,
    							'area_id'=>$area_id,
    							'address'=>$address,
    							'lat' => $lat,
    							'lng' => $lng,
    							'select_status'=>0,
    							'houseno' =>$house_no,
    							'pincode' =>$pin,
    							'state' => $state,
    							'street'=>$street,
    							'type'=>$type
                            ]);
      
          if($insertaddress){
                $message = array('status'=>'1', 'message'=>'Address Saved');
                return $message;
                            }		
          else{
                 $message = array('status'=>'0', 'message'=>'something went wrong');
	            return $message;
    	}  
     }  
     
      public function area_city_charges(Request $request)
    {
    $user_id = $request->user_id;
    $vendor_id = $request->vendor_id;
    
  $vendor = DB::table('vendor')
      ->where('vendor_id', $vendor_id)
      ->first();

       
    $address = DB::table('user_address')
         ->leftjoin('area','user_address.area_id', '=','area.area_id')
         ->leftjoin('vendor_area','area.area_id', '=','vendor_area.area_id')
         ->where('user_address.user_id',$user_id)
         ->where('user_address.select_status','!=',2)
         ->where('vendor_area.vendor_id',$vendor_id)
         ->get();
    
	 
         
    if(count($address)>0){
     $message = array('status'=>'1', 'message'=>'Address list','data'=>$address);
                return $message;
                            }		
          else{
                 $message = array('status'=>'0', 'message'=>'Address not found! Add Address', 'data'=>[]);
	            return $message;
    	}    
     }
      
       public function address_selection(Request $request)
    {
  
    $vendor_id = $request->vendor_id;
    $user_id = $request->user_id;
    
    $app1 = DB::table('user_address')
            ->join('vendor_area','user_address.area_id','=','vendor_area.area_id')
            ->select('user_address.address_id','user_address.city_id','user_address.area_id','user_address.address','user_address.lat','user_address.lng','user_address.user_name','user_address.user_number','user_address.select_status','user_address.houseno','user_address.pincode','user_address.state','user_address.type','vendor_area.delivery_charge')
            ->groupBy('user_address.address_id','user_address.city_id','user_address.area_id','user_address.address','user_address.lat','user_address.lng','user_address.user_name','user_address.user_number','user_address.select_status','user_address.houseno','user_address.pincode','user_address.state','user_address.type','vendor_area.delivery_charge')
            ->where('user_address.user_id',$user_id)
            ->where('user_address.select_status','1')
            ->where('vendor_area.vendor_id', $vendor_id)
            ->get();
           
           
           
           if(count($app1)>0){
                             $message = array('status'=>'1', 'message'=>'Addess Selected','data'=>$app1);
        	                    return $message;              
                  }
        else{
          	$message = array('status'=>'0', 'message'=>'Address Not Found Please Add Address.');
        	return $message;
        }
        return $data; 
    
    }
}







