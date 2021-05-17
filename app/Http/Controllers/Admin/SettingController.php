<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\WebSetting;
use DB;
use Auth;
use Session;
use Hash;


class SettingController extends Controller
{
       public function mapsettings(Request $request)
    {
        
        $admin_email=Session::get('admin');
        $admin=DB::table('admin')
        ->where('admin_email',$admin_email)
        ->first();
                
          $g = DB::table('map_API')
                ->first();   
          $m = DB::table('mapbox')
                ->first(); 
          $mset = DB::table('map_settings')
                ->first();       
         return view('admin.map',compact("admin_email","admin",'g','m','mset'));
    }
 
 
 
 
    public function updategooglemap(Request $request)
    {
        
        $api_key = $request->api;
        $this->validate(
            $request,
                [
                    'api'=>'required',
                ],
                [
                    'api.required' =>'Enter api key',
                ]
        );
        
        
        $check = DB::table('map_API')
               ->first();
       
    
      if($check){
        $update = DB::table('map_API')
                ->update(['map_api_key'=> $api_key]);
    
      }
      else{
          $update = DB::table('map_API')
                ->insert(['map_api_key'=> $api_key]);
               
      }
       $ue = DB::table('map_settings')
                ->update(['mapbox'=> 0,'google_map'=> 1]);
     if($ue){
         
        return redirect()->back()->withSuccess('Updated Successfully');
     }
     else{
         return redirect()->back()->withErrors('Nothing to Update');
     }
    }
    
    public function updatemapbox(Request $request)
    {
        
        $mapbox = $request->mapbox;
        $this->validate(
            $request,
                [
                    'mapbox' => 'required'
                ],
                [
                    'mapbox.required' => 'Enter Mapbox API.',
                ]
        );
        
        
        $check = DB::table('mapbox')
               ->first();
       
    
      if($check){
        

        $update = DB::table('mapbox')
                ->update(['mapbox_api'=> $mapbox]);
    
      }
      else{
          $update = DB::table('mapbox')
                ->insert(['mapbox_api'=> $mapbox]);
      }
       $ue = DB::table('map_settings')
            ->update(['mapbox'=> 1,'google_map'=> 0]); 
                
     if($ue){
        
        return redirect()->back()->withSuccess('Updated Successfully');
     }
     else{
         return redirect()->back()->withErrors('Nothing to Update');
     }
    }
}