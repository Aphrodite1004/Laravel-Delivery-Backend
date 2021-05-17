<?php

namespace App\Http\Controllers\Parcel;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use DB;
use Session;

class AddonController extends Controller
{
    public function addon(Request $request)
    {
         $id = $request->id;
          $p= DB::table('product')
                 ->where('product_id', $id)
                ->first();
         
    	 
    	$vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
    	 
        $product= DB::table('restaurant_addons')
                 ->where('product_id', $id)
                ->get();
        return view('parcel.product.addon.show_addon',compact("vendor_email","product","vendor","id"));
    }
    
     public function Addproductaddon(Request $request)
    {
        $id = $request->id;  
        $p= DB::table('resturant_product')
                 ->where('product_id', $id)
                ->first();
         
    	 
       $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
    	
        $product= DB::table('restaurant_addons')
                 ->where('product_id', $id)
                ->get();
  
         return view('parcel.product.addon.addaddon',compact("vendor_email","vendor","id"));
    }
    
    
   public function AddNewproductaddon(Request $request)
    {
         $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        $vendor_id=$vendor->vendor_id;
         
        $id = $request->id;
        $addon_name = $request->addon_name;
        $addon_price=$request->addon_price;
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');

          
        $this->validate(
            $request,
                [
                    
                    'addon_name'=>'required',
                    'addon_price'=>'required',
                    
                ],
                [
                    
                    'addon_name.required'=>'enter Addon Name',
                    
                    'addon_price.required'=>'enter price'
                ]
        );
                
        
        
        $insert =  DB::table('restaurant_addons')
                        ->insert(['product_id'=>$id,'addon_name'=>$addon_name, 'addon_price'=>$addon_price, 'vendor_id'=>$vendor_id]);
     if($insert){
         return redirect()->back()->withErrors('Successfully Added');
     }
     else{
     return redirect()->back()->withErrors('something went wrong');
     }
	
    }
    
    public function Editproductaddon(Request $request)
    {
 
       $addon_id=$request->id;

    	 $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
    	 
        $product= DB::table('restaurant_addons')
                 ->where('addon_id', $addon_id)
                ->first();
                
        $p= DB::table('resturant_product')
                 ->where('product_id', $product->product_id)
                ->first();
         
    	 return view('parcel.product.addon.Editaddon',compact("vendor_email","vendor","product","addon_id"));
   }
    public function Updateproductaddon(Request $request)
   {
     
        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        $vendor_id=$vendor->vendor_id;
         
        $addon_id = $request->addon_id;
        $addon_name = $request->addon_name;
        $addon_price=$request->addon_price;
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');

       
       $varient_update = DB::table('restaurant_addons')
                            ->where('addon_id', $addon_id)
                            ->update(['addon_name'=>$addon_name, 'addon_price'=>$addon_price, 'vendor_id'=>$vendor_id]);

        if($varient_update){

            return redirect()->back()->withErrors('Updated Successfully');
        }
        else{
            return redirect()->back()->withErrors("Something Wents Wrong.");
        }
    }
  public function deleteproductaddon(Request $request)
    {
        $addon_id=$request->id;

    	$delete=DB::table('restaurant_addons')->where('addon_id',$request->id)->delete();
        if($delete)
        {
        
        return redirect()->back()->withErrors('Deleted Successfully');

        }
        else
        {
           return redirect()->back()->withErrors('Unsuccessfull Delete'); 
        }

    }
	
    
}
