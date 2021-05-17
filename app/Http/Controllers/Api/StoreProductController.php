<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;


class StoreProductController extends Controller
{
    public function store_products(Request $request)
    {
        $vendor_id = $request->vendor_id;
        $products= DB::table('product')
        ->join('subcat','product.subcat_id', '=', 'subcat.subcat_id')
        ->join('tbl_category','subcat.category_id', '=', 'tbl_category.category_id')
        ->where('tbl_category.vendor_id', $vendor_id)
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
    public function store_addnewproduct(Request $request)
    {
        $vendor_id = $request->vendor_id;
        $subcat_id=$request->subcat_id;
        $product_name=$request->product_name;
        $mrp = $request->mrp;
        $price=$request->price;
        $unit=$request->unit;
        $stock=$request->stock;
        $qty=$request->quantity;
        $product_description =$request->product_description;
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');
        $product_image = $request->product_image;
        $fileName = date('dmyhisa').'-'.$product_image->getClientOriginalName();
        $fileName = str_replace(" ", "-", $fileName);
        $product_image->move('product/images/'.$date.'/', $fileName);
        $product_image = 'product/images/'.$date.'/'.$fileName;


        $insert = DB::table('product')
        ->insertGetId(['subcat_id'=>$subcat_id,'product_name'=>$product_name,'product_image'=>$product_image,'created_at'=>$created_at,'vendor_id'=>$vendor_id]);
       $product = DB::table('product')->where('product_id',$insert)->first();
        if($insert){  
         $add1stvarient = DB::table('product_varient')
         ->insert(['product_id'=>$insert,'price'=>$mrp, 'strick_price'=>$price, 'varient_image'=>$product_image, 'unit'=>$unit, 'quantity'=>$qty, 'stock'=>$stock,'description'=>$product_description,'vendor_id'=>$vendor_id]);                  
            $mess = array('status'=>'1', 'message'=>'data found', 'varientdata'=>$add1stvarient ,'productdata'=>$product);
            return $mess;
         }
        else
         {
            $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[] );
            return $message;
         }

    }


