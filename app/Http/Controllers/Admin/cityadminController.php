<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;
use Excel;

class cityadminController extends Controller
{
    public function cityadmin(Request $request)
    {
        
        $admin_email=Session::get('admin');
        $admin=DB::table('admin')
        ->where('admin_email',$admin_email)
        ->first();
        $cityadmin= DB::table('cityadmin')
        ->join('city', 'cityadmin.city_id', '=', 'city.city_id')
        ->get();
       
        return view('admin.cityadmin.cityadmin',compact("admin_email","cityadmin","admin"));
    }
    
     public function Addcityadmin(Request $request)
    {
  
        $admin_email=Session::get('admin');
        $admin=DB::table('admin')
                ->where('admin_email',$admin_email)
                ->first();
                
        $getCityAdmin = DB::table('cityadmin')->pluck('city_id')->toArray();
        
        $city= DB::table('city')
                ->whereNotIn('city_id', $getCityAdmin)
                ->get();
        $map1 = DB::table('map_API')
             ->first();
         $map = $map1->map_api_key;     
         $mapset = DB::table('map_settings')
                ->first();
        $mapbox = DB::table('mapbox')
                ->first();
                
         return view('admin.cityadmin.addcityadmin',compact("admin_email","city","admin","map1","mapset","mapbox","map"));
    }
    
    
    public function AddNewcityadmin(Request $request)
    {
            $this->validate($request,[
               'cityadmin_name' => 'required',
               'cityadmin_email' => 'required',
                'cityadmin_phone' => 'required',
                'cityadmin_address' => 'required',
                'password1' => 'required',
                'password2' => 'required',
               'cityadmin_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

           ]);
        
       
        $cityadmin_id=$request->id;
        $city_name=$request->city_name;
        $cityadmin_name=$request->cityadmin_name;
        $cityadmin_email=$request->cityadmin_email;
        $cityadmin_phone=$request->cityadmin_phone;
        $password=$request->password1;
        $password2=$request->password2;
        $address = $request->cityadmin_address; 
        $addres = str_replace(" ", "+", $address);
        $address1 = str_replace("-", "+", $addres);
        
        $checkmap = DB::table('map_API')
                  ->first();
         $mapset= DB::table('map_settings')
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
                    
        
        $old_cityadmin_image=$request->old_cityadmin_image;
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');
        $cityadmin_image = $request->cityadmin_image;
        $fileName = date('dmyhisa').'-'.$cityadmin_image->getClientOriginalName();
        $fileName = str_replace(" ", "-", $fileName);
        $cityadmin_image->move('cityadmin_img/images/'.$date.'/', $fileName);
        $cityadmin_image = 'cityadmin_img/images/'.$date.'/'.$fileName;
        $checkcityadmin= DB::table('cityadmin')
                      ->where('city_id', $city_name)
                      ->get();
        if(count($checkcityadmin)>0){
            return redirect()->back()->withErrors('cityadmin already created for the city');
        }
       else{
        if($password!=$password2){
             return redirect()->back()->withErrors('password are not same');
        }

       else{
        $new_pass=Hash::make($password);
        $insert = DB::table('cityadmin')
                  ->insertGetId(['city_id'=>$city_name,'cityadmin_name'=>$cityadmin_name,'cityadmin_image'=>$cityadmin_image,'cityadmin_email'=> $cityadmin_email,'cityadmin_phone'=> $cityadmin_phone, 'cityadmin_pass'=>$new_pass,'cityadmin_address'=>$address,'lat'=>$lat,'lng'=>$lng, 'created_at'=>$created_at]);
                  
            DB::table('incentive_amount')
     		         ->insert(['cityadmin_id'=>$insert]);          
     
     return redirect()->back()->withErrors('successfully Created');

    }
    }
   } 
    public function Editcityadmin(Request $request)
    {
    
       $cityadmin_id=$request->id;
    	 $admin_email=Session::get('admin');
    	 
    	 $getCityAdmin = DB::table('cityadmin')->where('cityadmin_id', '!=', $cityadmin_id)->pluck('city_id')->toArray();
    	 
    	 $city=DB::table('city')
    	        ->whereNotIn('city_id', $getCityAdmin)
                ->get();
                
         $admin=DB::table('admin')
                ->where('admin_email',$admin_email)
                ->first();       
    	 $cityadmin= DB::table('cityadmin')
    	 		  ->where('cityadmin_id',$cityadmin_id)
    	 		  ->first();
    	 $map1 = DB::table('map_API')
             ->first();
         $map = $map1->map_api_key;     
         $mapset = DB::table('map_settings')
                ->first();
        $mapbox = DB::table('mapbox')
                ->first();
    	 return view('admin.cityadmin.Editcityadmin',compact("admin_email","admin","city","cityadmin_id","cityadmin","map1","mapset","mapbox","map"));


    }
    public function Updatecityadmin(Request $request)
    {
    
        $cityadmin_id=$request->id;
        $city_name=$request->city_name;
        $cityadmin_name=$request->cityadmin_name;
        $cityadmin_email=$request->cityadmin_email;
        $cityadmin_phone=$request->cityadmin_phone;
        $password=$request->password1;
        $password2=$request->password2;
        $old_cityadmin_image=$request->old_cityadmin_image;
        $address = $request->cityadmin_address; 
        $addres = str_replace(" ", "+", $address);
        $address1 = str_replace("-", "+", $addres);
        $checkmap = DB::table('map_API')
                  ->first();
         $mapset= DB::table('map_settings')
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
        $date = date('d-m-Y');
        $updated_at = date("d-m-y h:i a");
        $date=date('d-m-y');
        

        $getImage = DB::table('cityadmin')
                     ->where('cityadmin_id',$cityadmin_id)
                    ->first();

        $image = $getImage->cityadmin_image;  
      
       if($password!=$password2){
             return redirect()->back()->withErrors('password are not same');
        }

       else{
        if($request->hasFile('cityadmin_image')){
             if(file_exists($image)){
                unlink($image);
            }
            $cityadmin_image = $request->cityadmin_image;
            $fileName = date('dmyhisa').'-'.$cityadmin_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $cityadmin_image->move('cityadmin_img/images/'.$date.'/', $fileName);
            $cityadmin_image = 'cityadmin_img/images/'.$date.'/'.$fileName;
        }
        else{
            $cityadmin_image = $old_cityadmin_image;
        }
        
         if($password!="" && $password2!="")
        {
            if($password!=$password2){
                return redirect()->back()->withErrors('password are not same');
            }
            else
            {
                $new_pass=Hash::make($password);
                $value=array('city_id'=>$city_name,'cityadmin_name'=>$cityadmin_name,'cityadmin_image'=>$cityadmin_image,'cityadmin_email'=> $cityadmin_email,'cityadmin_phone'=> $cityadmin_phone, 'cityadmin_pass'=>$new_pass,'cityadmin_address'=>$address,'lat'=>$lat,'lng'=>$lng, 'updated_at'=>$updated_at);
            }
            
        }
        else
        {
            $value=array('city_id'=>$city_name,'cityadmin_name'=>$cityadmin_name,'cityadmin_image'=>$cityadmin_image,'cityadmin_email'=> $cityadmin_email, 'cityadmin_phone'=> $cityadmin_phone,'cityadmin_address'=>$address,'lat'=>$lat,'lng'=>$lng, 'updated_at'=>$updated_at);
        }

        $update = DB::table('cityadmin')
                 ->where('cityadmin_id', $cityadmin_id)
                 ->update($value);

        if($update){

             

            return redirect()->back()->withErrors(' updated successfully');
        }
        else{
            return redirect()->back()->withErrors("something wents wrong.");
        }
    }
}    

