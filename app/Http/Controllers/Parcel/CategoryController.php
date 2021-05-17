<?php

namespace App\Http\Controllers\Parcel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function category(Request $request)
    {
     if(Session::has('vendor'))
     {
        $vendor_email=Session::get('vendor');
    	
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();	
        
        $vendorCategory = DB::table('resturant_category')
                         ->where('vendor_id',$vendor->vendor_id)
    			         ->paginate(10);
        return view('parcel.category.show_cat',compact("vendorCategory", "vendor_email", "vendor"));
     }
	else
	 {
			return redirect()->route('vendorlogin')->withErrors('please login first');
	 }	
    }
    
     public function resturantAddCategory(Request $request)
    {
     if(Session::has('vendor'))
      {
        $vendor_email=Session::get('vendor');
    	$vendorCategory = DB::table('resturant_category')
    			         ->get();		         
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        return view('parcel.category.add_category',compact("vendorCategory", "vendor_email", "vendor"));
     }
	else
	 {
			return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
    }
    
     public function resturantAddNewCategory(Request $request)
    {
     if(Session::has('vendor'))
      {
    
        $category_name = $request->category_name;
        $vendor_id = $request->vendor_id;
        $created_at = Carbon::now();
        $updated_at = Carbon::now();
        $date=date('d-m-Y');
 
        
        $this->validate(
            $request,
                [
                    'category_name' => 'required',
                ],
                [
                    'category_name.required' => 'Enter category name.',
                ]
        );
    
        $insertCategory = DB::table('resturant_category')
                            ->insert([
                                'vendor_id'=>$vendor_id,
                                'cat_name'=>$category_name
                            ]);
        
        if($insertCategory){
            return redirect()->back()->withErrors('category added successfully');
        }
        else{
            return redirect()->back()->withErrors("Something wents wrong");
        }
      
     }
	else
	 {
			return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
    }
    
    public function resturantEditCategory(Request $request)
    {
       
     if(Session::has('vendor'))
      {
       
    	$category_id = $request->category_id;

    	$category = DB::table('resturant_category')
        	          ->where('resturant_cat_id', $category_id)
        			  ->first();
        $vendor_email=Session::get('vendor');
        	
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
       

        return view('parcel.category.update_cat',compact("category","vendor_email","vendor"));
		 }
	else
		 {
			return redirect()->route('vendorlogin')->withErrors('please login first');
		 }
    }

    public function resturantUpdateCategory(Request $request)
    {
     if(Session::has('vendor'))
     {	
        $category_id = $request->category_id;
        $category_name = $request->category_name;
        $vendor_id = $request->vendor_id;
        $updated_at = Carbon::now();
        $date = date('d-m-Y');
 
        $this->validate(
            $request,
                [
                    'category_name' => 'required',
                ],
                [
                    'category_name.required' => 'Enter category name.',
                ]
        );

    	

        $updateCategory = DB::table('resturant_category')
                            ->where('resturant_cat_id', $category_id)
                            ->update([
                                 'vendor_id'=>$vendor_id,
                                'cat_name'=>$category_name,
                            ]);
        
        if($updateCategory){
            return redirect()->back()->withErrors('category updated successfully');
        }
        else{
            return redirect()->back()->withErrors("Something wents wrong");
        }
       
			 }
		else
			 {
				return redirect()->route('vendorlogin')->withErrors('please login first');
			 }
    }
    
    
    
     public function resturantDeleteCategory(Request $request)
    {
     if(Session::has('vendor'))
      {
       
        $category_id=$request->category_id;
    	$delete=DB::table('resturant_category')->where('resturant_cat_id',$request->category_id)->delete();

        if($delete)
        {
        
         
        return redirect()->back()->withErrors('Delete successfully');

        }
        else
        {
           return redirect()->back()->withErrors('unsuccessfull delete'); 
        }
    }else{
        return redirect()->back()->withErrors('Delete successfully');
    }
			 
	

    }

}