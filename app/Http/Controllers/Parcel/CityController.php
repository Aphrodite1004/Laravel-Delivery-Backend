<?php

namespace App\Http\Controllers\Parcel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class CityController extends Controller
{
  public function city(Request $request)
    {
    	

        $admin_email=Session::get('vendor');
        $admin=DB::table('vendor')->where('vendor_email',$admin_email)->first();
    	         $city= DB::table('parcel_city')->where('vendor_id',$admin->vendor_id)
    	 		          ->get();
    	         return view('parcel.city.city',compact("admin_email","city","admin"));



    }
    public function Addcity(Request $request)
    {
        $admin_email=Session::get('vendor');
        $admin=DB::table('vendor')->where('vendor_email',$admin_email)->first();
		$map1 = DB::table('map_API')->first();
        $map = $map1->map_api_key;     
        $mapset = DB::table('map_settings')->first();
        $mapbox = DB::table('mapbox')->first();
    	return view('parcel.city.Addcity',compact("admin_email","admin","map1","mapset","mapbox"));

    }
    public function AddInsertcity(Request $request)
    {
			$this->validate(
            $request,
                [
                    'city_name' => 'required',
                    'city_image'=>'required',
                ],
                [
                    'city_name.required' => 'Enter city name.',
                    'city_image.required' => 'choose picture.',
                ]
        );
    
    	$city_name=$request->city_name;
    	$city_image=$request->city_image;
   
        $created_at=date('d-m-Y h:i a');;
        $date = date('d-m-Y');
        $address = str_replace(" ", "+", $city_name);
        $address1 = str_replace("-", "+", $address);
        

		$checkmap = DB::table('map_API')
                  ->first();
		$mapset= DB::table('map_settings')
                ->first();
        

        if($mapset->mapbox == 0 && $mapset->google_map == 1){
			$response = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$address1."&key=".$checkmap->map_api_key));
			$lat = $response->results[0]->geometry->location->lat;
			$lng = $response->results[0]->geometry->location->lng;
        }else{
           $lat = $request->lat;
           $lng = $request->lng;  
        }

        if($request->hasFile('city_image'))
        {
        	      	$city_image = $request->city_image;
			        $fileName = date('dmyhisa').'-'.$city_image->getClientOriginalName();
			        $fileName = str_replace(" ", "-", $fileName);
			        $city_image->move('city/images/'.$date.'/', $fileName);
			        $city_image = 'city/images/'.$date.'/'.$fileName;

      }
      else
      {
      	$city_image = 'N/A';
      }

	$admin_email=Session::get('vendor');
	$admin=DB::table('vendor')->where('vendor_email',$admin_email)->first();
	$insert = DB::table('parcel_city')->insert(['city_name'=>$city_name,'city_image'=>$city_image,'lat'=>$lat, 'lng'=>$lng,'vendor_id'=>$admin->vendor_id, 'created_at'=>$created_at]);
	return redirect()->back()->withErrors('successfully');

}
     
    public function Editcity(Request $request)
{
   
	 $admin_email=Session::get('admin');
	 $city_id=$request->id;
	 $city= DB::table('parcel_city')
	            ->where('city_id',$city_id)
                ->first();
     $admin=DB::table('admin')
                ->where('admin_email',$admin_email)
                ->first();
                 $map1 = DB::table('map_API')
             ->first();
         $map = $map1->map_api_key;     
         $mapset = DB::table('map_settings')
                ->first();
        $mapbox = DB::table('mapbox')
                ->first();
	 return view('parcel.city.Editcity',compact("admin_email","city","city_id","admin","map1","mapset","mapbox"));
}
public function Updatecity(Request $request)
{

   
        $city_id = $request->id;
        $city_name = $request->city_name;
       
        $old_city_image = $request->old_city_image;
        $updated_at = date("d-m-y h:i a");
        $date=date('d-m-y');
         
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
         
        $this->validate(
            $request,
                [
                    'city_name' => 'required',
                    'city_image'=>'required',
                ],
                [
                    'city_name.required' => 'Enter city name.',
                    'city_image.required' => 'choose picture.',
                ]
        );

        $getImage = DB::table('parcel_city')->where('city_id', $city_id)->first();

        $image = $getImage->city_image;  

        if($request->hasFile('city_image')){
             if(file_exists($image)){
                unlink($image);
            }
            $city_image = $request->city_image;
            $fileName = date('dmyhisa').'-'.$city_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $city_image->move('city/image/'.$date.'/', $fileName);
            $city_image = 'city/image/'.$date.'/'.$fileName;
        }
        else{
            $city_image = $old_city_image;
        }
		$admin_email=Session::get('vendor');
		$admin=DB::table('vendor')->where('vendor_email',$admin_email)->first();
        $update = DB::table('parcel_city')
                                ->where('city_id', $city_id)
                                ->update(['city_name'=>$city_name, 'city_image'=>$city_image,'lat'=>$lat, 'lng'=>$lng,'vendor_id'=>$admin->vendor_id, 'updated_at'=>$updated_at]);

        if($update){
            return redirect()->back()->withErrors(' updated successfully');
        }
        else{
            return redirect()->back()->withErrors("something wents wrong.");
        }
    }
	
	
     public function Deletecity(Request $request)
    {
      
        $city_id=$request->id;

        $getfile=DB::table('parcel_city')
                ->where('city_id',$city_id)
                ->first();

        $city_image=$getfile->city_image;

    	$delete=DB::table('parcel_city')->where('city_id',$request->id)->delete();
        if($delete)
        {
        
            if(file_exists($city_image)){
                unlink($city_image);
            }
         
        return redirect()->back()->withErrors('delete successfully');

        }
        else
        {
           return redirect()->back()->withErrors('unsuccessfull delete'); 
        }

    }
	

}

