<?php

namespace App\Http\Controllers\Vendor;

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
        $product= DB::table('product_varient')
                ->where('product_id', $id)
                ->get();
        return view('vendor.product.varient.show_varient',compact("vendor_email","product","vendor","id"));
    }
    
     public function Addproductvariant(Request $request)
    {
        $id = $request->id;  
        $p= DB::table('product')
                 ->where('product_id', $id)
                ->first();
         
    	 
       $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
    	
        $product= DB::table('product_varient')
                 ->where('product_id', $id)
                ->get();
  
         return view('vendor.product.varient.addvarient',compact("vendor_email","vendor","id"));
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
        $stock=$request->stock;
        $unit=$request->unit;
        $quantity=$request->quantity;
        $description =$request->description;
        $description_arabic =$request->description_arabic;
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');

          
        $this->validate(
            $request,
                [
                    
                    'description'=>'required',
                    'description_arabic'=>'required',
                    'quantity'=>'required',
                    'unit'=>'required',
                    'price'=>'required',
                    'varient_image'=>'required|mimes:jpeg,png,jpg|max:1000',
                ],
                [
                    
                    'description.required'=>'enter description about product',
                    'description_arabic.required'=>'enter arabic description about product',
                    'mrp.required'=>'enter product MRP',
                    'varient_image.required'=>'select an image',
                    'quantity.required'=>'enter quantity',
                    'unit.required'=>'enter unit'
                ]
        );
                
        if($request->hasFile('varient_image')){
            $image = $request->varient_image;
            $fileName = $image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $image->move('images/product/'.$date.'/', $fileName);
            $image = 'images/product/'.$date.'/'.$fileName;
        }
        else{
            $image = 'N/A';
        }

        
        
        $insert =  DB::table('product_varient')
                        ->insert(['product_id'=>$id,'strick_price'=>$strick_price, 'price'=>$price,'varient_image'=>$image, 'unit'=>$unit, 'quantity'=>$quantity,'description'=>$description, 'description_arabic'=>$description_arabic, 'vendor_id'=>$vendor_id, 'stock'=>$stock]);
        if($insert)
        {
            return redirect()->back()->withSuccess('Successfully Added');
        }
        else{
            return redirect()->back()->withErrors('something went wrong');
        }
	
    }
    
    public function Editproductvariant(Request $request)
    {
 
       $varient_id=$request->id;

    	 $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
    	 
        $product= DB::table('product_varient')
                 ->where('varient_id', $varient_id)
                ->first();
                
        $p= DB::table('product')
                 ->where('product_id', $product->product_id)
                ->first();
         
    	 return view('vendor.product.varient.Editvarient',compact("vendor_email","vendor","product","varient_id"));
   }
    public function Updateproductvariant(Request $request)
   {
     
        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        $vendor_id=$vendor->vendor_id;
         
        $varient_id = $request->varient_id;
        $strick_price = $request->strick_price;
        $price=$request->price;
        $stock=$request->stock;
        $unit=$request->unit;
        $quantity=$request->quantity;
        $description =$request->description;
        $description_arabic =$request->description_arabic;
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');

        $varient_image = $request->varient_image;
        
        $getImage = DB::table('product_varient')
                     ->where('varient_id',$varient_id)
                    ->first();

        $image = $getImage->varient_image;  

        if($request->hasFile('varient_image')){
             if(file_exists($image)){
                unlink($image);
            }
            $varient_image = $request->varient_image;
            $fileName = date('dmyhisa').'-'.$varient_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $varient_image->move('images/product/'.$date.'/', $fileName);
            $varient_image = 'images/product/'.$date.'/'.$fileName;
        }
        else{
            $varient_image = $image;
        }

       $varient_update = DB::table('product_varient')
                            ->where('varient_id', $varient_id)
                            ->update(['strick_price'=>$strick_price, 'price'=>$price,'varient_image'=>$image, 'unit'=>$unit, 'quantity'=>$quantity,'description'=>$description, 'description_arabic'=>$description_arabic, 'vendor_id'=>$vendor_id, 'stock'=>$stock]);

        if($varient_update){

            return redirect()->back()->withSuccess('Updated Successfully');
        }
        else{
            return redirect()->back()->withErrors("Something Wents Wrong.");
        }
    }
  public function deleteproductvariant(Request $request)
    {
        $varient_id=$request->id;

        $getfile=DB::table('product_varient')
                ->where('varient_id',$varient_id)
                ->first();

        $product_image=$getfile->varient_image;

    	$delete=DB::table('product_varient')->where('varient_id',$request->id)->delete();
        if($delete)
        {
        
            if(file_exists($product_image)){
                unlink($product_image);
            }
         
        return redirect()->back()->withSuccess('Deleted Successfully');

        }
        else
        {
           return redirect()->back()->withErrors('Unsuccessfull Delete'); 
        }

    }
	
    
}