    public function deletecityadmin(Request $request)
    {
   
        $cityadmin_id=$request->id;

        $getfile=DB::table('cityadmin')
                ->where('cityadmin_id',$cityadmin_id)
                ->first();

        $cityadmin_image=$getfile->cityadmin_image;
        $cityadmin_id=$getfile->cityadmin_id;

        DB::table('vendor')->where('cityadmin_id',$cityadmin_id)->delete();
        
    	$delete=DB::table('cityadmin')->where('cityadmin_id',$request->id)->delete();
        if($delete)
        {
        
            if(file_exists($cityadmin_image)){
                unlink($cityadmin_image);
            }
         
        return redirect()->back()->withErrors('delete successfully');

        }
        else
        {
           return redirect()->back()->withErrors('unsuccessfull delete'); 
        }

    }
    
    public function secretlogin(Request $request)
    {
        $id=$request->id;
        $checkcityadminLogin = DB::table('cityadmin')
    	                   ->where('cityadmin_id',$id)
    	                   ->first();

    	if($checkcityadminLogin){

           session::put('cityadmin',$checkcityadminLogin->cityadmin_email);
           return redirect()->route('cityadmin-index');
         
    	}else
         {
         	return redirect()->route('cityadmin')->withErrors('Something Wents Wrong');
         }
    }
    
    public function vendorlist(Request $request)
    {
        $id=$request->id;
        $admin_email=Session::get('admin');
        $admin=DB::table('admin')
        ->where('admin_email',$admin_email)
        ->first();
        $cityadmin= DB::table('vendor')
       
        ->where('cityadmin_id',$id)
        ->get();
        return view('admin.cityadmin.vendorlist',compact("admin_email","cityadmin","admin"));
    }
    
