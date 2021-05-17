<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class StoreProductvarientController extends Controller
{
    public function store_varient(Request $request)
    {
         $product_id = $request->product_id;	 
        $product= DB::table('product_varient')
                 ->where('product_id', $product_id)
                ->get();
                if($product)	{                     
                    $mess = array('status'=>'1', 'message'=>'data found', 'data'=>$product);
                    return $mess;
                 }
                else
                 {
                    $message = array('status'=>'0', 'message'=>'data not found' );
                    return $message;
                 }		
            
    }
    public function store_addvariant(Request $request)
    {
         $product_id = $request->product_id;	 
        $product= DB::table('product_varient')
                 ->where('product_id', $product_id)
                ->get();

                if($product)	{                     
                    $mess = array('status'=>'1', 'message'=>'data found', 'data'=>$product);
                    return $mess;
                 }
                else
                 {
                    $message = array('status'=>'0', 'message'=>'data not found' );
                    return $message;
                 }		
            
    }

    public function store_addnewvariant(Request $request)
    {
        $vendor_id=$request->vendor_id; 
        $product_id = $request->product_id;
        $strick_price = $request->strick_price;
        $price=$request->price;
        $stock=$request->stock;
        $unit=$request->unit;
        $quantity=$request->quantity;
        $description =$request->description;
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');
                
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
                        ->insert(['product_id'=>$product_id,'strick_price'=>$strick_price, 'price'=>$price,'varient_image'=>$image, 'unit'=>$unit, 'quantity'=>$quantity,'description'=>$description,'vendor_id'=>$vendor_id, 'stock'=>$stock]);

                if($insert)	{                                        
                    $mess = array('status'=>'1', 'message'=>'Variant Add Sucessfully ', 'data'=>$insert);
                    return $mess;
                 }
                else
                 {
                    $message = array('status'=>'0', 'message'=>'data not found' );
                    return $message;
                 }		
            
    }
    public function store_editvariant(Request $request)
    {
        $varient_id=$request->varient_id;
        $product= DB::table('product_varient')
      ->where('varient_id', $varient_id)
     ->first();

      if($product)	{                     
          $mess = array('status'=>'1', 'message'=>'data found', 'data'=>$product);
          return $mess;
       }
      else
       {
          $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[] );
          return $message;
       }

    }
    public function store_updatevariant(Request $request)
    {
        $varient_id = $request->varient_id;
        $vendor_id = $request->vendor_id;
        $strick_price = $request->strick_price;
        $price=$request->price;
        $stock=$request->stock;
        $unit=$request->unit;
        $quantity=$request->quantity;
        $description =$request->description;
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
                            ->update(['strick_price'=>$strick_price, 'price'=>$price,'varient_image'=>$image, 'unit'=>$unit, 'quantity'=>$quantity,'description'=>$description,'vendor_id'=>$vendor_id, 'stock'=>$stock]);

        if($varient_update){                    
          $mess = array('status'=>'1', 'message'=>'data update', 'data'=>$varient_update);
          return $mess;
       }
      else
       {
          $message = array('status'=>'0', 'message'=>'data not update', 'data'=>[] );
          return $message;
       }

    }
    public function store_deletevariant(Request $request)
    {
        $varient_id=$request->varient_id;

    	$delete=DB::table('product_varient')->where('varient_id',$varient_id)->delete();
        if($delete)
        {
         
         $delete = array('status'=>'1', 'message'=>'Deleted Successfully');

        return $delete;
        }
        else
        {
         $delete = array('status'=>'0', 'message'=>'Unsuccessfull Delete');
         return $delete;        }
    }
}