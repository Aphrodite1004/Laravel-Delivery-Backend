<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class AreabannerController extends  Controller
{
    public function areavendor(Request $request)
    {
    	if(Session::has('vendor'))
          {
              

                 $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
    	         $area= DB::table('area')
    	 		          ->get();
    	         return view('vendor.area_vendor.area',compact("vendor_email","area","vendor"));
          }
        else
             {
                return redirect()->route('vendorlogin')->withErrors('please login first');
             }


    }
    
     public function Addareavendor(Request $request)
    {
       
    if(Session::has('vendor'))
     {
         $vendor_email=Session::get('vendor');
         $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
                  $city= DB::table('city')
                ->join ('vendor', 'city.city_id', '=', 'vendor.vendor_id')
                ->where('vendor_id',$vendor->vendor_id)
                ->get();           
    	return view('vendor.area_vendor.Addarea',compact("vendor_email","vendor","city"));
         }
    else
         {
            return redirect()->route('vendorlogin')->withErrors('please login first');
         }

    }
    
     public function AddInsertareavendor(Request $request)
    {
       
    if(Session::has('vendor'))
     {	
         $vendor_email=Session::get('vendor');
         $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
        $vendor_id=$vendor->vendor_id;
       
    	$area_name=$request->area_name;
    	$cod=$request->cod;
    	$delivery_charge=$request->delivery_charge;
    	$city_id=$request->vendor_id;
        $created_at=date('d-m-Y h:i a');
       

      $insert = DB::table('area')
    				->insert(['area_name'=>$area_name,'vendor_id'=>$vendor_id, 'delivery_charge'=>$delivery_charge, 'cod'=>$cod, 'created_at'=>$created_at]);
     return redirect()->back()->withErrors('Added Successfully');
      }
     else
      {
        return redirect()->route('vendorlogin')->withErrors('please login first');
      }
}

    public function Editareavendor(Request $request)
    {
       
    if(Session::has('vendor'))
     {
       
	 $vendor_email=Session::get('vendor');
	 $area_id=$request->id;
	 $area= DB::table('area')
	            ->where('area_id',$area_id)
                ->first();
     $vendor=DB::table('vendor')
                ->where('vendor_email',$vendor_email)
                ->first();
      $city= DB::table('city')
                ->join ('vendor', 'city.city_id', '=', 'vendor.vendor_id')
                ->where('vendor_id',$vendor->vendor_id)
                ->get();                    
	 return view('vendor.area_vendor.Editarea',compact("vendor_email","area","area_id","vendor","city"));
      }
    else
      {
        return redirect()->route('vendorlogin')->withErrors('please login first');
      }
}

    public function Updateareavendor(Request $request)
    {
       
    if(Session::has('vendor'))
     {
          $vendor_email=Session::get('vendor');
         $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
        $vendor_id=$vendor->vendor_id;
       
        $area_id = $request->id;
        $area_name=$request->area_name;
        $cod=$request->cod;
    	$delivery_charge=$request->delivery_charge;
    	$city_id=$request->vendor_id;
        $updated_at = date("d-m-y h:i a");
       
        $update = DB::table('area')
                            ->where('area_id', $area_id)
                            ->update(['area_name'=>$area_name,'vendor_id'=>$vendor_id, 'delivery_charge'=>$delivery_charge, 'cod'=>$cod, 'updated_at'=>$updated_at]);

        if($update){

             

            return redirect()->back()->withErrors(' updated successfully');
        }
        else{
            return redirect()->back()->withErrors("something wents wrong.");
        }
      }
     else
      {
        return redirect()->route('vendorlogin')->withErrors('please login first');
      }    
    }
    
     public function Deleteareavendor(Request $request)
    {
      
        
     if(Session::has('vendor'))
     {   
    
        $area_id=$request->id;

        $getfile=DB::table('area')
                ->where('area_id',$area_id)
                ->first();

      

    	$delete=DB::table('area')->where('area_id',$request->id)->delete();
        if($delete){

         
        return redirect()->back()->withErrors('delete successfully');

        }
        else
        {
           return redirect()->back()->withErrors('unsuccessfull delete'); 
        }

      }
    else
      {
        return redirect()->route('vendorlogin')->withErrors('please login first');
      }

    }
	

}

