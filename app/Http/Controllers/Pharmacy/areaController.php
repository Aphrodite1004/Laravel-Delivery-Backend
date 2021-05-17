<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class areaController extends Controller
{
    public function pharmacyarea(Request $request)
    {
       
    	if(Session::has('vendor'))
          {
              

                 $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
    	         $area= DB::table('vendor_area')
    	                  ->join('area','vendor_area.area_id','=','area.area_id')
    	                   ->where('vendor_area.vendor_id', $vendor->vendor_id)
    	                   ->select('area.area_name','vendor_area.vendor_area_id','vendor_area.delivery_charge','vendor_area.cod','vendor_area.area_id')
    	 		          ->get();
    	         return view('pharmacy.area.area',compact("vendor_email","area","vendor"));
          }
        else
             {
                return redirect()->route('vendorlogin')->withErrors('please login first');
             }


    }
    
    public function pharmacyAddarea(Request $request)
    {
        
    if(Session::has('vendor'))
     {
       
         $vendor_email=Session::get('vendor');
         $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
        $area = DB::table('area')
                    ->where('cityadmin_id',$vendor->cityadmin_id)
                    ->get();
                    
    	return view('pharmacy.area.Addarea',compact("vendor_email","vendor","area"));
         }
    else
         {
            return redirect()->route('vendorlogin')->withErrors('please login first');
         }

    }
    
    public function pharmacyAddInsertarea(Request $request)
    {
                   $this->validate(
            $request,
                [
                    'area_id' => 'required',
                    'delivery_charge' => 'required',
                ],
                [
                    'area_id.required' => 'Select area name.',
                    'delivery_charge.required' => 'Enter delivery charge .',
                ]
        );
       
    if(Session::has('vendor'))
     {	
       
    	$area_id=$request->area_id;
    	$cod=$request->cod;
    	$delivery_charge=$request->delivery_charge;
        $created_at=date('d-m-Y h:i a');
        $vendor_id = $request->vendor_id;

      $insert = DB::table('vendor_area')
    				->insert(['area_id'=>$area_id, 
    				'vendor_id'=>$vendor_id, 
    				'delivery_charge'=>$delivery_charge, 
    				'cod'=>0, 
    				]);
     return redirect()->back()->withErrors('successfully');
      }
     else
      {
        return redirect()->route('vendorlogin')->withErrors('please login first');
      }
}
    
    public function pharmacyEditarea(Request $request)
    {
       
    if(Session::has('vendor'))
     {
        
	 $vendor_email=Session::get('vendor');
	 $area_id=$request->id;
	 $area= DB::table('vendor_area')
	            ->where('vendor_area_id',$area_id)
                ->first();
     $vendor=DB::table('vendor')
                ->where('vendor_email',$vendor_email)
                ->first();
     $area1 = DB::table('area')
                   ->where('cityadmin_id',$vendor->cityadmin_id)
                    
                ->get();
	 return view('pharmacy.area.Editarea',compact("vendor_email","area","area_id","vendor","area1"));
      }
    else
      {
        return redirect()->route('vendorlogin')->withErrors('please login first');
      }
}

    public function pharmacyUpdatearea(Request $request)
    {
    if(Session::has('vendor'))
     {
       
                 $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
        $area_id = $request->id;
        $area_name=$request->area_id;
        $cod=$request->cod;
    	$delivery_charge=$request->delivery_charge;
    	$vendor_id=$vendor->vendor_id;
        $updated_at = date("d-m-y h:i a");
       
        $update = DB::table('vendor_area')
                               ->where('vendor_area_id',$area_id)
                                ->update(['area_id'=>$area_name,'vendor_id'=>$vendor_id, 'delivery_charge'=>$delivery_charge, 'cod'=>0]);

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
    
    public function pharmacyDeletearea(Request $request)
    {
        
     if(Session::has('vendor'))
     {   
        $area_id=$request->id;

        $getfile=DB::table('vendor_area')
                ->where('vendor_area_id',$area_id)
                ->first();


    	$delete=DB::table('vendor_area')->where('vendor_area_id',$request->id)->delete();
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
        return redirect()->route('vendorlogin')->withErrors('please login first');
      }

    }
	

}

