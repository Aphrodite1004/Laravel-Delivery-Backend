<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;


class Pharmacy_VendorProductController extends Controller
{
    public function pharmacy_products(Request $request)
    {
        $vendor_id = $request->vendor_id;
        $products= DB::table('resturant_product')
        ->join('resturant_category','resturant_product.subcat_id', '=', 'resturant_category.resturant_cat_id')
        ->where('resturant_category.vendor_id', $vendor_id)
       ->get();	
       if(count($products)>0)	{                     
        $mess = array('status'=>'1', 'message'=>'data found', 'data'=>$products);
        return $mess;
     }
    else
     {
        $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[] );
        return $message;
     }		

    }

    public function store_addproduct(Request $request)
    {
        $vendor_id = $request->vendor_id;
        $subcat= DB::table('subcat')
        ->join('tbl_category','subcat.category_id', '=', 'tbl_category.category_id')
        ->where('vendor_id', $vendor_id)
        ->get();
        if(count($subcat)>0)	{                     
            $mess = array('status'=>'1', 'message'=>'data found', 'data'=>$subcat);
            return $mess;
         }
        else
         {
            $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[] );
            return $message;
         }

    }
    public function pharmacy_addnewproduct(Request $request)
    {
        $vendor_id = $request->vendor_id;
        $subcat_id=$request->subcat_id;
        $product_name=$request->product_name;
        $mrp = $request->mrp;
        $price=$request->price;
        $unit=$request->unit;
        $qty=$request->quantity;
        $product_description =$request->product_description;
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');
        $product_image = $request->product_image;
        $fileName = date('dmyhisa').'-'.$product_image->getClientOriginalName();
        $fileName = str_replace(" ", "-", $fileName);
        $product_image->move('product/images/'.$date.'/', $fileName);
        $product_image = 'product/images/'.$date.'/'.$fileName;


        $insert = DB::table('resturant_product')
        ->insertGetId(['subcat_id'=>$subcat_id,'product_name'=>$product_name,'product_image'=>$product_image,'created_at'=>$created_at,'vendor_id'=>$vendor_id,'description'=>$product_description]);
       $product = DB::table('resturant_product')->where('product_id',$insert)->first();
        if($insert){  
         $add1stvarient = DB::table('resturant_variant')
         ->insert(['product_id'=>$insert,'price'=>$mrp, 'strick_price'=>$price, 'unit'=>$unit, 'quantity'=>$qty, 'vendor_id'=>$vendor_id]);                  
            $mess = array('status'=>'1', 'message'=>'data found', 'varientdata'=>$add1stvarient ,'productdata'=>$product);
            return $mess;
         }
        else
         {
            $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[] );
            return $message;
         }

    }


    public function pharmacy_editnewproduct(Request $request)
    {
      $product_id = $request->product_id;
      $product = DB::table('resturant_product')
                     ->where('product_id',$product_id)
                        ->first();
      $vendor_id=$product->vendor_id;
      $subcat= DB::table('resturant_category')
      ->where('vendor_id', $vendor_id)
      ->get();

      if($product)	{                     
          $mess = array('status'=>'1', 'message'=>'data found', 'data'=>$product, 'subcat'=>$subcat);
          return $mess;
       }
      else
       {
          $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[] );
          return $message;
       }

    }
    public function pharmacy_updatenewproduct(Request $request)
    {
      $product_id=$request->product_id;
      $subcat_id=$request->subcat_id;
      $product_name=$request->product_name;
      $description=$request->description;
      
      $product = DB::table('resturant_product')
                      ->where('product_id',$product_id)
                      ->first();
      $old_product_image=$product->product_image;
      $updated_at = date("d-m-y h:i a");
      $date=date('d-m-y');
      
      $getImage = DB::table('resturant_product')
                   ->where('product_id',$product_id)
                  ->first();

      $image = $getImage->product_image;  

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

      $update = DB::table('resturant_product')
               ->where('product_id', $product_id)
               ->update(['subcat_id'=>$subcat_id,'product_name'=>$product_name,'product_image'=>$product_image,'updated_at'=>$updated_at,'description'=>$description]);

      if($update)	{                     
          $mess = array('status'=>'1', 'message'=>'data update', 'data'=>$update);
          return $mess;
       }
      else
       {
          $message = array('status'=>'0', 'message'=>'data not update', 'data'=>[] );
          return $message;
       }

    }
    public function pharmacy_deleteproduct(Request $request)
    {
        $product_id=$request->product_id;

    	$delete=DB::table('resturant_product')->where('product_id',$request->product_id)->delete();
        if($delete)
        {
         DB::table('resturant_variant')->where('product_id',$request->product_id)->delete();
         DB::table('restaurant_addons')->where('product_id',$request->product_id)->delete();
         
         $delete = array('status'=>'1', 'message'=>'Deleted Successfully');

        return $delete;
        }
        else
        {
         $delete = array('status'=>'0', 'message'=>'Unsuccessfull Delete');
         return $delete;        }
    }
    
        public function pharmacy_category(Request $request)
    {
      $vendor_id = $request->vendor_id;
    	$Category = DB::table('resturant_category')->where('vendor_id',$vendor_id)
    			         ->get();
    		         
        if($Category){
         $mess = array('status'=>'1', 'message'=>'data found', 'data'=>$Category);
         return $mess;
     }
	else
	 {
      $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[] );
      return $message;    }
   }

 
         public function pharmacy_product(Request $request)
         {
           $vendor_id = $request->vendor_id;
           $subcat_id = $request->subcat_id;
        
           $products= DB::table('resturant_product')
           ->join('resturant_category','resturant_product.subcat_id', '=', 'resturant_category.resturant_cat_id')
           ->where('resturant_category.vendor_id', $vendor_id)
          ->where('resturant_category.resturant_cat_id', $subcat_id)
          ->get();
        
          if(count($products)>0){
           foreach($products as $ords){
                   $product_id = $ords->product_id;    
              $details  =   DB::table('resturant_variant')
                                ->where('product_id',$product_id)
                                 ->get();
               $addons = DB::table('restaurant_addons') 
                                 ->where('product_id',$product_id)
                                 ->get();
        
                           $data[]=array('product_id'=>$product_id,'product_name'=>$ords->product_name,'description'=>$ords->description,'cat_name'=>$ords->cat_name, 'product_image'=>$ords->product_image, 'vendor_id'=>$ords->vendor_id, 'cat_name'=>$ords->cat_name,'varient_details'=>$details,'addons'=>$addons); 
                         }
                         }
                 else{
                 $data[]=array('order_details'=>'no orders found');
                         }
                         return $data;
                       }
               
     public function pharmacy_updateproductvariant(Request $request)
               {
                 $product_id=$request->product_id;
                 $subcat_id=$request->subcat_id;
                 $product_name=$request->product_name;

                 $varient_id = $request->varient_id;
                 $strick_price = $request->strick_price;
                 $price=$request->price;

                 $unit=$request->unit;
                 $quantity=$request->quantity;
                 $description =$request->description;

                 $updated_at = date("d-m-y h:i a");
                 $date=date('d-m-y');
                 
                 $getImage = DB::table('resturant_product')
                              ->where('product_id',$product_id)
                             ->first();
           
                 $image = $getImage->product_image;  
           
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
                     $product_image = $image;
                 }
           
                 $update = DB::table('resturant_product')
                          ->where('product_id', $product_id)
                          ->update(['subcat_id'=>$subcat_id,'product_name'=>$product_name,'product_image'=>$product_image,'updated_at'=>$updated_at,'description'=>$description]);
           
                 $varient_update = DB::table('resturant_variant')
                          ->where('variant_id', $varient_id)
                          ->update(['strick_price'=>$strick_price, 'price'=>$price, 'unit'=>$unit, 'quantity'=>$quantity]);
                 if($update)	{                     
                     $mess = array('status'=>'1', 'message'=>'data update', 'data'=>$update ,'datavarient'=>$varient_update);
                     return $mess;
                  }
                 else
                  {
                     $message = array('status'=>'0', 'message'=>'data not update', 'data'=>[] ,'datavarient'=>[]);
                     return $message;
                  }
           
               }
         public function pharmacy_addproductvariant(Request $request)
               {
                  $vendor_id=$request->vendor_id;
                 $product_id=$request->product_id;
                 $subcat_id=$request->subcat_id;
                 $product_name=$request->product_name;

                 $varient_id = $request->varient_id;
                 $strick_price = $request->strick_price;
                 $price=$request->price;
                 $unit=$request->unit;
                 $quantity=$request->quantity;
                 $description =$request->description;

                 $created_at = date("d-m-y h:i a");
                 $date=date('d-m-y');
                 
        
        if($request->user_image){
            $user_image = $request->user_image;
            $user_image = str_replace('data:image/png;base64,', '', $user_image);
            $fileName = str_replace(" ", "-", $user_image);
            $fileName = date('dmyHis').'user_image'.'.'.'png';
            $fileName = str_replace(" ", "-", $fileName);
            \File::put(public_path(). '/images/user/' . $fileName, base64_decode($user_image));
            $user_image = 'images/user/'.$fileName;
        }
            else{
                $user_image = 'N/A';
            }
        
        $insert = DB::table('resturant_product')
        ->insertGetId(['subcat_id'=>$subcat_id,'product_name'=>$product_name,'product_image'=>$user_image,'created_at'=>$created_at,'vendor_id'=>$vendor_id,'description'=>$description]);
                 
        
        if($insert){
         
         $add1stvarient = DB::table('resturant_variant')
                        ->insert(['product_id'=>$insert,'price'=>$price, 'strick_price'=>$strick_price, 'unit'=>$unit, 'quantity'=>$quantity,'vendor_id'=>$vendor_id]);
                              
                     $mess = array('status'=>'1', 'message'=>'found data', 'data'=>$insert ,'datavarient'=>$add1stvarient);
                     return $mess;
                  }
                 else
                  {
                     $message = array('status'=>'0', 'message'=>'data not update', 'data'=>[] ,'datavarient'=>[]);
                     return $message;
                  }
           
               }
               
     public function pharmacy_addnewvariant(Request $request)
    {
        $vendor_id=$request->vendor_id; 
        $product_id = $request->product_id;
        $strick_price = $request->strick_price;
        $price=$request->price;
        $unit=$request->unit;
        $quantity=$request->quantity;
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');

        
        
        $insert =  DB::table('resturant_variant')
                        ->insert(['product_id'=>$product_id,'strick_price'=>$strick_price, 'price'=>$price, 'unit'=>$unit, 'quantity'=>$quantity,'vendor_id'=>$vendor_id]);

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
    
      public function pharmacy_updatevariant(Request $request)
    {
        $varient_id = $request->varient_id;
        $vendor_id = $request->vendor_id;
        $strick_price = $request->strick_price;
        $price=$request->price;
        
        $unit=$request->unit;
        $quantity=$request->quantity;
       
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');

       
       $varient_update = DB::table('resturant_variant')
                            ->where('variant_id', $varient_id)
                            ->update(['strick_price'=>$strick_price, 'price'=>$price,'unit'=>$unit, 'quantity'=>$quantity,'vendor_id'=>$vendor_id]);

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
    
     public function pharmacy_deletevariant(Request $request)
    {
        $varient_id=$request->variant_id;

    	$delete=DB::table('resturant_variant')
    	            ->where('variant_id',$varient_id)
    	             ->delete();
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
    
    public function pharmacy_addaddons(Request $request)
    {
        $vendor_id=$request->vendor_id; 
        $product_id = $request->product_id;
        $addon_name = $request->addon_name;
        $addon_price=$request->addon_price;

        $insert =  DB::table('restaurant_addons')
                        ->insert(['product_id'=>$product_id,'addon_name'=>$addon_name, 'addon_price'=>$addon_price, 'vendor_id'=>$vendor_id]);

                if($insert)	{                                        
                    $mess = array('status'=>'1', 'message'=>' Add Sucessfully ', 'data'=>$insert);
                    return $mess;
                 }
                else
                 {
                    $message = array('status'=>'0', 'message'=>'data not found' );
                    return $message;
                 }		
            
    } 
    
     public function pharmacy_addaddons_update(Request $request)
    {
        $addon_id = $request->addon_id;
        $addon_name = $request->addon_name;
        $addon_price=$request->addon_price;

        $insert =  DB::table('restaurant_addons')
                        ->where('addon_id',$addon_id)
                        ->update(['addon_name'=>$addon_name, 'addon_price'=>$addon_price]);

                if($insert)	{                                        
                    $mess = array('status'=>'1', 'message'=>' Add Sucessfully ', 'data'=>$insert);
                    return $mess;
                 }
                else
                 {
                    $message = array('status'=>'0', 'message'=>'data not found' );
                    return $message;
                 }		
            
    } 
    
     public function pharmacy_deleteaddon(Request $request)
    {
        $addon_id=$request->addon_id;

    	$delete=DB::table('restaurant_addons')
    	            ->where('addon_id',$addon_id)
    	             ->delete();
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