    public function store_editnewproduct(Request $request)
    {
      $product_id = $request->product_id;
      $product = DB::table('product')->where('product_id',$product_id)->first();
      $vendor_id=$product->vendor_id;
      $subcat= DB::table('subcat')
      ->join('tbl_category','subcat.category_id', '=', 'tbl_category.category_id')
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
    public function store_updatenewproduct(Request $request)
    {
      $product_id=$request->product_id;
      $subcat_id=$request->subcat_id;
      $product_name=$request->product_name;
      $product = DB::table('product')->where('product_id',$product_id)->first();
      $old_product_image=$product->product_image;
      $updated_at = date("d-m-y h:i a");
      $date=date('d-m-y');
      
      $getImage = DB::table('product')
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

      $update = DB::table('product')
               ->where('product_id', $product_id)
               ->update(['subcat_id'=>$subcat_id,'product_name'=>$product_name,'product_image'=>$product_image,'updated_at'=>$updated_at]);

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
    public function store_deleteproduct(Request $request)
    {
        $product_id=$request->product_id;

    	$delete=DB::table('product')->where('product_id',$request->product_id)->delete();
        if($delete)
        {
         DB::table('product_varient')->where('product_id',$request->product_id)->delete();  
         
         $delete = array('status'=>'1', 'message'=>'Deleted Successfully');

        return $delete;
        }
        else
        {
         $delete = array('status'=>'0', 'message'=>'Unsuccessfull Delete');
         return $delete;        }
    }
    
        public function store_category(Request $request)
    {
      $vendor_id = $request->vendor_id;
    	$Category = DB::table('tbl_category')->where('vendor_id',$vendor_id)
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

   public function store_subcategory(Request $request)
   {
     $category_id = $request->category_id;
      $Category = DB::table('subcat')->where('category_id',$category_id)
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
    public function store_subcategoryshow(Request $request)
  {
      $vendor_id = $request->vendor_id;
      $Category = DB::table('tbl_category')->where('vendor_id',$vendor_id)
               ->join('subcat', 'tbl_category.category_id', '=', 'subcat.category_id')
               ->select('subcat.subcat_id','subcat.subcat_name','subcat.subcat_image','tbl_category.vendor_id')

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
 
 public function store_subcategoryproduct(Request $request)
 {
   $vendor_id = $request->vendor_id;
   $subcat_id = $request->subcat_id;

   $products= DB::table('product')
   ->join('subcat','product.subcat_id', '=', 'subcat.subcat_id')
   ->join('tbl_category','subcat.category_id', '=', 'tbl_category.category_id')
   ->where('tbl_category.vendor_id', $vendor_id)
   ->where('subcat.subcat_id', $subcat_id)
  ->get();

  if(count($products)>0){
   foreach($products as $ords){
           $product_id = $ords->product_id;    
      $details  =   DB::table('product_varient')->where('product_id',$product_id)
                    
                   ->get(); 

                   $data[]=array('product_id'=>$product_id,'subcat_id'=>$ords->subcat_id,'product_name'=>$ords->product_name, 'product_image'=>$ords->product_image, 'vendor_id'=>$ords->vendor_id,'category_id'=>$ords->category_id, 'subcat_name'=>$ords->subcat_name, 'subcat_image'=>$ords->subcat_image, 'category_name'=>$ords->category_name,'category_image'=>$ords->category_image,'home'=>$ords->home,'varient_details'=>$details); 
                 }
                 }
         else{
         $data[]=array('order_details'=>'no orders found');
                 }
                 return $data;
               }
               
     public function store_updateproductvariant(Request $request)
               {
                 $product_id=$request->product_id;
                 $subcat_id=$request->subcat_id;
                 $product_name=$request->product_name;

                 $varient_id = $request->varient_id;
                 $strick_price = $request->strick_price;
                 $price=$request->price;
                 $stock=$request->stock;
                 $unit=$request->unit;
                 $quantity=$request->quantity;
                 $description =$request->description;

                 $updated_at = date("d-m-y h:i a");
                 $date=date('d-m-y');
                 
                 $getImage = DB::table('product')
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
           
                 $update = DB::table('product')
                          ->where('product_id', $product_id)
                          ->update(['subcat_id'=>$subcat_id,'product_name'=>$product_name,'product_image'=>$product_image,'updated_at'=>$updated_at]);
           
                 $varient_update = DB::table('product_varient')
                          ->where('varient_id', $varient_id)
                          ->update(['strick_price'=>$strick_price, 'price'=>$price,'varient_image'=>$image, 'unit'=>$unit, 'quantity'=>$quantity,'description'=>$description,'stock'=>$stock]);
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
         public function store_addproductvariant(Request $request)
               {
                  $vendor_id=$request->vendor_id;
                 $product_id=$request->product_id;
                 $subcat_id=$request->subcat_id;
                 $product_name=$request->product_name;

                 $varient_id = $request->varient_id;
                 $strick_price = $request->strick_price;
                 $price=$request->price;
                 $stock=$request->stock;
                 $unit=$request->unit;
                 $quantity=$request->quantity;
                 $description =$request->description;

        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');
        $product_image = $request->product_image;
        $fileName = date('dmyhisa').'-'.$product_image->getClientOriginalName();
        $fileName = str_replace(" ", "-", $fileName);
        $product_image->move('product/images/'.$date.'/', $fileName);
        $product_image = 'product/images/'.$date.'/'.$fileName;
        
        $insert = DB::table('product')
        ->insertGetId(['subcat_id'=>$subcat_id,'product_name'=>$product_name,'product_image'=>$user_image,'created_at'=>$created_at,'vendor_id'=>$vendor_id]);
                 
        
        if($insert){
         
         $add1stvarient = DB::table('product_varient')
                        ->insert(['product_id'=>$insert,'price'=>$price, 'strick_price'=>$strick_price, 'varient_image'=>$user_image, 'unit'=>$unit, 'quantity'=>$quantity, 'stock'=>$stock,'description'=>$description,'vendor_id'=>$vendor_id]);
                              
                     $mess = array('status'=>'1', 'message'=>'found data', 'data'=>$insert ,'datavarient'=>$add1stvarient);
                     return $mess;
                  }
                 else
                  {
                     $message = array('status'=>'0', 'message'=>'data not update', 'data'=>[] ,'datavarient'=>[]);
                     return $message;
                  }
           
               }
               
         public function store_allproduct(Request $request)
    {   
        $vendor_id= $request->vendor_id;
        $category = DB::table('product')
                   ->select('product_id', 'product_name','product_image')
                   ->where('product.vendor_id', $vendor_id)
        		   ->get();
        if(count($category)>0)	{	   
         foreach($category as $categorys)
            {
            $product = DB::table('product_varient')
                ->select('varient_id','product_id','quantity','unit','price','description','varient_image')
                ->groupBy('varient_id','product_id','quantity','unit','price','description','varient_image')
               ->where('product_varient.product_id',$categorys->product_id)
    		   ->get();
    		   
    		   $data[]=array('product_id'=>$categorys->product_id , 'product_name'=>$categorys->product_name ,'product_image'=>$categorys->product_image,'variant'=>$product);
        		   
        // 	 if(count($product)>0){
        //       foreach($product as $products){
        //       $order = DB::table('resturant_variant')
        //               ->where('resturant_variant.product_id',$products->product_id)
        //               ->get();
                      
                      
        //         if(count($order)>0){
        //       foreach($order as $order1){
        //       $addons = DB::table('restaurant_addons')
        //               ->where('restaurant_addons.product_id',$products->product_id)
        //               ->get();       
                          
                
        //         $data[]=array('resturant_cat_id'=>$categorys->resturant_cat_id , 'cat_name'=>$categorys->cat_name ,'product_id'=>$products->product_id ,'product_name'=>$products->product_name, 'product_image'=>$products->product_image,'description'=>$products->description, 'variant'=>$order,'addons'=>$addons); 
        //         }
        //         }
        //         else{
        //             $data[]=array('data'=>'No data Fund');
        //         }
        //       }
        //         }
        //         else{
        //             $data[]=array('data'=>'No data found');
        //         }
                
            }
           
          
        
        if(count($data)>0){
           
        	
        	$message2 = array('status'=>'1', 'message'=>'data found', 'data'=>$data);
        	return $message2;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }
        }
        else{
            $message = array('status'=>'2', 'message'=>'No Home Categories Found', 'data'=>[]);
        	return $message;
            
        }
    }       
}
