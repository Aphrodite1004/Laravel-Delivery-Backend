<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AddressController extends Controller
{
    public function address(Request $request)
    {
            $user_number = $request->user_number;
            $user_name = $request->user_name;
            $user_id = $request->user_id;
            $city_id = $request->city_id;
            $area_id = $request->area_id;
            $house_no = $request->house_no;
            $street = $request->street;
            $vendor_id = $request->vendor_id;
            $city = DB::table('city')
            ->select('city_name')
            ->where('city_id', $city_id)
            ->first();
            $area = DB::table('area')
            ->select('area_name')
            ->where('area_id', $area_id)
            ->where('vendor_id', $vendor_id) 
            ->first();
            $area_name = $area->area_name;
            $city_name = $city->city_name;
            $state = $request->state;
            $pin = $request->pin;
            $address = $house_no .",".  $street .",".  $area_name .",".  $city_name .",".  $state .",". $pin; 
            $addres = str_replace(" ", "+", $address);
            $address1 = str_replace("-", "+", $addres);
        

        $response = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$address1."&key=AIzaSyA-l9tSWxeB-Glu5orDFikU07bw83E4RSQ"));

      
        
        
        // return var_dump($response);
         $lat = $response->results[0]->geometry->location->lat;
         $lng = $response->results[0]->geometry->location->lng;
    	    $insertaddress = DB::table('user_address')
    						->insert([
    							'user_id'=>$user_id,
    							'user_name'=>$user_name,
    							'user_number'=>$user_number,
    							'city_id'=>$city_id,
    							'area_id'=>$area_id,
    							'address'=>$address,
    							'lat' => $lat,
    							'lng' => $lng
                            ]);
                            
          if($insertaddress){
                $message = array('status'=>'1', 'message'=>'Address Inserted');
                return $message;
                            }		
          else{
                 $message = array('status'=>'0', 'message'=>'something went wrong');
	            return $message;
    	}
      }
      
      
      public function editaddress(Request $request)
    {
        
            $user_number = $request->user_number;
            $user_name = $request->user_name;
            $address_id = $request->address_id;
            $user_id = $request->user_id;
            $city_id = $request->city_id;
            $area_id = $request->area_id;
            $house_no = $request->house_no;
            $street = $request->street;
            $vendor_id = $request->vendor_id;
            $city = DB::table('city')
            ->select('city_name')
            ->where('city_id', $city_id)
            ->first();
            $area = DB::table('area')
            ->select('area_name')
            ->where('area_id', $area_id)
            ->where('vendor_id', $vendor_id) 
            ->first();
            $area_name = $area->area_name;
            $city_name = $city->city_name;
            $state = $request->state;
            $pin = $request->pin;
            $address = $house_no .",".  $street .",".  $area_name .",".  $city_name .",".  $state .",". $pin; 
            $addres = str_replace(" ", "+", $address);
            $address1 = str_replace("-", "+", $addres);
        

        $response = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$address1."&key=AIzaSyA-l9tSWxeB-Glu5orDFikU07bw83E4RSQ"));

     
        
         $lat = $response->results[0]->geometry->location->lat;
         $lng = $response->results[0]->geometry->location->lng;
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
    							'lng' => $lng
                            ]);
                            
           if($insertaddress){
                $message = array('status'=>'1', 'message'=>'Address updated');
                return $message;
                            }		
           else{
                 $message = array('status'=>'0', 'message'=>'something went wrong');
	            return $message;
    	}
      } 
      
      
    public function showaddress(Request $request)
    {
            $user_id = $request->user_id;
           
            $address = DB::table('user_address')
            ->where('user_id', $user_id)
            ->get();
            if($address){
                $message = array('status'=>'1', 'message'=>'data found', 'data'=>$address);
                return $message;
                            }		
           else{
                 $message = array('status'=>'0', 'message'=>'data not found');
	            return $message;
    	}
    }
    
    
    public function DeleteUserAddress(Request $request)
    {
        $address_id=$request->address_id;
        $dalete = DB::table('user_address')->where('address_id',$address_id)->delete();
        
        if($dalete)
        {
            $message = array('status'=>'1', 'message'=>'Address Delete Successfully');
        }
        else
        {
            $message = array('status'=>'0', 'message'=>'Something Wents Wrong');
        }
        return $message;
    }
      
    }
