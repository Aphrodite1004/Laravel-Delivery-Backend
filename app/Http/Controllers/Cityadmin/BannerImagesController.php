<?php

namespace App\Http\Controllers\Cityadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class BannerImagesController extends Controller
{
    public function banner(Request $request)
    {
    	

                 $admin_email=Session::get('cityadmin');
                    $cityadmin=DB::table('cityadmin')
                    ->where('cityadmin_email',$cityadmin_email)
                    ->first();
    	         $city= DB::table('banner_resturant')
    	 		          ->get();
    	         return view('cityadmin.banner.bannerlist',compact("admin_email","city"));



    }
    public function addbanner(Request $request)
    {
      
         $admin_email=Session::get('cityadmin');
        $cityadmin=DB::table('cityadmin')
                    ->where('cityadmin_email',$admin_email)
                    ->first();
           $vendor = DB::table('vendor')
                    ->where('cityadmin_id',$cityadmin->cityadmin_id)
                    ->where('vendor_category_id','2')
                      ->get();
    	return view('cityadmin.banner.addbanner',compact("admin_email","vendor","cityadmin"));

    }
    public function addnewbanner(Request $request)
    {
    	$vendor_id=$request->vendor_id;
    	$date = date('d-m-Y');
        
          $this->validate(
            $request,
                [
                    
                   
                    'city_image'=>'required|mimes:jpeg,png,jpg|max:2048',
                ],
                [
                    
                    
                    'city_image.required'=>'Image Required',

                ]
        );
         
        if($request->hasFile('city_image'))
        {
        	      	$city_image = $request->city_image;
			        $fileName = date('dmyhisa').'-'.$city_image->getClientOriginalName();
			        $fileName = str_replace(" ", "-", $fileName);
			        $city_image->move('images/admin/admin_banner/'.$date.'/', $fileName);
			        $city_image = 'images/admin/admin_banner/'.$date.'/'.$fileName;

      }
      else
      {
      	$city_image = 'N/A';
      }

      $insert = DB::table('banner_resturant')
    				->insert(['banner_image'=>$city_image,'vendor_id'=>$vendor_id]);
     return redirect()->back()->withErrors('successfully');

}
     
    public function editbanner(Request $request)
{
    
	 $admin_email=Session::get('admin');
	 $banner_id=$request->banner_id;
	 
	    $vendor = DB::table('vendor')
            ->get();
	 
	 $city= DB::table('admin_banner')
	            ->where('banner_id',$banner_id)
                ->first();
                
 
     $admin=DB::table('admin')
                ->where('admin_email',$admin_email)
                ->first();
	 return view('admin.banner.edit_banner',compact("admin_email","city","banner_id","admin","vendor"));
}
public function updatebanner(Request $request)
{
    
    	$banner_id=$request->banner_id;
    	$banner_name=$request->banner_name;
    	$date = date('d-m-Y');
         
    

        $getImage = DB::table('admin_banner')
                     ->where('banner_id', banner_id)
                    ->first();

        $image = $getImage->banner_image;  

        if($request->hasFile('city_image')){
             if(file_exists($image)){
                unlink($image);
            }
            $city_image = $request->city_image;
            $fileName = date('dmyhisa').'-'.$city_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $city_image->move('images/admin/admin_banner/'.$date.'/', $fileName);
            $city_image = 'images/admin/admin_banner/'.$date.'/'.$fileName;
        }
        else{
            $city_image = $old_city_image;
        }

        $update = DB::table('admin_banner')
                                ->where('banner_id', $banner_id)
                                ->update(['banner_image'=>$city_image,'vendor_id'=>$vendor_id,'banner_name'=>$banner_name]);

        if($update){

             

            return redirect()->back()->withErrors(' updated successfully');
        }
        else{
            return redirect()->back()->withErrors("something wents wrong.");
        }
    }
     public function deletebanner(Request $request)
    {
        
        $banner_id=$request->id;
      
        $getfile=DB::table('admin_banner')
                 ->where('banner_id',$banner_id)
                ->first();

        $city_image=$getfile->banner_image;

    	$delete=DB::table('admin_banner')->where('banner_id',$request->id)->delete();
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

