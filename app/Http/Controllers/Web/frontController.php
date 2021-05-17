<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Service;
use Session;
use Hash;
use Auth;
use App\User;
use Carbon\Carbon;


class frontController extends Controller
{
    public function index(Request $request){
      $data = Service::get();
      $serviceinfo = DB::table("vendor_category")->where('ui_type','=',1)->first();
      $id   = $serviceinfo->vendor_category_id;
      $shopdata = DB::table("vendor_category")
      ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
      ->where('vendor_category.ui_type','=',1)
      ->get();
      $map1 = DB::table('map_API')
      ->first();
  $map = $map1->map_api_key;     
  $mapset = DB::table('map_settings')
         ->first();
  $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
        return view('web.groceryindex',['services' => $data,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);    
  }

    public function groceryshoplistSearch(Request $request){
    
    $data = Service::get();
    $shopdata = DB::table("vendor_category")
    ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
    ->where('vendor_category.ui_type','=',1)
    ->get();

    $id = $request->shop_id; 
    $address = $request->shop_name;

    $addres = str_replace(" ", "+", $address);
    $address1 = str_replace("-", "+", $addres);
    $mapset= DB::table('map_settings')
        ->first();
    $checkmap = DB::table('map_API')
        ->first();
    
    if($mapset->mapbox == 0 && $mapset->google_map == 1){        
        $response = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$address1."&key=".$checkmap->map_api_key));
        
         $lat = $response->results[0]->geometry->location->lat;
         $lng = $response->results[0]->geometry->location->lng;
        }
        else{
           $lat = $request->lat;
           $lng = $request->lng;  
        }


    $groupApp = DB::table("vendor")
 
