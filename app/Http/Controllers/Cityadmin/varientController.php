<?php

namespace App\Http\Controllers\cityadmin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use DB;
use Session;

class VarientController extends Controller
{
    public function varient(Request $request)
    {
    if(Session::has('cityadmin'))
     {
         $id = $request->id;
        $cityadmin_email=Session::get('cityadmin');
        $cityadmin=DB::table('cityadmin')
        ->where('cityadmin_email',$cityadmin_email)
        ->first();
        $product= DB::table('product_varient')
                 ->where('product_id', $id)
                ->get();
        $currency =  DB::table('currency')
               ->select('currency_sign')
                ->get();           
        return view('cityadmin.product.varient.show_varient',compact("cityadmin_email","product","cityadmin","currency","id"));
	 }
	else
	 {
	    return redirect()->route('cityadminlogin')->withErrors('please login first');
	 }
    }
    
     public function Addproduct(Request $request)
    {
      if(Session::has('cityadmin'))
      {
        $id = $request->id;  
        $cityadmin_email=Session::get('cityadmin');
        $cityadmin=DB::table('cityadmin')
        ->where('cityadmin_email',$cityadmin_email)
        ->first();
        
                
           
         return view('cityadmin.product.varient.addvarient',compact("cityadmin_email","cityadmin","id"));
	 }
	else
	 {
	    return redirect()->route('cityadminlogin')->withErrors('please login first');
	 }
    }
    
    
   public function AddNewproduct(Request $request)
    {
              if(Session::has('cityadmin'))
      { 
        $id = $request->id;
        $color = $request->color;
        $size = $request->size;
        $mrp = $request->mrp;
        $price=$request->price;
        $member_price=$request->member_price;
        $subscription_price=$request->subscription_price;
        $unit=$request->unit;
        $stock=$request->stock;
        $qty=$request->qty;
        $old_product_image=$request->old_product_image;
        $product_description =$request->product_description;
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');
        $product_image = $request->product_image;
        $fileName = date('dmyhisa').'-'.$product_image->getClientOriginalName();
        $fileName = str_replace(" ", "-", $fileName);
        $product_image->move('product/images/'.$date.'/', $fileName);
        $product_image = 'product/images/'.$date.'/'.$fileName;
        
        
          
        $this->validate(
            $request,
                [
                    'mrp'=>'required',
                    'product_description'=>'required',
                ],
                [
                    'mrp.required'=>'enter mrp',
                    'product_description.required'=>'enter description about product'
                ]
        );
        
        $insert =  DB::table('product_varient')
                        ->insert(['product_id'=>$id,'mrp'=>$mrp, 'price'=>$price, 'subscription_price'=>$subscription_price,
						'varient_image'=>$product_image, 'varient_color'=>$color, 'varient_unit'=>$unit, 'varient_unit_value'=>$qty,
						'stock'=>$stock, 'varient_size'=>$size,'varient_desc'=>$product_description,'created_at'=>$created_at]);
     if($insert){
         return redirect()->back()->withErrors('successfully added');
     }
     else{
     return redirect()->back()->withErrors('something went wrong');
     }
	 }
	else
	 {
	    return redirect()->route('cityadminlogin')->withErrors('please login first');
	 }
    }
    
    public function Editproduct(Request $request)
    {
      if(Session::has('cityadmin'))
      {	
   
       $varient_id=$request->id;
    	 $cityadmin_email=Session::get('cityadmin');
    	 
         $cityadmin=DB::table('cityadmin')
                ->where('cityadmin_email',$cityadmin_email)
                ->first();       
    	 $product= DB::table('product_varient')
    	 		  ->where('varient_id',$varient_id)
    	 		  ->first();
    	 return view('cityadmin.product.varient.Editvarient',compact("cityadmin_email","cityadmin","product","varient_id"));
	 }
	else
	 {
	    return redirect()->route('cityadminlogin')->withErrors('please login first');
	 }

    }
    public function Updateproduct(Request $request)
   {
     if(Session::has('cityadmin'))
     {
       
        $product_id=$request->id;
        $color = $request->color;
        $size = $request->size;
        $mrp = $request->mrp;
        $price=$request->price;
        $member_price=$request->member_price;
        $subscription_price=$request->subscription_price;
        $unit=$request->unit;
        $stock=$request->stock;
        $qty=$request->qty;
        $old_product_image=$request->old_product_image;
        $product_description =$request->product_description;
        $old_product_image=$request->old_product_image;
        $date = date('d-m-Y');
        $updated_at = date("d-m-y h:i a");
        $date=date('d-m-y');
        
        $this->validate(
            $request,
                [
                    'mrp'=>'required',
                    'product_image' => 'mimes:jpeg,png,jpg|max:400',
                    'old_product_image'=>'required',
                ],
                [
        
                    'mrp.required'=>'Enter the MRP',
                    'old_product_image.required' => 'choose picture.',
                ]
        );

        $getImage = DB::table('product_varient')
                     ->where('varient_id',$product_id)
                    ->first();

        $image = $getImage->varient_image;  

        if($request->hasFile('product_image')){
             if(file_exists($image)){
                unlink($image);
            }
            $product_image = $request->product_image;
            $fileName = date('dmyhisa').'-'.$product_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $product_image->move('product/images/'.$date.'/', $fileName);
            $product_image = 'product/images/'.$date.'/'.$fileName;
        }
        else{
            $product_image = $old_product_image;
        }

       $varient_update = DB::table('product_varient')
                            ->where('varient_id', $product_id)
                            ->update(['mrp'=>$mrp, 'price'=>$price, 'subscription_price'=>$subscription_price,'varient_image'=>$product_image, 'varient_color'=>$color, 'varient_unit'=>$unit, 'varient_unit_value'=>$qty, 'stock'=>$stock, 'varient_size'=>$size,'varient_desc'=>$product_description,'updated_at'=>$updated_at]);

        if($varient_update){

            return redirect()->back()->withErrors(' updated successfully');
        }
        else{
            return redirect()->back()->withErrors("something wents wrong.");
        }
	 }
	else
	 {
	    return redirect()->route('cityadminlogin')->withErrors('please login first');
	 }
    }
  public function deleteproduct(Request $request)
    {
     if(Session::has('cityadmin'))
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
         
        return redirect()->back()->withErrors('delete successfully');

        }
        else
        {
           return redirect()->back()->withErrors('unsuccessfull delete'); 
        }
	 }
	else
	 {
	    return redirect()->route('cityadminlogin')->withErrors('please login first');
	 }

    }
	
    
}
