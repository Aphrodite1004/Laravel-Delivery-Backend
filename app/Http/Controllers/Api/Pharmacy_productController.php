<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class Pharmacy_productController extends Controller
{

       public function allproduct(Request $request)
    {   
        $vendor_id= $request->vendor_id;
        $category = DB::table('resturant_category')
                   ->select('resturant_cat_id', 'cat_name')
                   ->where('resturant_category.vendor_id', $vendor_id)
        		   ->get();
        if(count($category)>0)	{	   
         foreach($category as $categorys)
            {
            $product = DB::table('resturant_product')
                ->select('product_name','product_image','description','product_id')
                ->groupBy('product_name','product_image','description','product_id')
               ->where('resturant_product.subcat_id',$categorys->resturant_cat_id)
    		   ->get();
        		   
        	 if(count($product)>0){
              foreach($product as $products){
              $order = DB::table('resturant_variant')
                    ->select('variant_id','product_id','quantity','unit','strick_price','price','vendor_id')
                    ->groupBy('variant_id','product_id','quantity','unit','strick_price','price','vendor_id')
                      ->where('resturant_variant.product_id',$products->product_id)
                      ->get();
                      
                      
                if(count($order)>0){
              foreach($order as $order1){
              $addons = DB::table('restaurant_addons')
                      ->where('restaurant_addons.product_id',$products->product_id)
                      ->get();       
                          
                
                $data[]=array('resturant_cat_id'=>$categorys->resturant_cat_id , 'cat_name'=>$categorys->cat_name ,'product_id'=>$products->product_id ,'product_name'=>$products->product_name, 'product_image'=>$products->product_image,'description'=>$products->description, 'variant'=>$order,'addons'=>$addons); 
                }
                }
                else{
                    $data[]=array('data'=>'No data Fund');
                }
              }
                }
                else{
                    $data[]=array('resturant_cat_id'=>$categorys->resturant_cat_id , 'cat_name'=>$categorys->cat_name);
                }
                
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


    
     public function popular_item(Request $request)
    {   
        $vendor_id= $request->vendor_id;
        $category = DB::table('resturant_deal_product')
                    ->join('resturant_variant','resturant_deal_product.variant_id','=','resturant_variant.variant_id')
                   ->select('resturant_deal_product.variant_id', 'deal_price','resturant_variant.product_id')
                   ->where('resturant_deal_product.vendor_id', $vendor_id)
        		   ->get();
        if(count($category)>0)	{	   
         foreach($category as $categorys)
            {
            $product = DB::table('resturant_product')
               ->where('resturant_product.product_id',$categorys->product_id)
    		   ->get();
        		   
        	 if(count($product)>0){
              foreach($product as $products){
              $order = DB::table('resturant_variant')
                      ->where('resturant_variant.product_id',$products->product_id)
                      ->get();
                      
                      
                if(count($order)>0){
              foreach($order as $order1){
              $addons = DB::table('restaurant_addons')
                      ->where('restaurant_addons.product_id',$products->product_id)
                      ->get();       
                          
                
                $data[]=array('variant_id'=>$categorys->variant_id , 'deal_price'=>$categorys->deal_price ,'product_id'=>$products->product_id ,'product_name'=>$products->product_name, 'product_image'=>$products->product_image,'description'=>$products->description, 'variant'=>$order,'addons'=>$addons); 
                }
                }
                else{
                    $data[]=array('data'=>'No data Fund');
                }
              }
                }
                else{
                    $data[]=array('data'=>'No data found');
                }
                
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
            $message = array('status'=>'2', 'message'=>'No popular item Found', 'data'=>[]);
        	return $message;
            
        }
    }
    
    public function cate(Request $request)
    {   
        $vendor_id= $request->vendor_id;
        $category = DB::table('resturant_category')
                   ->where('vendor_id', $vendor_id)
        		   ->get();
        if(count($category)>0)	{	   
         foreach($category as $categorys){
              $resturant_cat_id = $categorys->resturant_cat_id; 
              
        $product = DB::table('resturant_product')
                        ->where('subcat_id',$resturant_cat_id)
                        ->get();

                        $data[]=array('resturant_cat_id'=>$categorys->resturant_cat_id,'cat_name'=>$categorys->cat_name,'products'=>$product);
                        }
                         }
         elseif(count($product)>0)	{	   
         foreach($product as $products){
              $product_id = $products->product_id; 
              
        $variant = DB::table('resturant_variant')
                        ->where('product_id',$product_id)
                        ->get();

                        $data[]=array('variants'=>$variant);
                        }
                         }                 
                          else{
                            $data[]=array('order_details'=>'no orders found');
                                 }
                                return $data;
    
    }
    
      public function pharmacy_allproducts(Request $request)
    {   
        $vendor_id= $request->vendor_id;
        $category = DB::table('resturant_product')
                   ->select('product_id', 'product_name','product_image',"description","product_image")
                   ->where('resturant_product.vendor_id', $vendor_id)
        		   ->get();
        if(count($category)>0)	{	   
         foreach($category as $categorys)
            {
            $product = DB::table('resturant_variant')
                ->select('variant_id','product_id','quantity','unit','price')
                ->groupBy('variant_id','product_id','quantity','unit','price')
               ->where('resturant_variant.product_id',$categorys->product_id)
    		   ->get();
    		   
    		   $data[]=array('product_id'=>$categorys->product_id , 'product_name'=>$categorys->product_name ,'product_image'=>$categorys->product_image,'description'=>$categorys->description,'variant'=>$product);
        		   
       
                
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