    ->select("vendor.vendor_name","vendor.vendor_phone","vendor.vendor_id","vendor.vendor_logo","vendor.vendor_category_id","vendor.lat","vendor.lng","vendor.delivery_range","vendor.online_status","vendor.opening_time","vendor.closing_time","vendor.ui_type","vendor.about","vendor.vendor_loc"
      ,DB::raw("6371 * acos(cos(radians(".$lat . ")) 
      * cos(radians(lat)) 
      * cos(radians(lng) - radians(" . $lng . ")) 
      + sin(radians(" .$lat. ")) 
      * sin(radians(lat))) AS distance"))
      ->orderBy('distance')
      ->where('vendor_category_id',$id)
      ->get();
      $storelist = NULL;
      foreach($groupApp as $store)
      {
          if($store->delivery_range > $store->distance){
              $storelist[] = $store; 
          }
      }

      $map1 = DB::table('map_API')
      ->first();
  $map = $map1->map_api_key;     
  $mapset = DB::table('map_settings')
         ->first();
  $mapbox = DB::table('mapbox')
          ->first();

    
      return view('web.groceryindex',['services' => $data,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);    
   
}

    public function restaurantindex(Request $request){
        $data = Service::get();
        $serviceinfo = DB::table("vendor_category")->where('ui_type','=',2)->first();
    
        $id   = $serviceinfo->vendor_category_id;
        $shopdata = DB::table("vendor_category")
      ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
      ->where('vendor_category.ui_type','=',3)
      ->get();
        $map1 = DB::table('map_API')
        ->first();
        $map = $map1->map_api_key;     
        $mapset = DB::table('map_settings')
           ->first();
        $mapbox = DB::table('mapbox')
            ->first();
            $storelist = NULL;
    return view('web.restaurantindex',['services' => $data,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);    
   
}
    public function restaurantshoplistSearch(Request $request){
   
  $data = Service::get();
  $shopdata = DB::table("vendor_category")
  ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
  ->where('vendor_category.ui_type','=',2)
  ->get();

  $id = $request->shop_id; 
  $address = $request->shop_name;

  $addres = str_replace(" ", "+", $address);
  $address1 = str_replace("-", "+", $addres);
  $mapset= DB::table('map_settings')
      ->first();
  $checkmap = DB::table('map_API')
      ->first();
  
  if($mapset->mapbox == 0 && $mapset->google_map == 1){        
      $response = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$address1."&key=".$checkmap->map_api_key));
      
       $lat = $response->results[0]->geometry->location->lat;
       $lng = $response->results[0]->geometry->location->lng;
      }
      else{
         $lat = $request->lat;
         $lng = $request->lng;  
      }


  $groupApp = DB::table("vendor")

  ->select("vendor.vendor_name","vendor.vendor_phone","vendor.vendor_id","vendor.vendor_logo","vendor.vendor_category_id","vendor.lat","vendor.lng","vendor.delivery_range","vendor.online_status","vendor.opening_time","vendor.closing_time","vendor.ui_type","vendor.about","vendor.vendor_loc"
    ,DB::raw("6371 * acos(cos(radians(".$lat . ")) 
    * cos(radians(lat)) 
    * cos(radians(lng) - radians(" . $lng . ")) 
    + sin(radians(" .$lat. ")) 
    * sin(radians(lat))) AS distance"))
    ->orderBy('distance')
    ->where('vendor_category_id',$id)
    ->get();
    $storelist = NULL;
    foreach($groupApp as $store)
    {
        if($store->delivery_range > $store->distance){
            $storelist[] = $store; 
        }
    }

    $map1 = DB::table('map_API')
    ->first();
$map = $map1->map_api_key;     
$mapset = DB::table('map_settings')
       ->first();
$mapbox = DB::table('mapbox')
        ->first();

  
    return view('web.restaurantindex',['services' => $data,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);    
 
}
    public function pharmacyindex(Request $request){
  $data = Service::get();
  $serviceinfo = DB::table("vendor_category")->where('ui_type','=',3)->first();
  $id   = $serviceinfo->vendor_category_id;
  $shopdata = DB::table("vendor_category")
  ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
  ->where('vendor_category.ui_type','=',3)
  ->get();
 $map1 = DB::table('map_API')
    ->first();
$map = $map1->map_api_key;     
$mapset = DB::table('map_settings')
       ->first();
$mapbox = DB::table('mapbox')
        ->first();
        $storelist = NULL;
    return view('web.pharmacyindex',['services' => $data,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);    
   
}
    public function pharmacyshoplistSearch(Request $request){
    
  $data = Service::get();
  $shopdata = DB::table("vendor_category")
  ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
  ->where('vendor_category.ui_type','=',3)
  ->get();

  $id = $request->shop_id; 
  $address = $request->shop_name;

  $addres = str_replace(" ", "+", $address);
  $address1 = str_replace("-", "+", $addres);
  $mapset= DB::table('map_settings')
      ->first();
  $checkmap = DB::table('map_API')
      ->first();
  
  if($mapset->mapbox == 0 && $mapset->google_map == 1){        
      $response = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$address1."&key=".$checkmap->map_api_key));
     
       $lat = $response->results[0]->geometry->location->lat;
       $lng = $response->results[0]->geometry->location->lng;
      }
      else{
         $lat = $request->lat;
         $lng = $request->lng;  
      }


  $groupApp = DB::table("vendor")

  ->select("vendor.vendor_name","vendor.vendor_phone","vendor.vendor_id","vendor.vendor_logo","vendor.vendor_category_id","vendor.lat","vendor.lng","vendor.delivery_range","vendor.online_status","vendor.opening_time","vendor.closing_time","vendor.ui_type","vendor.about","vendor.vendor_loc"
    ,DB::raw("6371 * acos(cos(radians(".$lat . ")) 
    * cos(radians(lat)) 
    * cos(radians(lng) - radians(" . $lng . ")) 
    + sin(radians(" .$lat. ")) 
    * sin(radians(lat))) AS distance"))
    ->orderBy('distance')
    ->where('vendor_category_id',$id)
    ->get();
    $storelist = NULL;
    foreach($groupApp as $store)
    {
        if($store->delivery_range > $store->distance){
            $storelist[] = $store; 
        }
    }

    $map1 = DB::table('map_API')
    ->first();
$map = $map1->map_api_key;     
$mapset = DB::table('map_settings')
       ->first();
$mapbox = DB::table('mapbox')
        ->first();

  
    return view('web.pharmacyindex',['services' => $data,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);    
 
}
    public function parcalindex(Request $request){
  $data = Service::get();
  $serviceinfo = DB::table("vendor_category")->where('ui_type','=',4)->first();
  $id   = $serviceinfo->vendor_category_id;
  $shopdata = DB::table("vendor_category")
  ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
  ->where('vendor_category.ui_type','=',4)
  ->get();
 $map1 = DB::table('map_API')
    ->first();
$map = $map1->map_api_key;     
$mapset = DB::table('map_settings')
       ->first();
$mapbox = DB::table('mapbox')
        ->first();
        $storelist = NULL;
    return view('web.parcalindex',['services' => $data,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);    
   
}
    public function parcalshoplistSearch(Request $request){
    
  $data = Service::get();
  $shopdata = DB::table("vendor_category")
  ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
  ->where('vendor_category.ui_type','=',4)
  ->get();

  $id = $request->shop_id; 
  $address = $request->shop_name;

  $addres = str_replace(" ", "+", $address);
  $address1 = str_replace("-", "+", $addres);
  $mapset= DB::table('map_settings')
      ->first();
  $checkmap = DB::table('map_API')
      ->first();
  
  if($mapset->mapbox == 0 && $mapset->google_map == 1){        
      $response = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$address1."&key=".$checkmap->map_api_key));
      
       $lat = $response->results[0]->geometry->location->lat;
       $lng = $response->results[0]->geometry->location->lng;
      }
      else{
         $lat = $request->lat;
         $lng = $request->lng;  
      }


  $groupApp = DB::table("vendor")

  ->select("vendor.vendor_name","vendor.vendor_phone","vendor.vendor_id","vendor.vendor_logo","vendor.vendor_category_id","vendor.lat","vendor.lng","vendor.delivery_range","vendor.online_status","vendor.opening_time","vendor.closing_time","vendor.ui_type","vendor.about","vendor.vendor_loc"
    ,DB::raw("6371 * acos(cos(radians(".$lat . ")) 
    * cos(radians(lat)) 
    * cos(radians(lng) - radians(" . $lng . ")) 
    + sin(radians(" .$lat. ")) 
    * sin(radians(lat))) AS distance"))
    ->orderBy('distance')
    ->where('vendor_category_id',$id)
    ->get();
    $storelist = NULL;
    foreach($groupApp as $store)
    {
        if($store->delivery_range > $store->distance){
            $storelist[] = $store; 
        }
    }

    $map1 = DB::table('map_API')
    ->first();
$map = $map1->map_api_key;     
$mapset = DB::table('map_settings')
       ->first();
$mapbox = DB::table('mapbox')
        ->first();

  
    return view('web.parcalindex',['services' => $data,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);    
 
}


    public function grocerylogin(){
        return view('web.grocerylogin');
    }
    public function pharmacylogin(){
        return view('web.pharmacylogin');
    }
    public function grocerysignup(){
        return view('web.grocerysignup');
    }
    public function pharmacysignup(){
        return view('web.pharmacysignup');
    }
    public function resturantsignup(){
        return view('web.restuarnatsignup');
    }
    
    public function parcelwebsignup(){
        return view('web.parcelwebsignup');
    }
    
    public function resturantweblogin()
    {
         return view('web.resturantlogin');
    }
    
     public function parcelweblogin()
    {
         return view('web.parcellogin');
    }
    public function parcellogin(Request $request)
    {
    $user_phone = ltrim($request->mobile,'0');
    
    $user_password = $request->password;
    // $device_id = $request->device_id;
    
    $checkUserReg = DB::table('tbl_user')
            ->where('user_phone', $user_phone)
            ->first();
    if(empty($checkUserReg))
    {
          return response()->json(['error'=>'Phone not registered']);
    }
    if($checkUserReg->phone_verified == 0){
    
      return response()->json(['error'=>'Phone not verify']);
    }
              
    $checkUser = DB::table('tbl_user')
            ->where('user_phone', $user_phone)
            ->where('user_password', $user_password)
            ->first();

    if($checkUser){
        
        if($checkUser->phone_verified == 0){
            $chars = "0123456789";
              $otpval = "";
              for ($i = 0; $i < 4; $i++){
                  $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
              }
              
             $otpmsg = $this->otpmsg($otpval,$user_phone);
             
              $updateOtp = DB::table('tbl_user')
                              ->where('user_phone', $user_phone)
                              ->update(['otp_value'=>$otpval]);
                              
              $checkUser1 = DB::table('tbl_user')
                    ->where('user_phone', $user_phone)
                    ->first();                
              return response()->json(['success'=>'Verify Phone']);        
            
        }
       else{
         // $updateDeviceId = DB::table('users')
         //                      ->where('user_phone', $user_phone)
         //                      ->update(['device_id'=>$device_id]);
                             
         $checkUser1 = DB::table('tbl_user')
                    ->where('user_phone', $user_phone)
                    ->where('user_password', $user_password)
                    ->first();
              $sessiondata = array(
                                      'userid' => $checkUser1->user_id,
                                      'name'   => $checkUser1->user_name,
                                      'email'  => $checkUser1->user_email
                                  );
          $request->session()->put($sessiondata); 
        //   return response()->json(['success'=>'login successfully']);  
                  
        return redirect('/parcalindex');
        
       }	   
    
    }
    else{
      return redirect()->back()->withErrors("something wents wrong.");
      
    }
  }
    public function resturantlogin(Request $request)
    {
    $user_phone = ltrim($request->mobile,'0');
    
    $user_password = $request->password;
    // $device_id = $request->device_id;
    
    $checkUserReg = DB::table('tbl_user')
            ->where('user_phone', $user_phone)
            ->first();
    if(empty($checkUserReg))
    {
          return response()->json(['error'=>'Phone not registered']);
    }
    if($checkUserReg->phone_verified == 0){
    
      return response()->json(['error'=>'Phone not verify']);
    }
              
    $checkUser = DB::table('tbl_user')
            ->where('user_phone', $user_phone)
            ->where('user_password', $user_password)
            ->first();

    if($checkUser){
        
        if($checkUser->phone_verified == 0){
            $chars = "0123456789";
              $otpval = "";
              for ($i = 0; $i < 4; $i++){
                  $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
              }
              
             $otpmsg = $this->otpmsg($otpval,$user_phone);
             
              $updateOtp = DB::table('tbl_user')
                              ->where('user_phone', $user_phone)
                              ->update(['otp_value'=>$otpval]);
                              
              $checkUser1 = DB::table('tbl_user')
                    ->where('user_phone', $user_phone)
                    ->first();                
              return response()->json(['success'=>'Verify Phone']);        
            
        }
       else{
         // $updateDeviceId = DB::table('users')
         //                      ->where('user_phone', $user_phone)
         //                      ->update(['device_id'=>$device_id]);
                             
         $checkUser1 = DB::table('tbl_user')
                    ->where('user_phone', $user_phone)
                    ->where('user_password', $user_password)
                    ->first();
              $sessiondata = array(
                                      'userid' => $checkUser1->user_id,
                                      'name'   => $checkUser1->user_name,
                                      'email'  => $checkUser1->user_email
                                  );
          $request->session()->put($sessiondata); 
        //   return response()->json(['success'=>'login successfully']);  
                  
        return redirect('/restaurantindex');
        
       }	   
    
    }
    else{
      return redirect()->back()->withErrors("something wents wrong.");
      
    }
  }
    public function groceryweblogin(Request $request)
    {
    $user_phone = ltrim($request->mobile,'0');
    
    $user_password = $request->password;
    // $device_id = $request->device_id;
    
    $checkUserReg = DB::table('tbl_user')
            ->where('user_phone', $user_phone)
            ->first();
    if(empty($checkUserReg))
    {
          return response()->json(['error'=>'Phone not registered']);
    }
    if($checkUserReg->phone_verified == 0){
    
      return response()->json(['error'=>'Phone not verify']);
    }
              
    $checkUser = DB::table('tbl_user')
            ->where('user_phone', $user_phone)
            ->where('user_password', $user_password)
            ->first();

    if($checkUser){
        
        if($checkUser->phone_verified == 0){
            $chars = "0123456789";
              $otpval = "";
              for ($i = 0; $i < 4; $i++){
                  $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
              }
              
             $otpmsg = $this->otpmsg($otpval,$user_phone);
             
              $updateOtp = DB::table('tbl_user')
                              ->where('user_phone', $user_phone)
                              ->update(['otp_value'=>$otpval]);
                              
              $checkUser1 = DB::table('tbl_user')
                    ->where('user_phone', $user_phone)
                    ->first();                
              return response()->json(['success'=>'Verify Phone']);        
            
        }
       else{
         // $updateDeviceId = DB::table('users')
         //                      ->where('user_phone', $user_phone)
         //                      ->update(['device_id'=>$device_id]);
                             
         $checkUser1 = DB::table('tbl_user')
                    ->where('user_phone', $user_phone)
                    ->where('user_password', $user_password)
                    ->first();
              $sessiondata = array(
                                      'userid' => $checkUser1->user_id,
                                      'name'   => $checkUser1->user_name,
                                      'email'  => $checkUser1->user_email
                                  );
          $request->session()->put($sessiondata); 
        //   return response()->json(['success'=>'login successfully']);  
                  
        return redirect('/');
        
       }	   
    
    }
    else{
      return redirect()->back()->withErrors("something wents wrong.");
      
    }
  }

    public function pharmacyweblogin(Request $request)
    {
    $user_phone = ltrim($request->mobile,'0');
    
    $user_password = $request->password;
    // $device_id = $request->device_id;
    
    $checkUserReg = DB::table('tbl_user')
            ->where('user_phone', $user_phone)
            ->first();
    if(empty($checkUserReg))
    {
          return response()->json(['error'=>'Phone not registered']);
    }
    if($checkUserReg->phone_verified == 0){
    
      return response()->json(['error'=>'Phone not verify']);
    }
              
    $checkUser = DB::table('tbl_user')
            ->where('user_phone', $user_phone)
            ->where('user_password', $user_password)
            ->first();

    if($checkUser){
        
        if($checkUser->phone_verified == 0){
            $chars = "0123456789";
              $otpval = "";
              for ($i = 0; $i < 4; $i++){
                  $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
              }
              
             $otpmsg = $this->otpmsg($otpval,$user_phone);
             
              $updateOtp = DB::table('tbl_user')
                              ->where('user_phone', $user_phone)
                              ->update(['otp_value'=>$otpval]);
                              
              $checkUser1 = DB::table('tbl_user')
                    ->where('user_phone', $user_phone)
                    ->first();                
              return response()->json(['success'=>'Verify Phone']);        
            
        }
       else{
         // $updateDeviceId = DB::table('users')
         //                      ->where('user_phone', $user_phone)
         //                      ->update(['device_id'=>$device_id]);
                             
         $checkUser1 = DB::table('tbl_user')
                    ->where('user_phone', $user_phone)
                    ->where('user_password', $user_password)
                    ->first();
              $sessiondata = array(
                                      'userid' => $checkUser1->user_id,
                                      'name'   => $checkUser1->user_name,
                                      'email'  => $checkUser1->user_email
                                  );
          $request->session()->put($sessiondata); 
        //   return response()->json(['success'=>'login successfully']);  
                  
        return redirect('/pharmacyindex');
        
       }	   
    
    }
    else{
      return redirect()->back()->withErrors("something wents wrong.");
      
    }
  }


  public function grocerywebsignup(Request $request)
  {

    $existmobile = DB::table('tbl_user')
        ->where('user_phone',ltrim($request->mobile,'0'))
        ->first();

    if(!empty($existmobile))
    {
      return redirect()->back()->withErrors(["User Allready Exists"]);
      
    }else{
      
      $device_id = 'N/A';
      $userimage = 'N/A';
      $newarray = array(
                'user_name'		=> $request->name,
                'user_email'	=> $request->email,
                'user_phone'	=> ltrim($request->mobile,'0'),
                'user_image'	=> $userimage,
                'user_password' => $request->password,
                'device_id'		=> $device_id
              );
      $insertdata = DB::table('tbl_user')->insertGetId($newarray);
      if($insertdata)
      {
        DB::table('notificationby')
                          ->insert(['user_id'=> $insertdata,
                          'sms'=> '1',
                          'app'=> '1',
                          'email'=> '1']);
                          
              $smsby = DB::table('smsby')
              ->first();  
              if($smsby->status== 1)
              {        
                $chars = "0123456789";
                $otpval = "";
                for ($i = 0; $i < 4; $i++){
                    $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
                }
                
                
               // $otpmsg = $this->otpmsg($otpval,ltrim($request->mobile,'0'));
                
                $updateOtp = DB::table('tbl_user')
                                ->where('user_phone', ltrim($request->mobile,'0'))
                                ->update(['otp'=>$otpval]);
                                
                //return response()->json(['success'=>'Registration Done Successfully.Please Verify Your Mobile','code'=>1]);
                return redirect('/');

            }else
            {
              //return response()->json(['success'=>'Registration Done Successfully','code'=>0]);
              return redirect('/');

            }
            
      }else
      {
        return redirect()->back()->withErrors("something wents wrong.");        
      }
    }
  }
  public function pharmacywebsignup(Request $request)
  {

    $existmobile = DB::table('tbl_user')
        ->where('user_phone',ltrim($request->mobile,'0'))
        ->first();

    if(!empty($existmobile))
    {
      return redirect()->back()->withErrors(["User Allready Exists"]);
      
    }else{
      
      $device_id = 'N/A';
      $userimage = 'N/A';
      $newarray = array(
                'user_name'		=> $request->name,
                'user_email'	=> $request->email,
                'user_phone'	=> ltrim($request->mobile,'0'),
                'user_image'	=> $userimage,
                'user_password' => $request->password,
                'device_id'		=> $device_id
              );
      $insertdata = DB::table('tbl_user')->insertGetId($newarray);
      if($insertdata)
      {
        DB::table('notificationby')
                          ->insert(['user_id'=> $insertdata,
                          'sms'=> '1',
                          'app'=> '1',
                          'email'=> '1']);
                          
              $smsby = DB::table('smsby')
              ->first();  
              if($smsby->status== 1)
              {        
                $chars = "0123456789";
                $otpval = "";
                for ($i = 0; $i < 4; $i++){
                    $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
                }
                
                
               // $otpmsg = $this->otpmsg($otpval,ltrim($request->mobile,'0'));
                
                $updateOtp = DB::table('tbl_user')
                                ->where('user_phone', ltrim($request->mobile,'0'))
                                ->update(['otp'=>$otpval]);
                                
                //return response()->json(['success'=>'Registration Done Successfully.Please Verify Your Mobile','code'=>1]);
                return redirect('/pharmacyindex');

            }else
            {
              //return response()->json(['success'=>'Registration Done Successfully','code'=>0]);
              return redirect('/pharmacyindex');

            }
            
      }else
      {
        return redirect()->back()->withErrors("something wents wrong.");        
      }
    }
  }
  public function resturantwebsignup(Request $request)
  {
    $existmobile = DB::table('tbl_user')
        ->where('user_phone',ltrim($request->mobile,'0'))
        ->first();

    if(!empty($existmobile))
    {
      return redirect()->back()->withErrors(["User Allready Exists"]);
      
    }else{
      
      $device_id = 'N/A';
      $userimage = 'N/A';
      $newarray = array(
                'user_name'		=> $request->name,
                'user_email'	=> $request->email,
                'user_phone'	=> ltrim($request->mobile,'0'),
                'user_image'	=> $userimage,
                'user_password' => $request->password,
                'device_id'		=> $device_id
              );
      $insertdata = DB::table('tbl_user')->insertGetId($newarray);
      if($insertdata)
      {
        DB::table('notificationby')
                          ->insert(['user_id'=> $insertdata,
                          'sms'=> '1',
                          'app'=> '1',
                          'email'=> '1']);
                          
              $smsby = DB::table('smsby')
              ->first();  
              if($smsby->status== 1)
              {        
                $chars = "0123456789";
                $otpval = "";
                for ($i = 0; $i < 4; $i++){
                    $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
                }
                
                
               // $otpmsg = $this->otpmsg($otpval,ltrim($request->mobile,'0'));
                
                $updateOtp = DB::table('tbl_user')
                                ->where('user_phone', ltrim($request->mobile,'0'))
                                ->update(['otp'=>$otpval]);
                                
                //return response()->json(['success'=>'Registration Done Successfully.Please Verify Your Mobile','code'=>1]);
                
                return redirect()->back()->with(['success'=>'Registration Done Successfully.Please Verify Your Mobile','code'=>1]);

            }else
            {
              //return response()->json(['success'=>'Registration Done Successfully','code'=>0]);
             
              return redirect()->back()->with(['success'=>'Registration Done Successfully.','code'=>1]);

            }
            
      }else
      {
        return redirect()->back()->withErrors("something wents wrong.");        
      }
    }
  }
  public function parcelsignup(Request $request)
  {
    $existmobile = DB::table('tbl_user')
        ->where('user_phone',ltrim($request->mobile,'0'))
        ->first();

    if(!empty($existmobile))
    {
      return redirect()->back()->withErrors(["User Allready Exists"]);
      
    }else{
      
      $device_id = 'N/A';
      $userimage = 'N/A';
      $newarray = array(
                'user_name'		=> $request->name,
                'user_email'	=> $request->email,
                'user_phone'	=> ltrim($request->mobile,'0'),
                'user_image'	=> $userimage,
                'user_password' => $request->password,
                'device_id'		=> $device_id
              );
      $insertdata = DB::table('tbl_user')->insertGetId($newarray);
      if($insertdata)
      {
        DB::table('notificationby')
                          ->insert(['user_id'=> $insertdata,
                          'sms'=> '1',
                          'app'=> '1',
                          'email'=> '1']);
                          
              $smsby = DB::table('smsby')
              ->first();  
              if($smsby->status== 1)
              {        
                $chars = "0123456789";
                $otpval = "";
                for ($i = 0; $i < 4; $i++){
                    $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
                }
                
                
               // $otpmsg = $this->otpmsg($otpval,ltrim($request->mobile,'0'));
                
                $updateOtp = DB::table('tbl_user')
                                ->where('user_phone', ltrim($request->mobile,'0'))
                                ->update(['otp'=>$otpval]);
                                
                //return response()->json(['success'=>'Registration Done Successfully.Please Verify Your Mobile','code'=>1]);
                
                return redirect()->back()->with(['success'=>'Registration Done Successfully.Please Verify Your Mobile','code'=>1]);

            }else
            {
              //return response()->json(['success'=>'Registration Done Successfully','code'=>0]);
             
              return redirect()->back()->with(['success'=>'Registration Done Successfully.','code'=>1]);

            }
            
      }else
      {
        return redirect()->back()->withErrors("something wents wrong.");        
      }
    }
  }
  public function webotpverify(Request $request)
  {
   
      $data = DB::table('tbl_user')->where(array('user_phone' => ltrim($request->mobile,'0'),'otp' => $request->verifyotpmobnew))->first();
      if(!empty($data))
      {
          $update = DB::table('tbl_user')->where(array('user_id' => $data->user_id))->update(array('phone_verified'=> 1));
          return response()->json(['success'=>'OTP Verify Successfully.']);
      }
      else
      {
          return response()->json(['error'=>'OTP Not Match']);
      }
      print_r($request->mobile);
      print_r($request->verifyotpmobnew);
      
  }
  public function weblogout(Request $request){
    $info = array(
      'userid' =>'',
      'name'    => '',
      'email'   => '',
);
$request->session()->put($info);
    return redirect('/');
}



public function getforgotpassword(){
    return view('web.forgot');
}

public function parcelforgotpassword(){
    return view('web.parcelforgotpassword');
}


public function groceryforgotpassword(){
  return view('web.groceryforgot');
}
public function pharmacyforgotpassword(){
  return view('web.pharmacyforgot');
}
public function resturantforgotpassword(){
  return view('web.resturantforgotpassword');
}
public function grocerywebforgotpassword(Request $request)
{
  $user_phone=$request->mobile;
  $checkUser = DB::table('tbl_user')
  ->where('user_phone', $user_phone)
  ->first();
  if($checkUser){
    $chars = "0123456789";
    $otpval = "0000";
    // for ($i = 0; $i < 4; $i++){
    //     $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
    // }
           
   // $otpmsg = $this->otpmsg($otpval,ltrim($request->mobile,'0'));
    
        $updateotp = DB::table('tbl_user')->where(array('user_phone' => ltrim($request->mobile,'0')))->update(array('otp' => $otpval));
        if($updateotp){
                    
       return view('web.groceryotp',['user_phone' => $user_phone]); 
        }
        else{ 
        return redirect()->back()->withErrors("Something wrong");

        }
      }                
      else{
        return redirect()->back()->withErrors("User not registered");

      } 
}

public function resturantwebforgotpassword(Request $request)
{
  $user_phone=$request->mobile;
  $checkUser = DB::table('tbl_user')
  ->where('user_phone', $user_phone)
  ->first();
  if($checkUser){
    $chars = "0123456789";
    $otpval = "";
    for ($i = 0; $i < 4; $i++){
        $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
    }
           
   // $otpmsg = $this->otpmsg($otpval,ltrim($request->mobile,'0'));
    
        $updateotp = DB::table('tbl_user')->where(array('user_phone' => $request->mobile))->update(array('otp' => $otpval));
        if($updateotp){
                    
       return view('web.resturantotp',['user_phone' => $user_phone]); 
        }
        else{ 
        return redirect()->back()->withErrors("Something wrong");

        }
      }                
      else{
        return redirect()->back()->withErrors("User not registered");

      } 
}
public function parcelwebforgotpassword(Request $request)
{
  $user_phone=$request->mobile;
  $checkUser = DB::table('tbl_user')
  ->where('user_phone', $user_phone)
  ->first();
  if($checkUser){
    $chars = "0123456789";
    $otpval = "";
    for ($i = 0; $i < 4; $i++){
        $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
    }
           
   // $otpmsg = $this->otpmsg($otpval,ltrim($request->mobile,'0'));
    
        $updateotp = DB::table('tbl_user')->where(array('user_phone' => $request->mobile))->update(array('otp' => $otpval));
        if($updateotp){
                    
       return view('web.parcelotp',['user_phone' => $user_phone]); 
        }
        else{ 
        return redirect()->back()->withErrors("Something wrong");

        }
      }                
      else{
        return redirect()->back()->withErrors("User not registered");

      } 
}


    public function resturantotpverifyforgot(Request $request)
    {
        $user_phone = $request->user_phone;
     $otp = $request->otp;
     $getUser = DB::table('tbl_user')->where(array('user_phone' => ltrim($user_phone,'0'),'otp' => $otp))->first();
      if($getUser){
      $getotp = $getUser->otp;

      if($otp == $getotp){
        $updateOtp = DB::table('tbl_user')
                          ->where('user_phone', $user_phone)
                          ->update(['otp'=>null]);
        $checkUser1 = DB::table('tbl_user')
        ->where('user_phone', $user_phone)
        ->first();
         $sessiondata = array(
                              'userid' => $checkUser1->user_id,
                              'name'   => $checkUser1->user_name,
                              'email'  => $checkUser1->user_email
                          );
           $request->session()->put($sessiondata);
            return redirect('/restaurantindex');

      }
      else{
      return redirect()->back()->withErrors("Wrong OTP");

      }
      }
      else{
        return redirect()->back()->withErrors("User not registered");

      }
    }
    
    public function parcelotpverifyforgot(Request $request)
    {
        $user_phone = $request->user_phone;
     $otp = $request->otp;
     $getUser = DB::table('tbl_user')->where(array('user_phone' => ltrim($user_phone,'0'),'otp' => $otp))->first();
      if($getUser){
      $getotp = $getUser->otp;

      if($otp == $getotp){
        $updateOtp = DB::table('tbl_user')
                          ->where('user_phone', $user_phone)
                          ->update(['otp'=>null]);
        $checkUser1 = DB::table('tbl_user')
        ->where('user_phone', $user_phone)
        ->first();
         $sessiondata = array(
                              'userid' => $checkUser1->user_id,
                              'name'   => $checkUser1->user_name,
                              'email'  => $checkUser1->user_email
                          );
           $request->session()->put($sessiondata);
            return redirect('/parcalindex');

      }
      else{
      return redirect()->back()->withErrors("Wrong OTP");

      }
      }
      else{
        return redirect()->back()->withErrors("User not registered");

      }
    }

    public function pharmacywebforgotpassword(Request $request)
    {
  $user_phone=$request->mobile;
  $checkUser = DB::table('tbl_user')
  ->where('user_phone', $user_phone)
  ->first();
  if($checkUser){
    $chars = "0123456789";
    $otpval = "0000";
    
        $updateotp = DB::table('tbl_user')->where(array('user_phone' => ltrim($request->mobile,'0')))->update(array('otp' => $otpval));
        if($updateotp){
                    
       return view('web.pharmacyotp',['user_phone' => $user_phone]); 
        }
        else{ 
        return redirect()->back()->withErrors("Something wrong");

        }
      }                
      else{
        return redirect()->back()->withErrors("User not registered");

      } 
}
    public function groceryotpverifyforgot(Request $request)
    {  
     $user_phone = $request->user_phone;
     $otp = $request->otp;
     $getUser = DB::table('tbl_user')->where(array('user_phone' => ltrim($user_phone,'0'),'otp' => $otp))->first();
      if($getUser){
      $getotp = $getUser->otp;

      if($otp == $getotp){
        $updateOtp = DB::table('tbl_user')
                          ->where('user_phone', $user_phone)
                          ->update(['otp'=>null]);
        $checkUser1 = DB::table('tbl_user')
        ->where('user_phone', $user_phone)
        ->first();
     $sessiondata = array(
                          'userid' => $checkUser1->user_id,
                          'name'   => $checkUser1->user_name,
                          'email'  => $checkUser1->user_email
                      );
       $request->session()->put($sessiondata);
        return redirect('/');

      }
      else{
      return redirect()->back()->withErrors("Wrong OTP");

      }
      }
      else{
        return redirect()->back()->withErrors("User not registered");

      }
}
    public function pharmacyotpverifyforgot(Request $request)
    {  
     $user_phone = $request->user_phone;
     $otp = $request->otp;
     $getUser = DB::table('tbl_user')->where(array('user_phone' => ltrim($user_phone,'0'),'otp' => $otp))->first();
      if($getUser){
      $getotp = $getUser->otp;

      if($otp == $getotp){
        $updateOtp = DB::table('tbl_user')
                          ->where('user_phone', $user_phone)
                          ->update(['otp'=>null]);
        $checkUser1 = DB::table('tbl_user')
        ->where('user_phone', $user_phone)
        ->first();
     $sessiondata = array(
                          'userid' => $checkUser1->user_id,
                          'name'   => $checkUser1->user_name,
                          'email'  => $checkUser1->user_email
                      );
       $request->session()->put($sessiondata);
        return redirect('/pharmacyindex');

      }
      else{
      return redirect()->back()->withErrors("Wrong OTP");

      }
      }
      else{
        return redirect()->back()->withErrors("User not registered");

      }
}
    public function webforgotpassword(Request $request)
    {
   
    $chars = "0123456789";
    $otpval = "";
    for ($i = 0; $i < 4; $i++){
        $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
    }
           
   // $otpmsg = $this->otpmsg($otpval,ltrim($request->mobile,'0'));
    
        $updateotp = DB::table('tbl_user')->where(array('user_phone' => ltrim($request->mobile,'0')))->update(array('otp' => $otpval));
        return redirect()->back()->withErrors("send otp.");        
  
    }
    public function otpverifyforgotpassword(Request $request)
    {
        $checkotp = DB::table('tbl_user')->where(array('user_phone' => ltrim($request->mobile,'0'),'otp' => $request->otp))->first();
       
        if($checkotp != '')
        {
            echo 1;
        }else
        {
            echo 0;
        }
    }
    public function webupdatepassword(Request $request)
    {
        $updatepassword = DB::table('tbl_user')->where(array('user_phone' => ltrim($request->mobile,'0')))->update(array('user_password' => $request->newpassword));
        
            echo 1;
        
    }
    public function groceryprofile(Request $request)
    {
      $serviceinfo = DB::table("vendor_category")->where('ui_type','=',1)->first();;
      $id   = $serviceinfo->vendor_category_id;
      $shopdata = DB::table("vendor_category")
      ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
      ->where('vendor_category.ui_type','=',1)
      ->get();
      $map1 = DB::table('map_API')
      ->first();
      $map = $map1->map_api_key;     
      $mapset = DB::table('map_settings')
         ->first();
       $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
      $profile = DB::table('tbl_user')->where(array('user_id' => session('userid')))->first();
      $orders = DB::table('orders')->where(array('user_id' => session('userid')))->get();
      $activeorder = DB::table('orders')->where('order_status','!=', 'Cancelled')->where(array('user_id' => session('userid')))->get();
       $address = DB::table('user_address')->where(array('user_id' => session('userid')))->get();
       $ordercancel = DB::table('cancel_for')->get();
       $data = Service::get();
       $termcondition = DB::table('termcondition')->where('id','4')->get();
       $about = DB::table('termcondition')->where('id','6')->get();
      return view('web.groceryprofile',['profile' => $profile,'termcondition'=>$termcondition,'about'=>$about,'orders' => $orders,'activeorder' => $activeorder,'wallet' => $profile->wallet_credits , 'reward' => $profile->rewards,'address' => $address,'ordercancel' => $ordercancel,'services' => $data,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    }
    
    public function resturantprofile(Request $request)
    {
      $serviceinfo = DB::table("vendor_category")->where('ui_type','=',2)->first();;
      $id   = $serviceinfo->vendor_category_id;
      $shopdata = DB::table("vendor_category")
      ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
      ->where('vendor_category.ui_type','=',2)
      ->get();
      $map1 = DB::table('map_API')
      ->first();
      $map = $map1->map_api_key;     
      $mapset = DB::table('map_settings')
         ->first();
       $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
      $profile = DB::table('tbl_user')->where(array('user_id' => session('userid')))->first();
      $orders = DB::table('orders')->where(array('user_id' => session('userid')))->get();
      $activeorder = DB::table('orders')->where('order_status','!=', 'Cancelled')->where(array('user_id' => session('userid')))->get();
       $address = DB::table('user_address')->where(array('user_id' => session('userid')))->get();
       $ordercancel = DB::table('cancel_for')->get();
       $data = Service::get();
       $termcondition = DB::table('termcondition')->where('id','4')->get();
       $about = DB::table('termcondition')->where('id','6')->get();
      return view('web.resturantprofile',['profile' => $profile,'termcondition'=>$termcondition,'about'=>$about,'orders' => $orders,'activeorder' => $activeorder,'wallet' => $profile->wallet_credits , 'reward' => $profile->rewards,'address' => $address,'ordercancel' => $ordercancel,'services' => $data,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    }
    
    public function parcelprofile(Request $request)
    {
      $serviceinfo = DB::table("vendor_category")->where('ui_type','=',4)->first();;
      $id   = $serviceinfo->vendor_category_id;
      $shopdata = DB::table("vendor_category")
      ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
      ->where('vendor_category.ui_type','=',4)
      ->get();
      $map1 = DB::table('map_API')
      ->first();
      $map = $map1->map_api_key;     
      $mapset = DB::table('map_settings')
         ->first();
       $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
      $profile = DB::table('tbl_user')->where(array('user_id' => session('userid')))->first();
      $orders = DB::table('orders')->where(array('user_id' => session('userid')))->get();
      $activeorder = DB::table('orders')->where('order_status','!=', 'Cancelled')->where(array('user_id' => session('userid')))->get();
       $address = DB::table('user_address')->where(array('user_id' => session('userid')))->get();
       $ordercancel = DB::table('cancel_for')->get();
       $data = Service::get();
       $termcondition = DB::table('termcondition')->where('id','4')->get();
       $about = DB::table('termcondition')->where('id','6')->get();
      return view('web.parcelprofile',['profile' => $profile,'termcondition'=>$termcondition,'about'=>$about,'orders' => $orders,'activeorder' => $activeorder,'wallet' => $profile->wallet_credits , 'reward' => $profile->rewards,'address' => $address,'ordercancel' => $ordercancel,'services' => $data,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    }
    
    public function pharmacyprofile(Request $request)
    {
      $serviceinfo = DB::table("vendor_category")->where('ui_type','=',3)->first();;
      $id   = $serviceinfo->vendor_category_id;
      $shopdata = DB::table("vendor_category")
      ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
      ->where('vendor_category.ui_type','=',3)
      ->get();
      $map1 = DB::table('map_API')
      ->first();
      $map = $map1->map_api_key;     
      $mapset = DB::table('map_settings')
         ->first();
       $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
      $profile = DB::table('tbl_user')->where(array('user_id' => session('userid')))->first();
      $orders = DB::table('orders')->where(array('user_id' => session('userid')))->get();
      $activeorder = DB::table('orders')->where('order_status','!=', 'Cancelled')->where(array('user_id' => session('userid')))->get();
       $address = DB::table('user_address')->where(array('user_id' => session('userid')))->get();
       $ordercancel = DB::table('cancel_for')->get();
       $data = Service::get();
       $termcondition = DB::table('termcondition')->where('id','4')->get();
       $about = DB::table('termcondition')->where('id','6')->get();
      return view('web.pharmacyprofile',['profile' => $profile,'termcondition'=>$termcondition,'about'=>$about,'orders' => $orders,'activeorder' => $activeorder,'wallet' => $profile->wallet_credits , 'reward' => $profile->rewards,'address' => $address,'ordercancel' => $ordercancel,'services' => $data,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    }
    
    public function addaddressdetails(Request $request)
    {
      $serviceinfo = DB::table("vendor_category")->where('ui_type','=',1)->first();
      $id   = $serviceinfo->vendor_category_id;
      $shopdata = DB::table("vendor_category")
      ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
      ->where('vendor_category.ui_type','=',1)
      ->get();
      $map1 = DB::table('map_API')
      ->first();
      $map = $map1->map_api_key;     
      $mapset = DB::table('map_settings')
         ->first();
       $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
    
        $city= DB::table('city')->get();
        return view('web.address',['city' => $city,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    }
    public function resturantaddaddressdetails()
    {
         $serviceinfo = DB::table("vendor_category")->where('ui_type','=',2)->first();
      $id   = $serviceinfo->vendor_category_id;
      $shopdata = DB::table("vendor_category")
      ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
      ->where('vendor_category.ui_type','=',2)
      ->get();
      $map1 = DB::table('map_API')
      ->first();
      $map = $map1->map_api_key;     
      $mapset = DB::table('map_settings')
         ->first();
       $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
    
        $city= DB::table('city')->get();
        return view('web.resturantaddaddressdetails',['city' => $city,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    }
    public function pharmacyaddaddressdetails(Request $request)
    {
      $serviceinfo = DB::table("vendor_category")->where('ui_type','=',3)->first();
      $id   = $serviceinfo->vendor_category_id;
      $shopdata = DB::table("vendor_category")
      ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
      ->where('vendor_category.ui_type','=',3)
      ->get();
      $map1 = DB::table('map_API')
      ->first();
      $map = $map1->map_api_key;     
      $mapset = DB::table('map_settings')
         ->first();
       $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
    
        $city= DB::table('city')->get();
        return view('web.pharmacyaddress',['city' => $city,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    }
    
    public function parceladdaddressdetails(Request $request)
    {
        $serviceinfo = DB::table("vendor_category")->where('ui_type','=',4)->first();
      $id   = $serviceinfo->vendor_category_id;
      $shopdata = DB::table("vendor_category")
      ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
      ->where('vendor_category.ui_type','=',4)
      ->get();
      $map1 = DB::table('map_API')
      ->first();
      $map = $map1->map_api_key;     
      $mapset = DB::table('map_settings')
         ->first();
       $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
    
        $city= DB::table('city')->get();
        return view('web.parceladdress',['city' => $city,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    }
    public function arealist($id){
    
      $data=  DB::table('area')
      ->join('cityadmin','area.cityadmin_id','=','cityadmin.cityadmin_id')
      ->join('city', 'cityadmin.city_id','=','city.city_id')
      ->select('area.*')
      ->where('city.city_id',$id)
      ->get()->tojson();
      return $data;
    }
    public function addaddressdetailsdata(Request $request)
    {
      $user_id = session('userid');
      $type = $request->type;
      $city_id = $request->city_id;
      $area_id = $request->area_id;
      $houseno = $request->houseno;
      $pincode = $request->pincode;
      $state = $request->state;
      $address = $request->address;
      $user = DB::table('tbl_user')
      ->select('user_name','user_phone')
      ->where('user_id', $user_id)
      ->first();
      $city = DB::table('city')
                ->select('city_name')
                ->where('city_id', $city_id)
                ->first();
      $area = DB::table('area')
                ->select('area_name')
                ->where('area_id', $area_id)
                ->first();
                $user_name = $user->user_name;
                $user_phone = $user->user_phone;
                $area_name = $area->area_name;
                $city_name = $city->city_name;
                $fulladdress = $houseno .",".  $address .",".  $area_name .",".  $city_name .",".  $state .",". $pincode; 
    
               $fulladdress1 = str_replace(" ", "+", $fulladdress);
               $address1 = str_replace("-", "+", $fulladdress1);
               $mapset= DB::table('map_settings')
                   ->first();
               $checkmap = DB::table('map_API')
                   ->first();
                $lat = '';
                $lng = '';
               if($mapset->mapbox == 0 && $mapset->google_map == 1){        
                   $response = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$address1."&key=".$checkmap->map_api_key));
                   
                    $lat = $response->results[0]->geometry->location->lat;
                    $lng = $response->results[0]->geometry->location->lng;
                   }
                
    
    
        $insertdetils = DB::table('user_address')->insert(['user_id'=>$user_id,
        'user_name'=>$user_name,
        'user_number'=>$user_phone,
        'city_id'=>$city_id,
        'area_id'=>$area_id,
        'address'=>$fulladdress,
        'select_status'=>1,
        'lat' => $lat,
        'lng' => $lng,
        'houseno' =>$houseno,
        'pincode' =>$pincode,
        'state' => $state,
        'street'=>$address,
        'type'=>$type]);
        if($insertdetils == 1)
        {
           echo 1;
        }else
        {
            echo 0;
        }
    }
    
    public function updateaddressdetails(Request $request)
    {
      $serviceinfo = DB::table("vendor_category")->where('ui_type','=',1)->first();
      $id   = $serviceinfo->vendor_category_id;
      $shopdata = DB::table("vendor_category")
      ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
      ->where('vendor_category.ui_type','=',1)
      ->get();
      $map1 = DB::table('map_API')
      ->first();
      $map = $map1->map_api_key;     
      $mapset = DB::table('map_settings')
         ->first();
       $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
    
       $editaddress = DB::table('user_address')->where(array('address_id' => $request->segment(2)))->first();
       $city= DB::table('city')->get();
       $area= DB::table('area')
       ->join('cityadmin','area.cityadmin_id','=','cityadmin.cityadmin_id')
       ->join('city', 'cityadmin.city_id','=','city.city_id')
       ->select('area.*')
       ->where('city.city_id',$editaddress->city_id)
       ->get();
       return view('web.editaddress',['editaddress' => $editaddress,'city' => $city,'area' => $area,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    }
    
    public function pharmacyupdateaddressdetails(Request $request)
    {
      $serviceinfo = DB::table("vendor_category")->where('ui_type','=',3)->first();
      $id   = $serviceinfo->vendor_category_id;
      $shopdata = DB::table("vendor_category")
      ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
      ->where('vendor_category.ui_type','=',3)
      ->get();
      $map1 = DB::table('map_API')
      ->first();
      $map = $map1->map_api_key;     
      $mapset = DB::table('map_settings')
         ->first();
       $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
    
       $editaddress = DB::table('user_address')->where(array('address_id' => $request->segment(2)))->first();
       $city= DB::table('city')->get();
       $area= DB::table('area')
       ->join('cityadmin','area.cityadmin_id','=','cityadmin.cityadmin_id')
       ->join('city', 'cityadmin.city_id','=','city.city_id')
       ->select('area.*')
       ->where('city.city_id',$editaddress->city_id)
       ->get();
       return view('web.pharmacyeditaddress',['editaddress' => $editaddress,'city' => $city,'area' => $area,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    }
    
    public function resturantupdateaddressdetails(Request $request)
    {
        $serviceinfo = DB::table("vendor_category")->where('ui_type','=',2)->first();
      $id   = $serviceinfo->vendor_category_id;
      $shopdata = DB::table("vendor_category")
      ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
      ->where('vendor_category.ui_type','=',2)
      ->get();
      $map1 = DB::table('map_API')
      ->first();
      $map = $map1->map_api_key;     
      $mapset = DB::table('map_settings')
         ->first();
       $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
    
       $editaddress = DB::table('user_address')->where(array('address_id' => $request->segment(2)))->first();
       $city= DB::table('city')->get();
       $area= DB::table('area')
       ->join('cityadmin','area.cityadmin_id','=','cityadmin.cityadmin_id')
       ->join('city', 'cityadmin.city_id','=','city.city_id')
       ->select('area.*')
       ->where('city.city_id',$editaddress->city_id)
       ->get();
       return view('web.restuarenteditaddress',['editaddress' => $editaddress,'city' => $city,'area' => $area,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    }
    
    public function parcelupdateaddressdetails(Request $request)
    {
         $serviceinfo = DB::table("vendor_category")->where('ui_type','=',4)->first();
      $id   = $serviceinfo->vendor_category_id;
      $shopdata = DB::table("vendor_category")
      ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
      ->where('vendor_category.ui_type','=',4)
      ->get();
      $map1 = DB::table('map_API')
      ->first();
      $map = $map1->map_api_key;     
      $mapset = DB::table('map_settings')
         ->first();
       $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
    
       $editaddress = DB::table('user_address')->where(array('address_id' => $request->segment(2)))->first();
       $city= DB::table('city')->get();
       $area= DB::table('area')
       ->join('cityadmin','area.cityadmin_id','=','cityadmin.cityadmin_id')
       ->join('city', 'cityadmin.city_id','=','city.city_id')
       ->select('area.*')
       ->where('city.city_id',$editaddress->city_id)
       ->get();
       return view('web.parceleditaddress',['editaddress' => $editaddress,'city' => $city,'area' => $area,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    }
    public function updateaddressdetailsfinal(Request $request)
    {
        
      $user_id = session('userid');
      $addressid=$request->addressid;
      $type = $request->type;
      $city_id = $request->city_id;
      $area_id = $request->area_id;
      $houseno = $request->houseno;
      $pincode = $request->pincode;
      $state = $request->state;
      $address = $request->address;
      $user = DB::table('tbl_user')
      ->select('user_name','user_phone')
      ->where('user_id', $user_id)
      ->first();
      $city = DB::table('city')
                ->select('city_name')
                ->where('city_id', $city_id)
                ->first();
      $area = DB::table('area')
                ->select('area_name')
                ->where('area_id', $area_id)
                ->first();
                $user_name = $user->user_name;
                $user_phone = $user->user_phone;
                $area_name = $area->area_name;
                $city_name = $city->city_name;
                $fulladdress = $houseno .",".  $address .",".  $area_name .",".  $city_name .",".  $state .",". $pincode; 
    
               $fulladdress1 = str_replace(" ", "+", $fulladdress);
               $address1 = str_replace("-", "+", $fulladdress1);
               $mapset= DB::table('map_settings')
                   ->first();
               $checkmap = DB::table('map_API')
                   ->first();
                $lat = '';
                $lng = '';
               if($mapset->mapbox == 0 && $mapset->google_map == 1){        
                   $response = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$address1."&key=".$checkmap->map_api_key));
                   
                    $lat = $response->results[0]->geometry->location->lat;
                    $lng = $response->results[0]->geometry->location->lng;
                   }
      
    
        $updatedetils = DB::table('user_address')->where(array('user_id' => session('userid'),'address_id' => $addressid))->update([ 'user_name'=>$user_name,
        'user_number'=>$user_phone,
        'city_id'=>$city_id,
        'area_id'=>$area_id,
        'address'=>$fulladdress,
        'lat' => $lat,
        'lng' => $lng,
        'houseno' =>$houseno,
        'pincode' =>$pincode,
        'state' => $state,
        'street'=>$address,
        'type'=>$type]);
        if($updatedetils == 1)
        {
          echo 1;
       }else
       {
           echo 0;
       }
    }
    public function setaddress(Request $request)
    {
        $update = DB::table('user_address')->where(array('address_id' => $request->addressid))->update(array('select_status' => 1));
          $updatedata = DB::table('user_address')->where('address_id' ,'!=', $request->addressid)->where(array('user_id' => session('userid')))->update(array('select_status' => 0));
       
        if($update == 1)
        {
            echo 1;
        }
    }
    public function orderideatils(Request $request)
    {
        
        $order = DB::table('orders')->where(array('order_id' => $request->orderid))->first();
        // $storeexplode = explode(',',$order->vendor_id);
        $currency = DB::table('currency')->first();
        $address = DB::table('user_address')->where(array('address_id' => $order->address_id))->first();
        $totalprice = $order->price_without_delivery  +  $order->delivery_charge;
        $store = DB::table('vendor')->where(array('vendor_id' => $order->vendor_id))->first();
        $info = array('address' => $address,'order' => $order,'store' => $store,'totalprice' =>$totalprice);
        echo json_encode($info);
    }
    public function parcelorderideatils(Request $request)
    {
        $order = DB::table('orders')->where(array('order_id' => $request->orderid))->first();
        // $storeexplode = explode(',',$order->vendor_id);
        $currency = DB::table('currency')->first();
        $address = DB::table('destination_address')->where(array('destination_address_id' => $order->address_id))->first();
        $totalprice = $order->price_without_delivery  +  $order->delivery_charge;
        $store = DB::table('vendor')->where(array('vendor_id' => $order->vendor_id))->first();
        $info = array('address' => $address,'order' => $order,'store' => $store,'totalprice' =>$totalprice);
        echo json_encode($info);
    }
    public function cancelorder(Request $request)
    {
        $update = DB::table('orders')->where(array('order_id' => $request->orderid))->update(array('cancelling_reason' => $request->cancelreason,'order_status' => 'Cancelled'));
        if($update == 1)
        {
            echo 1;
        }
    }
    public function cancelorderload(Request $request)
    {
         $ordercancel = DB::table('cancel_for')->get();
         $info = array('ordercancel' => $ordercancel,'orderid' =>$request->order_id);
         echo json_encode($info);
    }
    public function webupdateprofile(Request $request)
    {
    
                    $username = $request->username;
                    $useremail = $request->useremail;
                    $mobilenumber = ltrim($request->mobilenumber,'0');
                    $password=$request->password1;
                    $password2=$request->password2;
    
                    
                    if($password!="" && $password2!="")
                    {
                        if($password!=$password2){
                            return redirect()->back()->with('message','password are not same');
                        }
                        else
                        {
                            $new_pass=$password;
                            $value=array('user_name'=>$username,'user_email'=>$useremail,'user_phone'=>$mobilenumber, 'user_password'=>$new_pass);
                        }
                        
                    }
                    else
                    {
                        $value=array('user_name'=>$username,'user_email'=>$useremail,'user_phone'=>$mobilenumber);
                    }
            
                 
         $update = DB::table('tbl_user')->where(array('user_id' => session('userid')))->update($value);
       
        return redirect()->back()->with('message', 'Profile Updated Suceessfully');
       
     
    
    }
    public function updatereddempoint(Request $request)
    {
         if($request->reddem != '')
        {
            $reedem_values = DB::table('reedem_values')->first();
            $totreedem = $request->reddem * $reedem_values->value;
           
            $walletexist = DB::table('tbl_user')->where(array('user_id' => $request->userid))->first();
            $totalwalltewamount = $walletexist->wallet_credits;
            $totalwalltewamount += $totreedem;
            $walletupdate = DB::table('tbl_user')->where(array('user_id' => $request->userid))->update(array('wallet_credits' => $totalwalltewamount,'rewards' => 0));
            
            if($walletupdate == 1)
            {
                
                
                $infoarray = array('code' => '200','msg' =>  "".$totreedem." Credit in your wallet",'walletamount' => $totalwalltewamount);
                echo json_encode($infoarray);
            }
        }
    }
    
    public function groceryorder(){
      $serviceinfo = DB::table("vendor_category")->where('ui_type','=',1)->first();
      $id   = $serviceinfo->vendor_category_id;
      $shopdata = DB::table("vendor_category")
      ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
      ->where('vendor_category.ui_type','=',1)
      ->get();
      $map1 = DB::table('map_API')
      ->first();
      $map = $map1->map_api_key;     
      $mapset = DB::table('map_settings')
         ->first();
       $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
          $completeds = DB::table('orders')
          ->join('vendor','orders.vendor_id','=','vendor.vendor_id')
          ->leftjoin('user_address','orders.address_id','=','user_address.address_id')
            ->where('orders.user_id',session('userid'))
            ->where('order_status', 'completed')
             ->where('orders.ui_type', '1')
             ->get();
             if(count($completeds)>0){
              foreach($completeds as $completed){
              $order = DB::table('order_details')
                      ->leftJoin('product_varient', 'order_details.varient_id','=','product_varient.varient_id')
                      ->select('order_details.*','product_varient.description')
                      ->where('order_details.order_cart_id',$completed->cart_id)
                      ->orderBy('order_details.order_date', 'DESC')
                      ->get();
                          
                
                $data[]=array('order_status'=>$completed->order_status,'order_id'=>$completed->order_id, 'delivery_date'=>$completed->delivery_date,'time_slot'=>$completed->time_slot,'payment_method'=>$completed->payment_method,'payment_status'=>$completed->payment_status,'paid_by_wallet'=>$completed->paid_by_wallet, 'cart_id'=>$completed->cart_id ,'price'=>$completed->total_price,'del_charge'=>$completed->delivery_charge,'remaining_amount'=>$completed->rem_price,'coupon_discount'=>$completed->coupon_discount,'vendor_name'=>$completed->vendor_name,'vendor_loc'=>$completed->vendor_loc,'vendor_logo'=>$completed->vendor_logo, 
                    'address'=>$completed->address,'data'=>$order); 
                }
                }
                else{
                    $data=array();
                }
    
    
                $ongoing = DB::table('orders')
          
                 ->leftJoin('delivery_boy', 'orders.dboy_id', '=', 'delivery_boy.delivery_boy_id')
                 ->join('vendor','orders.vendor_id','=','vendor.vendor_id')
                 ->join('user_address','orders.address_id','=','user_address.address_id')
                  ->where('orders.user_id',session('userid'))
                  ->where('orders.order_status', '!=', 'Completed')
                   ->where('orders.order_status', '!=', 'Cancelled')
                   ->where('orders.ui_type', '1')
                  ->where('orders.payment_method', '!=', NULL)
                  ->orderBy('orders.order_id', 'DESC')
                   ->get();
                   if(count($ongoing)>0){
                    foreach($ongoing as $ongoings){
                    $order = DB::table('order_details')
                          ->leftJoin('product_varient', 'order_details.varient_id','=','product_varient.varient_id')
                          ->select('order_details.*','product_varient.description')
                          ->where('order_details.order_cart_id',$ongoings->cart_id)
                          ->orderBy('order_details.order_date', 'DESC')
                          ->get();
                                
                      
                      $ongoingdata[]=array('order_status'=>$ongoings->order_status,'order_id'=>$ongoings->order_id,'vendor_loc'=>$ongoings->vendor_loc,'vendor_logo'=>$ongoings->vendor_logo,'vendor_name'=>$ongoings->vendor_name, 'delivery_date'=>$ongoings->delivery_date, 'time_slot'=>$ongoings->time_slot,'payment_method'=>$ongoings->payment_method,'payment_status'=>$ongoings->payment_status,'paid_by_wallet'=>$ongoings->paid_by_wallet, 'cart_id'=>$ongoings->cart_id ,'price'=>$ongoings->total_price,'delivery_charge'=>$ongoings->delivery_charge,'remaining_amount'=>$ongoings->rem_price,'coupon_discount'=>$ongoings->coupon_discount,'delivery_boy_name'=>$ongoings->delivery_boy_name,'delivery_boy_phone'=>$ongoings->delivery_boy_phone,
                           'address'=>$ongoings->address,'data'=>$order); 
                      }
                      }
                      else{
                           $ongoingdata=array();
                      }
    
               $ordercancel = DB::table('orders')
                      ->join('vendor','orders.vendor_id','=','vendor.vendor_id')
                      ->leftjoin('user_address','orders.address_id','=','user_address.address_id')
                        ->where('orders.user_id',session('userid'))
                        ->where('order_status', 'cancelled')
                       ->where('orders.ui_type', '1')
                         ->get();
                
                if(count($ordercancel)>0){
                foreach($ordercancel as $ordercancels){
                $order = DB::table('order_details')
                      ->join ('product_varient', 'order_details.varient_id', '=', 'product_varient.varient_id')
                      ->join ('product', 'product_varient.product_id', '=', 'product.product_id')
                            ->select('product_varient.varient_id','product.product_name', 'product_varient.varient_image','order_details.qty','product_varient.description','product_varient.unit','product_varient.quantity','order_details.order_cart_id')
                            ->where('order_details.order_cart_id',$ordercancels->cart_id)
                            ->groupBy('product_varient.varient_id','product.product_name', 'product_varient.varient_image','order_details.qty','product_varient.description','product_varient.unit','product_varient.quantity','order_details.order_cart_id')
                            ->orderBy('order_details.order_date', 'DESC')
                            ->get();
                            
                  
                  $canceldata[]=array('order_status'=>$ordercancels->order_status,'order_id'=>$ordercancels->order_id,'vendor_name'=>$ordercancels->vendor_name, 'vendor_loc'=>$ordercancels->vendor_loc,'vendor_logo'=>$ordercancels->vendor_logo,'delivery_date'=>$ordercancels->delivery_date, 'time_slot'=>$ordercancels->time_slot,'payment_method'=>$ordercancels->payment_method,'payment_status'=>$ordercancels->payment_status,'paid_by_wallet'=>$ordercancels->paid_by_wallet, 'cart_id'=>$ordercancels->cart_id ,'price'=>$ordercancels->total_price,'del_charge'=>$ordercancels->delivery_charge,'remaining_amount'=>$ordercancels->rem_price,'coupon_discount'=>$ordercancels->coupon_discount,
                      'address'=>$ordercancels->address,'data'=>$order); 
                  }
                  }
                  else{
                      $canceldata=array();
                  }
    
                  $ordercancelfor = DB::table('cancel_for')->get();
    
      return view('web.groceryorder',['completed' => $data,'ordercancelfor'=>$ordercancelfor,'ongoing'=>$ongoingdata,'cancel'=>$canceldata,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    
    }
    public function pharmacyorder(){
      $serviceinfo = DB::table("vendor_category")->where('ui_type','=',3)->first();
      $id   = $serviceinfo->vendor_category_id;
      $shopdata = DB::table("vendor_category")
      ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
      ->where('vendor_category.ui_type','=',3)
      ->get();
      $map1 = DB::table('map_API')
      ->first();
      $map = $map1->map_api_key;     
      $mapset = DB::table('map_settings')
         ->first();
       $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
          $completeds = DB::table('orders')
          ->join('vendor','orders.vendor_id','=','vendor.vendor_id')
          ->leftjoin('user_address','orders.address_id','=','user_address.address_id')
            ->where('orders.user_id',session('userid'))
            ->where('order_status', 'completed')
             ->where('orders.ui_type', '3')
             ->get();
             if(count($completeds)>0){
              foreach($completeds as $completed){
              $order = DB::table('order_details')
                      ->leftJoin('product_varient', 'order_details.varient_id','=','product_varient.varient_id')
                      ->select('order_details.*','product_varient.description')
                      ->where('order_details.order_cart_id',$completed->cart_id)
                      ->orderBy('order_details.order_date', 'DESC')
                      ->get();
                          
                
                $data[]=array('order_status'=>$completed->order_status,'order_id'=>$completed->order_id, 'delivery_date'=>$completed->delivery_date,'time_slot'=>$completed->time_slot,'payment_method'=>$completed->payment_method,'payment_status'=>$completed->payment_status,'paid_by_wallet'=>$completed->paid_by_wallet, 'cart_id'=>$completed->cart_id ,'price'=>$completed->total_price,'del_charge'=>$completed->delivery_charge,'remaining_amount'=>$completed->rem_price,'coupon_discount'=>$completed->coupon_discount,'vendor_name'=>$completed->vendor_name,'vendor_loc'=>$completed->vendor_loc,'vendor_logo'=>$completed->vendor_logo, 
                    'address'=>$completed->address,'data'=>$order); 
                }
                }
                else{
                    $data=array();
                }
    
    
                $ongoing = DB::table('orders')
          
                 ->leftJoin('delivery_boy', 'orders.dboy_id', '=', 'delivery_boy.delivery_boy_id')
                 ->join('vendor','orders.vendor_id','=','vendor.vendor_id')
                 ->join('user_address','orders.address_id','=','user_address.address_id')
                  ->where('orders.user_id',session('userid'))
                  ->where('orders.order_status', '!=', 'Completed')
                   ->where('orders.order_status', '!=', 'Cancelled')
                   ->where('orders.ui_type', '3')
                  ->where('orders.payment_method', '!=', NULL)
                  ->orderBy('orders.order_id', 'DESC')
                   ->get();
                   if(count($ongoing)>0){
                    foreach($ongoing as $ongoings){
                    $order = DB::table('order_details')
                          ->leftJoin('product_varient', 'order_details.varient_id','=','product_varient.varient_id')
                          ->select('order_details.*','product_varient.description')
                          ->where('order_details.order_cart_id',$ongoings->cart_id)
                          ->orderBy('order_details.order_date', 'DESC')
                          ->get();
                                
                      
                      $ongoingdata[]=array('order_status'=>$ongoings->order_status,'order_id'=>$ongoings->order_id,'vendor_loc'=>$ongoings->vendor_loc,'vendor_logo'=>$ongoings->vendor_logo,'vendor_name'=>$ongoings->vendor_name, 'delivery_date'=>$ongoings->delivery_date, 'time_slot'=>$ongoings->time_slot,'payment_method'=>$ongoings->payment_method,'payment_status'=>$ongoings->payment_status,'paid_by_wallet'=>$ongoings->paid_by_wallet, 'cart_id'=>$ongoings->cart_id ,'price'=>$ongoings->total_price,'delivery_charge'=>$ongoings->delivery_charge,'remaining_amount'=>$ongoings->rem_price,'coupon_discount'=>$ongoings->coupon_discount,'delivery_boy_name'=>$ongoings->delivery_boy_name,'delivery_boy_phone'=>$ongoings->delivery_boy_phone,
                           'address'=>$ongoings->address,'data'=>$order); 
                      }
                      }
                      else{
                           $ongoingdata=array();
                      }
    
               $ordercancel = DB::table('orders')
                      ->join('vendor','orders.vendor_id','=','vendor.vendor_id')
                      ->leftjoin('user_address','orders.address_id','=','user_address.address_id')
                        ->where('orders.user_id',session('userid'))
                        ->where('order_status', 'cancelled')
                       ->where('orders.ui_type', '3')
                         ->get();
                
                if(count($ordercancel)>0){
                foreach($ordercancel as $ordercancels){
                $order = DB::table('order_details')
                      ->join ('product_varient', 'order_details.varient_id', '=', 'product_varient.varient_id')
                      ->join ('product', 'product_varient.product_id', '=', 'product.product_id')
                            ->select('product_varient.varient_id','product.product_name', 'product_varient.varient_image','order_details.qty','product_varient.description','product_varient.unit','product_varient.quantity','order_details.order_cart_id')
                            ->where('order_details.order_cart_id',$ordercancels->cart_id)
                            ->groupBy('product_varient.varient_id','product.product_name', 'product_varient.varient_image','order_details.qty','product_varient.description','product_varient.unit','product_varient.quantity','order_details.order_cart_id')
                            ->orderBy('order_details.order_date', 'DESC')
                            ->get();
                            
                  
                  $canceldata[]=array('order_status'=>$ordercancels->order_status,'order_id'=>$ordercancels->order_id,'vendor_name'=>$ordercancels->vendor_name, 'vendor_loc'=>$ordercancels->vendor_loc,'vendor_logo'=>$ordercancels->vendor_logo,'delivery_date'=>$ordercancels->delivery_date, 'time_slot'=>$ordercancels->time_slot,'payment_method'=>$ordercancels->payment_method,'payment_status'=>$ordercancels->payment_status,'paid_by_wallet'=>$ordercancels->paid_by_wallet, 'cart_id'=>$ordercancels->cart_id ,'price'=>$ordercancels->total_price,'del_charge'=>$ordercancels->delivery_charge,'remaining_amount'=>$ordercancels->rem_price,'coupon_discount'=>$ordercancels->coupon_discount,
                      'address'=>$ordercancels->address,'data'=>$order); 
                  }
                  }
                  else{
                      $canceldata=array();
                  }
                  $ordercancelfor = DB::table('cancel_for')->get();
          
      return view('web.pharmacyorder',['completed' => $data,'ordercancelfor'=>$ordercancelfor,'ongoing'=>$ongoingdata,'cancel'=>$canceldata,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    
    }
    
    public function resturantorder(){
      $serviceinfo = DB::table("vendor_category")->where('ui_type','=',2)->first();
      $id   = $serviceinfo->vendor_category_id;
      $shopdata = DB::table("vendor_category")
      ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
      ->where('vendor_category.ui_type','=',2)
      ->get();
      $map1 = DB::table('map_API')
      ->first();
      $map = $map1->map_api_key;     
      $mapset = DB::table('map_settings')
         ->first();
       $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
          $completeds = DB::table('orders')
          ->join('vendor','orders.vendor_id','=','vendor.vendor_id')
          ->leftjoin('user_address','orders.address_id','=','user_address.address_id')
            ->where('orders.user_id',session('userid'))
            ->where('order_status', 'completed')
             ->where('orders.ui_type', '2')
             ->get();
             if(count($completeds)>0){
              foreach($completeds as $completed){
              $order = DB::table('order_details')
                      ->leftJoin('product_varient', 'order_details.varient_id','=','product_varient.varient_id')
                      ->select('order_details.*','product_varient.description')
                      ->where('order_details.order_cart_id',$completed->cart_id)
                      ->orderBy('order_details.order_date', 'DESC')
                      ->get();
                          
                
                $data[]=array('order_status'=>$completed->order_status,'order_id'=>$completed->order_id, 'delivery_date'=>$completed->delivery_date,'time_slot'=>$completed->time_slot,'payment_method'=>$completed->payment_method,'payment_status'=>$completed->payment_status,'paid_by_wallet'=>$completed->paid_by_wallet, 'cart_id'=>$completed->cart_id ,'price'=>$completed->total_price,'del_charge'=>$completed->delivery_charge,'remaining_amount'=>$completed->rem_price,'coupon_discount'=>$completed->coupon_discount,'vendor_name'=>$completed->vendor_name,'vendor_loc'=>$completed->vendor_loc,'vendor_logo'=>$completed->vendor_logo, 
                    'address'=>$completed->address,'data'=>$order); 
                }
                }
                else{
                    $data=array();
                }
    
    
                $ongoing = DB::table('orders')
          
                 ->leftJoin('delivery_boy', 'orders.dboy_id', '=', 'delivery_boy.delivery_boy_id')
                 ->join('vendor','orders.vendor_id','=','vendor.vendor_id')
                 ->join('user_address','orders.address_id','=','user_address.address_id')
                  ->where('orders.user_id',session('userid'))
                  ->where('orders.order_status', '!=', 'Completed')
                   ->where('orders.order_status', '!=', 'Cancelled')
                   ->where('orders.ui_type', '2')
                  ->where('orders.payment_method', '!=', NULL)
                  ->orderBy('orders.order_id', 'DESC')
                   ->get();
                   if(count($ongoing)>0){
                    foreach($ongoing as $ongoings){
                    $order = DB::table('order_details')
                          ->leftJoin('product_varient', 'order_details.varient_id','=','product_varient.varient_id')
                          ->select('order_details.*','product_varient.description')
                          ->where('order_details.order_cart_id',$ongoings->cart_id)
                          ->orderBy('order_details.order_date', 'DESC')
                          ->get();
                                
                      
                      $ongoingdata[]=array('order_status'=>$ongoings->order_status,'order_id'=>$ongoings->order_id,'vendor_loc'=>$ongoings->vendor_loc,'vendor_logo'=>$ongoings->vendor_logo,'vendor_name'=>$ongoings->vendor_name, 'delivery_date'=>$ongoings->delivery_date, 'time_slot'=>$ongoings->time_slot,'payment_method'=>$ongoings->payment_method,'payment_status'=>$ongoings->payment_status,'paid_by_wallet'=>$ongoings->paid_by_wallet, 'cart_id'=>$ongoings->cart_id ,'price'=>$ongoings->total_price,'delivery_charge'=>$ongoings->delivery_charge,'remaining_amount'=>$ongoings->rem_price,'coupon_discount'=>$ongoings->coupon_discount,'delivery_boy_name'=>$ongoings->delivery_boy_name,'delivery_boy_phone'=>$ongoings->delivery_boy_phone,
                           'address'=>$ongoings->address,'data'=>$order); 
                      }
                      }
                      else{
                           $ongoingdata=array();
                      }
    
               $ordercancel = DB::table('orders')
                      ->join('vendor','orders.vendor_id','=','vendor.vendor_id')
                      ->leftjoin('user_address','orders.address_id','=','user_address.address_id')
                        ->where('orders.user_id',session('userid'))
                        ->where('order_status', 'cancelled')
                       ->where('orders.ui_type', '2')
                         ->get();
                
                if(count($ordercancel)>0){
                foreach($ordercancel as $ordercancels){
                $order = DB::table('order_details')
                      ->join ('product_varient', 'order_details.varient_id', '=', 'product_varient.varient_id')
                      ->join ('product', 'product_varient.product_id', '=', 'product.product_id')
                            ->select('product_varient.varient_id','product.product_name', 'product_varient.varient_image','order_details.qty','product_varient.description','product_varient.unit','product_varient.quantity','order_details.order_cart_id')
                            ->where('order_details.order_cart_id',$ordercancels->cart_id)
                            ->groupBy('product_varient.varient_id','product.product_name', 'product_varient.varient_image','order_details.qty','product_varient.description','product_varient.unit','product_varient.quantity','order_details.order_cart_id')
                            ->orderBy('order_details.order_date', 'DESC')
                            ->get();
                            
                  
                  $canceldata[]=array('order_status'=>$ordercancels->order_status,'order_id'=>$ordercancels->order_id,'vendor_name'=>$ordercancels->vendor_name, 'vendor_loc'=>$ordercancels->vendor_loc,'vendor_logo'=>$ordercancels->vendor_logo,'delivery_date'=>$ordercancels->delivery_date, 'time_slot'=>$ordercancels->time_slot,'payment_method'=>$ordercancels->payment_method,'payment_status'=>$ordercancels->payment_status,'paid_by_wallet'=>$ordercancels->paid_by_wallet, 'cart_id'=>$ordercancels->cart_id ,'price'=>$ordercancels->total_price,'del_charge'=>$ordercancels->delivery_charge,'remaining_amount'=>$ordercancels->rem_price,'coupon_discount'=>$ordercancels->coupon_discount,
                      'address'=>$ordercancels->address,'data'=>$order); 
                  }
                  }
                  else{
                      $canceldata=array();
                  }
                  $ordercancelfor = DB::table('cancel_for')->get();
          
      return view('web.resturantorder',['completed' => $data,'ordercancelfor'=>$ordercancelfor,'ongoing'=>$ongoingdata,'cancel'=>$canceldata,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    
    }
    
    public function parcelorder(){
      $serviceinfo = DB::table("vendor_category")->where('ui_type','=',4)->first();
      $id   = $serviceinfo->vendor_category_id;
      $shopdata = DB::table("vendor_category")
      ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
      ->where('vendor_category.ui_type','=',4)
      ->get();
      $map1 = DB::table('map_API')
      ->first();
      $map = $map1->map_api_key;     
      $mapset = DB::table('map_settings')
         ->first();
       $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
          $completeds = DB::table('orders')
          ->join('vendor','orders.vendor_id','=','vendor.vendor_id')
          ->leftjoin('user_address','orders.address_id','=','user_address.address_id')
            ->where('orders.user_id',session('userid'))
            ->where('order_status', 'completed')
             ->where('orders.ui_type', '4')
             ->get();
             
             
             if(count($completeds)>0){
              foreach($completeds as $completed){
              $order = DB::table('order_details')
                      ->leftJoin('parcel_details', 'parcel_details.parcel_id','=','order_details.varient_id')
                      ->select('order_details.*','parcel_details.*')
                      ->where('order_details.order_cart_id',$completed->cart_id)
                      ->orderBy('order_details.order_date', 'DESC')
                      ->get();
                     
                
                $data[]=array('order_status'=>$completed->order_status,'order_id'=>$completed->order_id, 'delivery_date'=>$completed->delivery_date,'time_slot'=>$completed->time_slot,'payment_method'=>$completed->payment_method,'payment_status'=>$completed->payment_status,'paid_by_wallet'=>$completed->paid_by_wallet, 'cart_id'=>$completed->cart_id ,'price'=>$completed->total_price,'del_charge'=>$completed->delivery_charge,'remaining_amount'=>$completed->rem_price,'coupon_discount'=>$completed->coupon_discount,'vendor_name'=>$completed->vendor_name,'vendor_loc'=>$completed->vendor_loc,'vendor_logo'=>$completed->vendor_logo, 
                    'address'=>$completed->address,'data'=>$order); 
                }
                }
                else{
                    $data=array();
                }
    
                DB::enableQueryLog();
                $ongoing = DB::table('orders')
          
                 ->leftJoin('delivery_boy', 'orders.dboy_id', '=', 'delivery_boy.delivery_boy_id')
                 ->join('vendor','orders.vendor_id','=','vendor.vendor_id')
                 ->leftJoin('user_address','orders.address_id','=','user_address.address_id')
                  ->where('orders.user_id',session('userid'))
                  ->where('orders.order_status', '!=', 'Completed')
                   ->where('orders.order_status', '!=', 'Cancelled')
                   ->where('orders.ui_type', '4')
                  ->where('orders.payment_method', '!=', NULL)
                  ->orderBy('orders.order_id', 'DESC')
                   ->get();
                //   dd(DB::getQueryLog());
                   
                   if(count($ongoing)>0){
                    foreach($ongoing as $ongoings){
                    $order = DB::table('order_details')
                           ->leftJoin('parcel_details', 'parcel_details.parcel_id','=','order_details.varient_id')
                      ->select('order_details.*','parcel_details.*')
                          ->where('order_details.order_cart_id',$ongoings->cart_id)
                          ->orderBy('order_details.order_date', 'DESC')
                          ->get();
                                
                      
                      $ongoingdata[]=array('order_status'=>$ongoings->order_status,'order_id'=>$ongoings->order_id,'vendor_loc'=>$ongoings->vendor_loc,'vendor_logo'=>$ongoings->vendor_logo,'vendor_name'=>$ongoings->vendor_name, 'delivery_date'=>$ongoings->delivery_date, 'time_slot'=>$ongoings->time_slot,'payment_method'=>$ongoings->payment_method,'payment_status'=>$ongoings->payment_status,'paid_by_wallet'=>$ongoings->paid_by_wallet, 'cart_id'=>$ongoings->cart_id ,'price'=>$ongoings->total_price,'delivery_charge'=>$ongoings->delivery_charge,'remaining_amount'=>$ongoings->rem_price,'coupon_discount'=>$ongoings->coupon_discount,'delivery_boy_name'=>$ongoings->delivery_boy_name,'delivery_boy_phone'=>$ongoings->delivery_boy_phone,
                           'address'=>$ongoings->address,'data'=>$order); 
                      }
                      }
                      else{
                           $ongoingdata=array();
                      }
    
               $ordercancel = DB::table('orders')
                      ->join('vendor','orders.vendor_id','=','vendor.vendor_id')
                      ->leftjoin('user_address','orders.address_id','=','user_address.address_id')
                        ->where('orders.user_id',session('userid'))
                        ->where('order_status', 'cancelled')
                       ->where('orders.ui_type', '4')
                         ->get();
                
                if(count($ordercancel)>0){
                foreach($ordercancel as $ordercancels){
                $order = DB::table('order_details')
                      ->join ('product_varient', 'order_details.varient_id', '=', 'product_varient.varient_id')
                      ->join ('product', 'product_varient.product_id', '=', 'product.product_id')
                            ->select('product_varient.varient_id','product.product_name', 'product_varient.varient_image','order_details.qty','product_varient.description','product_varient.unit','product_varient.quantity','order_details.order_cart_id')
                            ->where('order_details.order_cart_id',$ordercancels->cart_id)
                            ->groupBy('product_varient.varient_id','product.product_name', 'product_varient.varient_image','order_details.qty','product_varient.description','product_varient.unit','product_varient.quantity','order_details.order_cart_id')
                            ->orderBy('order_details.order_date', 'DESC')
                            ->get();
                            
                  
                  $canceldata[]=array('order_status'=>$ordercancels->order_status,'order_id'=>$ordercancels->order_id,'vendor_name'=>$ordercancels->vendor_name, 'vendor_loc'=>$ordercancels->vendor_loc,'vendor_logo'=>$ordercancels->vendor_logo,'delivery_date'=>$ordercancels->delivery_date, 'time_slot'=>$ordercancels->time_slot,'payment_method'=>$ordercancels->payment_method,'payment_status'=>$ordercancels->payment_status,'paid_by_wallet'=>$ordercancels->paid_by_wallet, 'cart_id'=>$ordercancels->cart_id ,'price'=>$ordercancels->total_price,'del_charge'=>$ordercancels->delivery_charge,'remaining_amount'=>$ordercancels->rem_price,'coupon_discount'=>$ordercancels->coupon_discount,
                      'address'=>$ordercancels->address,'data'=>$order); 
                  }
                  }
                  else{
                      $canceldata=array();
                  }
                  $ordercancelfor = DB::table('cancel_for')->get();
          
      return view('web.parcelorder',['completed' => $data,'ordercancelfor'=>$ordercancelfor,'ongoing'=>$ongoingdata,'cancel'=>$canceldata,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    
    }
    
    public function websupport(Request $request)
    {  
        $created_at = Carbon::now();
        $user_id = $request->userid;
        $user_number =$request->user_number;
        $message =$request->message;
        $support = DB::table('support_queries')
                       ->insert([
                                'user_id'=>$user_id,
                                'phone_number'=>$user_number,
                                'message'=>$message,
                                'query_date'=>$created_at,
                                ]);
      if($support){
        return redirect()->back()->with('message', 'Send message Suceessfully');
                }
            else{
              return redirect()->back()->withErrors("something wents wrong.");        
            }
    
    }
    public function webaboutus(){
      $data = Service::get();
      $serviceinfo = DB::table("vendor_category")->where('ui_type','=',1)->first();;
      $id   = $serviceinfo->vendor_category_id;
      $map1 = DB::table('map_API')
      ->first();
      $map = $map1->map_api_key;     
      $mapset = DB::table('map_settings')
         ->first();
       $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
          $about = DB::table('termcondition')->where('id','6')->get();
    
      return view('web.about',['services' => $data,'about'=>$about,'id'=>$id,'storelist' =>$storelist,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    }
    public function webterms(){
      $data = Service::get();
      $serviceinfo = DB::table("vendor_category")->where('ui_type','=',1)->first();;
      $id   = $serviceinfo->vendor_category_id;
      $map1 = DB::table('map_API')
      ->first();
      $map = $map1->map_api_key;     
      $mapset = DB::table('map_settings')
         ->first();
       $mapbox = DB::table('mapbox')
          ->first();
          $storelist = NULL;
          $termcondition = DB::table('termcondition')->where('id','4')->get();
    
      return view('web.terms',['services' => $data,'termcondition'=>$termcondition,'id'=>$id,'storelist' =>$storelist,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    }

}
