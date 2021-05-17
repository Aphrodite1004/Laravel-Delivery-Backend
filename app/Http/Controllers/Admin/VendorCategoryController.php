<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class VendorCategoryController extends Controller
{
    public function vendorlist(Request $request)
    {
                 $admin_email=Session::get('admin');
        
                    $admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();
    	         $city= DB::table('vendor_category')
    	                   
    	 		          ->get();
    	         return view('admin.vendor_category.categorylisting',
    	         compact("admin_email","city","admin"));



    }
    public function addvendor(Request $request)
    {
       
         $admin_email=Session::get('admin');
         $admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();
                    $ui = DB::table('UI_Vendor')
                        ->get();
    	return view('admin.vendor_category.add_category',compact("admin_email","admin","ui"));

    }
    public function addnewvendor(Request $request)
    {
         $this->validate($request,[
               'vendor_category' => 'required',
               'vendor_category_arabic' => 'required',
               'city_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
           ]);
    	
    	$vendor_category=$request->vendor_category;
        $vendor_category_arabic = $request->vendor_category_arabic;

        $ui=$request->ui;
        $created_at=date('d-m-Y h:i a');;
        $date = date('d-m-Y');
 
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

        $insert = DB::table('vendor_category')
    				->insert(['category_name'=>$vendor_category, 'category_name_arabic'=>$vendor_category_arabic, 'category_image'=>$city_image,'ui_type'=>$ui]);
        return redirect()->back()->withErrors('successfully');
    }
    
    public function editvendor(Request $request)
    {
   
	    $admin_email=Session::get('admin');
	    $vendor_category_id=$request->vendor_category_id;
	    $city= DB::table('vendor_category')
	            ->where('vendor_category_id',$vendor_category_id)
                ->first();
        $admin=DB::table('admin')
                ->where('admin_email',$admin_email)
                ->first();
        $ui = DB::table('UI_Vendor')->get();
        return view('admin.vendor_category.edit_category',compact("admin_email","city","vendor_category_id","admin","ui"));
    }
    public function updatevendor(Request $request)
    {
        
        
        $vendor_category_id = $request->vendor_category_id;
        $vendor_category=$request->vendor_category;
        $vendor_category_arabic = $request->vendor_category_arabic;

    	$ui=$request->ui;
        $created_at=date('d-m-Y h:i a');;
        $date = date('d-m-Y');
        $old_city_image = $request->old_city_image;

        $getImage = DB::table('vendor_category')
                     ->where('vendor_category_id', $vendor_category_id)
                    ->first();

        $image = $getImage->category_image;  

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

        $update = DB::table('vendor_category')
                        ->where('vendor_category_id', $vendor_category_id)
                        ->update(['category_name'=>$vendor_category, 'category_name_arabic'=>$vendor_category_arabic, 'category_image'=>$city_image,'ui_type'=>$ui]);

        if($update){
            return redirect()->back()->withErrors(' updated successfully');
        }
        else{
            return redirect()->back()->withErrors("something wents wrong.");
        }
    }
     public function deletevendor(Request $request)
    {
        
        $vendor_category_id=$request->vendor_category_id;

        $getfile=DB::table('vendor_category')
                ->where('vendor_category_id',$vendor_category_id)
                ->first();

        $city_image=$getfile->category_image;

    	$delete=DB::table('vendor_category')->where('vendor_category_id',$request->vendor_category_id)->delete();
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

