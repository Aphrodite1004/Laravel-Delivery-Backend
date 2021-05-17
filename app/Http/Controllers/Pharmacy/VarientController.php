<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use DB;
use Session;

class VarientController extends Controller
{
    public function varient(Request $request)
    {
         $id = $request->id;
          $p= DB::table('product')
                 ->where('product_id', $id)
                ->first();
         
    	 
    	$vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
    	 
        $productvarient= DB::table('resturant_variant')
                 ->where('product_id', $id)
                ->get();
        return view('pharmacy.product.varient.show_varient',compact("vendor_email","productvarient","vendor","id"));
    }
    
     public function Addproductvariant(Request $request)
    {
        $id = $request->id;  
        $p= DB::table('resturant_product')
                 ->where('product_id', $id)
                ->first();
         
    	 
       $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
    	
        $product= DB::table('resturant_variant')
                 ->where('product_id', $id)
                ->get();
  
         return view('pharmacy.product.varient.addvarient',compact("vendor_email","vendor","id"));
    }
    
    
   public function AddNewproductvariant(Request $request)
    {
         $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        $vendor_id=$vendor->vendor_id;
         
        $id = $request->id;
        $strick_price = $request->strick_price;
        $price=$request->price;
       
        $unit=$request->unit;
        $quantity=$request->quantity;
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');

          
        $this->validate(
            $request,
                [
                    
                    'quantity'=>'required',
                    'unit'=>'required',
                    'price'=>'required',
                    
                ],
                [
                    
                    'mrp.required'=>'enter product MRP',
                    
                    'quantity.required'=>'enter quantity',
                    'unit.required'=>'enter unit'
                ]
        );
                
        
        
        $insert =  DB::table('resturant_variant')
                        ->insert(['product_id'=>$id,'strick_price'=>$strick_price, 'price'=>$price, 'unit'=>$unit, 'quantity'=>$quantity, 'vendor_id'=>$vendor_id]);
     if($insert){
         return redirect()->back()->withSuccess('Successfully Added');
     }
     else{
     return redirect()->back()->withErrors('something went wrong');
     }
	
    }
    
    public function Editproductvariant(Request $request)
    {
 
       $variant_id=$request->id;

    	 $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
    	 
        $product= DB::table('resturant_variant')
                 ->where('variant_id', $variant_id)
                ->first();
                
        $p= DB::table('resturant_product')
                 ->where('product_id', $product->product_id)
                ->first();
         
    	 return view('pharmacy.product.varient.Editvarient',compact("vendor_email","vendor","product","variant_id"));
   }
    public function Updateproductvariant(Request $request)
   {
     
        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        $vendor_id=$vendor->vendor_id;
         
        $variant_id = $request->variant_id;
        $strick_price = $request->strick_price;
        $price=$request->price;
        $unit=$request->unit;
        $quantity=$request->quantity;
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');

       
       $varient_update = DB::table('resturant_variant')
                            ->where('variant_id', $variant_id)
                            ->update(['strick_price'=>$strick_price, 'price'=>$price, 'unit'=>$unit, 'quantity'=>$quantity,'vendor_id'=>$vendor_id]);

        if($varient_update){

            return redirect()->back()->withErrors('Updated Successfully');
        }
        else{
            return redirect()->back()->withErrors("Something Wents Wrong.");
        }
    }
  public function deleteproductvariant(Request $request)
    {
        $variant_id=$request->id;

    	$delete=DB::table('resturant_variant')->where('variant_id',$request->id)->delete();
        if($delete)
        {
        
        return redirect()->back()->withSuccess('Deleted Successfully');

        }
        else
        {
           return redirect()->back()->withErrors('Unsuccessfull Delete'); 
        }

    }
	
    
}
