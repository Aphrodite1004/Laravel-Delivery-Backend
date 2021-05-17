<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class categoryController extends Controller
{
  
    public function category(Request $request)
    {   
        $vendor_id= $request->vendor_id;
        $category = DB::table('tbl_category')
                   ->where('vendor_id', $vendor_id)
        		   ->get();

        if(count($category)>0){
        	$message = array('status'=>'1', 'message'=>'Category List', 'data'=>$category);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }
    }
    
    public function subcat(Request $request)
    {   
        $category_id= $request->category_id;
        $category = DB::table('subcat')
                   ->where('category_id', $category_id)
        		   ->get();

        if(count($category)>0){
        	$message = array('status'=>'1', 'message'=>'Sub-Category List', 'data'=>$category);
        	return $message;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }
    }
    
    public function product(Request $request)
    {   
        $subcat_id= $request->subcat_id;
        $product = DB::table('product')
                   ->where('subcat_id',$subcat_id)
        		   ->get();
        
    if(count($product)>0){
      foreach($product as $products){
      $order = DB::table('product_varient')
              ->where('product_varient.product_id',$products->product_id)
              ->get();
                  
        
        $data[]=array( 'product_id'=>$products->product_id ,'product_name'=>$products->product_name, 'products_image'=>$products->product_image, 'data'=>$order); 
        }
        }
        else{
            $data[]=array('data'=>'no orders found');
        }
        return $data;     
    }
    
    
    public function allproduct(Request $request)
    {   
        $vendor_id= $request->vendor_id;
        $category = DB::table('tbl_category')
                   ->select('category_id', 'category_name')
                   ->where('tbl_category.home', '1')
                   ->where('tbl_category.vendor_id', $vendor_id)
        		   ->get();
        if(count($category)>0)	{	   
         foreach($category as $categorys)
            {
            $product = DB::table('subcat')
               ->join('product', 'subcat.subcat_id', '=', 'product.subcat_id')
               ->where('subcat.category_id',$categorys->category_id)
    		   ->get();
        		   
        	 if(count($product)>0){
              foreach($product as $products){
              $order = DB::table('product_varient')
                      ->where('product_varient.product_id',$products->product_id)
                      ->get();
                          
                
                $data[]=array('category_id'=>$categorys->category_id , 'category_name'=>$categorys->category_name ,'product_id'=>$products->product_id ,'product_name'=>$products->product_name, 'product_image'=>$products->product_image, 'data'=>$order); 
                }
                }
                else{
                    $data[]=array('data'=>'No Home Categories Found');
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
  
    
    public function currency(Request $request)
    {   
        $currency = DB::table('currency')
        		   ->get();
        if(count($currency)>0){
        	
        	$message2 = array('status'=>'1', 'message'=>'data found', 'data'=>$currency);
        	return $message2;
        }
        else{
        	$message = array('status'=>'0', 'message'=>'data not found', 'data'=>[]);
        	return $message;
        }
    }
    
    public function homecat(Request $request)
    {   
        $vendor_id= $request->vendor_id;
        $category = DB::table('homecat')
                   ->where('vendor_id', $vendor_id)
        		   ->get();
        		   
        foreach($category as $homecat)
        {
            $newhomecat = DB::table('assign_homecat')
                   ->join('tbl_category', 'assign_homecat.cat_id', '=', 'tbl_category.category_id')
                   ->where('assign_homecat.homecat_id',$homecat->homecat_id)
        		   ->get();
            $home[]=array('name'=>$homecat->homecat_name, 'data'=>$newhomecat);
        }
        
        return $home;
    }
    
    
    
    
}    