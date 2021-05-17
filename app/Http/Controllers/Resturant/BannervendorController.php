<?php

namespace App\Http\Controllers\Resturant;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use DB;
use Session;

class BannervendorController extends Controller
{
    public function resturantbannervendor(Request $request)
         {
     if(Session::has('vendor'))
     {   
        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        $banner= DB::table('banner_resturant')
        ->where('banner_resturant.vendor_id',$vendor->vendor_id)
        ->get();
        return view('resturant.banner.bannervendor',compact("vendor_email","banner","vendor"));
        
         }
    else
         {
            return redirect()->route('vendorlogin')->withErrors('please login first');
         }
    }
    
    public function resturantAddbannervendor(Request $request)
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
         return view('resturant.banner.addbanner',compact("vendor_email","category","vendor"));
         }
    else
         {
            return redirect()->route('vendorlogin')->withErrors('please login first');
         }
    }
    
    public function resturantAddNewbannervendor(Request $request)
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
        $banner_id=$request->id;
        $category_name=$request->bannerloc_id;
        $banner_name=$request->banner_name;
        $keyword=$request->banner_keyword;
        $old_banner_image=$request->old_banner_image;
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');
        $banner_image = $request->banner_image;
        $fileName = date('dmyhisa').'-'.$banner_image->getClientOriginalName();
        $fileName = str_replace(" ", "-", $fileName);
        $banner_image->move('banner/images/'.$date.'/', $fileName);
        $banner_image = 'banner/images/'.$date.'/'.$fileName;


        $insert = DB::table('banner_resturant')
                  ->insert(['vendor_id'=>$vendor_id,'cat_id'=>$category_name,'banner_image'=>$banner_image]);
     
     return redirect()->back()->withErrors('Added successfully');
         }
    else
         {
            return redirect()->route('vendorlogin')->withErrors('please login first');
         }

    }
	
    public function resturantEditbannervendor(Request $request)
         {
            
     if(Session::has('vendor'))
      {	
  
       $banner_id=$request->id;
    	 $vendor_email=Session::get('vendor');
    	 
         $vendor=DB::table('vendor')
                ->where('vendor_email',$vendor_email)
                ->first();       
    	 $banner= DB::table('banner_resturant')
    	 		  ->where('banner_id',$banner_id)
    	 		  ->first();
    	 $category=DB::table('resturant_category')
    	        ->where('vendor_id',$vendor->vendor_id)
                ->get();		  
    	 return view('resturant.banner.Editbanner',compact("vendor_email","vendor","category","banner_id","banner"));
         }
    else
         {
            return redirect()->route('vendorlogin')->withErrors('please login first');
         }


    }
    
    public function resturantUpdatebannervendor(Request $request)
         {
           
      if(Session::has('vendor'))
      {
        $banner_id=$request->id;
        $category_name=$request->bannerloc_id;
        $banner_name=$request->banner_name;
        $keyword=$request->banner_keyword;
        $old_banner_image=$request->old_banner_image;
        $date = date('d-m-Y');
        $updated_at = date("d-m-y h:i a");
        $date=date('d-m-y');
    

        $getImage = DB::table('banner_resturant')
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

        $update = DB::table('banner_resturant')
                 ->where('banner_id', $banner_id)
                 ->update(['cat_id'=>$category_name,'banner_image'=>$banner_image]);

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
    
    public function resturantdeletebannervendor(Request $request)
         {
     if(Session::has('vendor'))
     {
   
        $banner_id=$request->id;

        $getfile=DB::table('banner_resturant')
                ->where('banner_id',$banner_id)
                ->first();

        $banner_image=$getfile->banner_image;

    	$delete=DB::table('banner_resturant')->where('banner_id',$request->id)->delete();
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
