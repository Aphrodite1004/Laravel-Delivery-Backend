<?php

namespace App\Http\Controllers\Cityadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class areaController extends Controller
{
    public function area(Request $request)
    {
    	if(Session::has('cityadmin'))
          {
              

                 $cityadmin_email=Session::get('cityadmin');
        
                    $cityadmin=DB::table('cityadmin')
                    ->where('cityadmin_email',$cityadmin_email)
                    ->first();
    	         $area= DB::table('area')
    	                   ->where('cityadmin_id',$cityadmin->cityadmin_id)
    	 		         ->paginate(10);
    	         return view('cityadmin.area.area',compact("cityadmin_email","area","cityadmin"));
          }
        else
             {
                return redirect()->route('cityadminlogin')->withErrors('please login first');
             }


    }
    
    public function Addarea(Request $request)
    {
    if(Session::has('cityadmin'))
     {
         
         $cityadmin_email=Session::get('cityadmin');
         $cityadmin=DB::table('cityadmin')
                    ->where('cityadmin_email',$cityadmin_email)
                    ->first();
         $city_id =  $cityadmin->city_id;
         $city = DB::table('city')
               ->join('cityadmin','city.city_id','=','cityadmin.city_id')
               ->get();
               $map1 = DB::table('map_API')
             ->first();
         $map = $map1->map_api_key;     
         $mapset = DB::table('map_settings')
                ->first();
        $mapbox = DB::table('mapbox')
                ->first();
                    
    	return view('cityadmin.area.Addarea',compact("cityadmin_email","cityadmin","city","map1","mapset","mapbox","map"));
         }
    else
         {
            return redirect()->route('cityadminlogin')->withErrors('please login first');
         }

    }
    
    public function AddInsertarea(Request $request)
    {
                   $this->validate(
            $request,
                [
                    'area_name' => 'required',
                   
                ],
                [
                    'area_name.required' => 'Enter area name.',
                    
                ]
        );
    if(Session::has('cityadmin'))
     {	
         
    	$area_name=$request->area_name;
    	$delivery_charge=$request->delivery_charge;
    	
        $created_at=date('d-m-Y h:i a');
        $cityadmin_email=Session::get('cityadmin');
         $cityadmin=DB::table('cityadmin')
                    ->where('cityadmin_email',$cityadmin_email)
                    ->first();
        $cityadmin_id = $cityadmin->cityadmin_id;
        
        $checkmap = DB::table('map_API')
                  ->first();
         $mapset= DB::table('map_settings')
                ->first();
        

        if($mapset->mapbox == 0 && $mapset->google_map == 1){        
        $response = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($area_name)."&key=".$checkmap->map_api_key));
        
         $lat = $response->results[0]->geometry->location->lat;
         $lng = $response->results[0]->geometry->location->lng;
        }
        else{
           $lat = $request->lat;
           $lng = $request->lng;  
        }

      $insert = DB::table('area')
    				->insert(['area_name'=>$area_name, 'cityadmin_id'=>$cityadmin_id, 'delivery_charge'=>0, 'created_at'=>$created_at]);
     return redirect()->back()->withErrors('successfully');
      }
     else
      {
        return redirect()->route('cityadminlogin')->withErrors('please login first');
      }
}
    
    public function Editarea(Request $request)
    {
    if(Session::has('cityadmin'))
     {
        
	 $cityadmin_email=Session::get('cityadmin');
	 $area_id=$request->id;
	 $area= DB::table('area')
	            ->where('area_id',$area_id)
                ->first();
     $cityadmin=DB::table('cityadmin')
                ->where('cityadmin_email',$cityadmin_email)
                ->first();
                
        $map1 = DB::table('map_API')
             ->first();
         $map = $map1->map_api_key;     
         $mapset = DB::table('map_settings')
                ->first();
        $mapbox = DB::table('mapbox')
                ->first();        
	 return view('cityadmin.area.Editarea',compact("cityadmin_email","area","area_id","cityadmin","map1","mapset","mapbox"));
      }
    else
      {
        return redirect()->route('cityadminlogin')->withErrors('please login first');
      }
}

    public function Updatearea(Request $request)
    {
    if(Session::has('cityadmin'))
     {
         
        $area_id = $request->id;
        $area_name=$request->area_name;
        
		
    	$cityadmin_id=$request->cityadmin_id;
        $updated_at = date("d-m-y h:i a");
       $checkmap = DB::table('map_API')
                  ->first();
         $mapset= DB::table('map_settings')
                ->first();
                if($mapset->mapbox == 0 && $mapset->google_map == 1){        
        $response = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($area_name)."&key=".$checkmap->map_api_key));
        
         $lat = $response->results[0]->geometry->location->lat;
         $lng = $response->results[0]->geometry->location->lng;
        }
        else{
           $lat = $request->lat;
           $lng = $request->lng;  
        }
       
        $update = DB::table('area')
                                ->where('area_id', $area_id)
                                ->update(['area_name'=>$area_name,'cityadmin_id'=>$cityadmin_id, 'updated_at'=>$updated_at]);

        if($update){

             

            return redirect()->back()->withErrors(' updated successfully');
        }
        else{
            return redirect()->back()->withErrors("something wents wrong.");
        }
      }
     else
      {
        return redirect()->route('cityadminlogin')->withErrors('please login first');
      }    
    }
    
    public function Deletearea(Request $request)
    {
        
     if(Session::has('cityadmin'))
     {   
    
        $area_id=$request->id;

        $getfile=DB::table('area')
                ->where('area_id',$area_id)
                ->first();
                
                 $delivery_boy =   DB::table('delivery_boy_area')
                ->where('area_id',$area_id)
                ->get();  
                
                  foreach($delivery_boy as $delivery_boy1) {
            
            $dboy_id = $delivery_boy1->delivery_boy_id;
            
            
               $getdelivery_boy =   DB::table('delivery_boy_area')
                            ->where('delivery_boy_id',$dboy_id )
                            ->get();  
            
            if(count($getdelivery_boy)==1){
            $delet = DB::table('delivery_boy')
                            ->where('delivery_boy_id',$dboy_id )
                            ->delete(); 
            }
            }
             
            
                $delete=DB::table('area')->where('area_id',$request->id)->delete();
    	        DB::table('delivery_boy_area')->where('area_id',$request->id)->delete();
        if($delete)
        {
        
                 
        return redirect()->back()->withErrors('delete successfully');

        }
        else
        {
           return redirect()->back()->withErrors('unsuccessfull delete'); 
        }

      }
    else
      {
        return redirect()->route('cityadminlogin')->withErrors('please login first');
      }

    }
	

}