    public function secretloginvendor(Request $request)
    {
        $id=$request->id;
        $checkcityadminLogin = DB::table('vendor')
    	                   ->where('cityadmin_id',$id)
    	                   ->first();

    	if($checkcityadminLogin){

           session::put('vendor',$checkcityadminLogin->vendor_email);
           return redirect()->route('vendor-index');
         
    	}else
         {
         	return redirect()->route('vendor')->withErrors('Something Wents Wrong');
         }
    }
    public function admincommission(Request $request)
    {
       
         $id=$request->id;
        $admin_email=Session::get('admin');
        $admin=DB::table('admin')
        ->where('admin_email',$admin_email)
        ->first();
        $orders = DB::table('cityadmin')
                            ->join('vendor','cityadmin.cityadmin_id','=','vendor.cityadmin_id')
                            ->join('comission','vendor.vendor_id','comission.vendor_id')
    	                   ->where('vendor.vendor_id',$id)
    	                   ->get();
                         
         	return view('admin.cityadmin.commission',compact("admin_email","admin","orders","id"));
         }

         public function vendorallexcelgenerator(Request $request)
         {
     
            $id=$request->id;
           if(Session::has('admin'))
           {
               
            $admin_email=Session::get('admin');
            $admin=DB::table('admin')
            ->where('admin_email',$admin_email)
            ->first();
            $orders= DB::table('comission')
            ->where('vendor_id',$id)
            ->get();
     
               $orders_array[] = array('ComissionID', 'Vendor Name', 'Order Date', 'Total Product Price','Comission Price','Status','CartID','User Name','Payment Method');
               foreach($orders as $data)
               {
                $orders_array[] = array(
                 'ComissionID'  => $data->com_id,
                 'Vendor Name'    => $data->vendor_name,
                 'Order Date'  => $data->order_date,
                 'Total Product Price'   => $data->total_price,
                 'Comission Price'   => $data->comission_price,
                 'Status'   => $data->status,
                 'Cart ID'   => $data->cart_id,
                 'User Name'   => $data->user_name,
                 'Payment Method' => $data->payment_method
     
      
                );
               }
               Excel::create('commission', function($excel) use ($orders_array){
                 $excel->setTitle('commission');
                 $excel->sheet('commission', function($sheet) use ($orders_array){
                  $sheet->fromArray($orders_array, null, 'A1', false, false);
                 });
              })->download('xlsx');
     
                    }
         else
              {
                 return redirect()->route('adminlogin')->withErrors('please login first');
              }
     
         }
         public function vendorsearchcomission(Request $request)
         {
     
           $this->validate($request,[
              'startdate' => 'required',
              'enddate' => 'required',
          ]);
           $sdate=$request->startdate;
           $edate=$request->enddate;
           $id=$request->id;

             if(Session::has('admin'))
               {
                      $admin_email=Session::get('admin');
             
                         $admin=DB::table('admin')
                         ->where('admin_email',$admin_email)
                         ->first();
                    If($sdate!=null && $edate!=null && $id!=null){
                       $orders = $this->getSearch($sdate,$edate,$id);
     
     
                        return view('admin.cityadmin.commission',compact("admin_email","admin","orders","id"));
     
                    }else{
     
                        $orders= DB::table('comission')
                        ->where('vendor_id',$id)
                        ->get();
     
                      return view('admin.cityadmin.commission',compact("admin_email","admin","orders","id"));
                    }
                 
               }
             else
                  {
                     return redirect()->route('vendorlogin')->withErrors('please login first');
                  }
     
     
         }
         public function getSearch($sdate,$edate,$id)
     {
         if($sdate!=null && $edate!=null && $id!=null ){
             
          $od = DB::table('comission')->where([['order_date','>=',$sdate],['order_date','<=',$edate],['vendor_id',$id]])->get();
            return $od;
         }
          
          
     }

     public function vendorexcelgenerator($startdate,$enddate,$vendor_id)
     {
       $admin_email=Session::get('admin');
     $admin=DB::table('admin')
     ->where('admin_email',$admin_email)
     ->first();
    
     $ordersdata= DB::table('comission')
     ->where([['order_date','>=',$startdate],['order_date','<=',$enddate]])
     ->where('vendor_id',$vendor_id)->orderBy('order_date', 'desc')
    ->get();
    
    $orders_array[] = array('ComissionID', 'Vendor Name', 'Order Date', 'Total Product Price','Comission Price','Status','CartID','User Name','Payment Method');
    foreach($ordersdata as $data)
    {
    $orders_array[] = array(
    'ComissionID'  => $data->com_id,
    'Vendor Name'    => $data->vendor_name,
    'Order Date'  => $data->order_date,
    'Total Product Price'   => $data->total_price,
    'Comission Price'   => $data->comission_price,
    'Status'   => $data->status,
    'Cart ID'   => $data->cart_id,
    'User Name'   => $data->user_name,
    'Payment Method' => $data->payment_method
    
    
    );
    }
    Excel::create('commission', function($excel) use ($orders_array){
    $excel->setTitle('commission');
    $excel->sheet('commission', function($sheet) use ($orders_array){
    $sheet->fromArray($orders_array, null, 'A1', false, false);
    });
    })->download('xlsx');
     }
}
