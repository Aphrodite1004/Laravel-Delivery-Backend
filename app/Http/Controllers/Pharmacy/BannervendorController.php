<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use DB;
use Session;

class BannervendorController extends Controller
{
    public function pharmacybannervendor(Request $request)
         {
     if(Session::has('vendor'))
     {   
        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        $banner= DB::table('pharmacy_banner')
        ->where('vendor_id',$vendor->vendor_id)
        ->get();
        return view('pharmacy.banner.bannervendor',compact("vendor_email","banner","vendor"));
        
         }
    else
         {
            return redirect()->route('vendorlogin')->withErrors('please login first');
         }
    }
    
    public function pharmacyAddbannervendor(Request $request)
         {
     if(Session::has('vendor'))
     {
       
        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        $category= DB::table('resturant_category')
                ->where('vendor_id',$vendor->vendor_id)
                ->get();
         return view('pharmacy.banner.addbanner',compact("vendor_email","category","vendor"));
         }
    else
         {
            return redirect()->route('vendorlogin')->withErrors('please login first');
         }
    }
    
    public function pharmacyAddNewbannervendor(Request $request)
         {
                  $this->validate($request,[
               'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

           ]);
            
      if(Session::has('vendor'))
     {
      
        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        $vendor_id = $vendor->vendor_id ;
        $old_banner_image=$request->old_banner_image;
        $date = date('d-m-Y');
        $cat_id = $request->bannerloc_id;
        $created_at=date('d-m-Y h:i a');
        $banner_image = $request->banner_image;
        $fileName = date('dmyhisa').'-'.$banner_image->getClientOriginalName();
        $fileName = str_replace(" ", "-", $fileName);
        $banner_image->move('banner/images/'.$date.'/', $fileName);
        $banner_image = 'banner/images/'.$date.'/'.$fileName;


        $insert = DB::table('pharmacy_banner')
                  ->insert(['vendor_id'=>$vendor_id,'banner_image'=>$banner_image,'cat_id'=>$cat_id]);
     
     return redirect()->back()->withErrors('Added successfully');
         }
    else
         {
            return redirect()->route('vendorlogin')->withErrors('please login first');
         }

    }
	
    public function pharmacyEditbannervendor(Request $request)
         {
     if(Session::has('vendor'))
      {	
  
       $banner_id=$request->id;
    	 $vendor_email=Session::get('vendor');
    	 
         $vendor=DB::table('vendor')
                ->where('vendor_email',$vendor_email)
                ->first();       
    	 $banner= DB::table('pharmacy_banner')
    	 		  ->where('banner_id',$banner_id)
    	 		  ->first();
    	 $category=DB::table('resturant_category')
    	        ->where('vendor_id',$vendor->vendor_id)
                ->get();		  
    	 return view('pharmacy.banner.Editbanner',compact("vendor_email","vendor","category","banner_id","banner"));
         }
    else
         {
            return redirect()->route('vendorlogin')->withErrors('please login first');
         }


    }
    
    public function pharmacyUpdatebannervendor(Request $request)
         {
      if(Session::has('vendor'))
      {
        $banner_id=$request->id;
        $old_banner_image=$request->old_banner_image;
        $date = date('d-m-Y');
        $updated_at = date("d-m-y h:i a");
        $date=date('d-m-y');
         $cat_id = $request->bannerloc_id;
    

        $getImage = DB::table('pharmacy_banner')
                     ->where('banner_id',$banner_id)
                    ->first();

        $image = $getImage->banner_image;  

        if($request->hasFile('banner_image')){
             if(file_exists($image)){
                unlink($image);
            }
            $banner_image = $request->banner_image;
            $fileName = date('dmyhisa').'-'.$banner_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $banner_image->move('banner/images/'.$date.'/', $fileName);
            $banner_image = 'banner/images/'.$date.'/'.$fileName;
        }
        else{
            $banner_image = $old_banner_image;
        }

        $update = DB::table('pharmacy_banner')
                 ->where('banner_id', $banner_id)
                 ->update(['banner_image'=>$banner_image,'cat_id'=>$cat_id]);

        if($update){

             

            return redirect()->back()->withErrors('Updated successfully');
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
    
    public function pharmacydeletebannervendor(Request $request)
         {
     if(Session::has('vendor'))
     {
        $banner_id=$request->id;

        $getfile=DB::table('pharmacy_banner')
                ->where('banner_id',$banner_id)
                ->first();

        $banner_image=$getfile->banner_image;

    	$delete=DB::table('pharmacy_banner')->where('banner_id',$request->id)->delete();
        if($delete)
        {
        
            if(file_exists($banner_image)){
                unlink($banner_image);
            }
         
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
