<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class StoreDealproductController extends Controller
{
    public function store_dealproduct(Request $request)
    {
        $vendor_id = $request->vendor_id;
        $products = DB::table('deal_product')
        ->join('product_varient','deal_product.varient_id','=','product_varient.varient_id')
        ->join('product','product_varient.product_id','=','product.product_id')
        ->where('deal_product.vendor_id',$vendor_id)
        ->get();
       if($products)	{                     
        $mess = array('status'=>'1', 'message'=>'data found', 'data'=>$products);
        return $mess;
     }
    else
     {
        $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[] );
        return $message;
     }		

    }

    public function store_adddealproduct(Request $request)
    {
                $vendor_id = $request->vendor_id;
           $deal = DB::table('product_varient')
                ->join('product','product_varient.product_id','=','product.product_id')
                ->where('product.vendor_id',$vendor_id)
                ->get();
        
                if(count($deal)>0)	{                     
                    $mess = array('status'=>'1', 'message'=>'data found', 'data'=>$deal);
                    return $mess;
                 }
                else
                 {
                    $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[] );
                    return $message;
                 }
     }

     public function store_addnewdealproduct(Request $request)
     {
        
        $vendor_id=$request->vendor_id; 
             
         $varient_id = $request->varient_id;
         $deal_price = $request->deal_price;
         $valid_from = $request->valid_from;
         $valid_to = $request->valid_to;
         $date=date('d-m-Y'); 
 
         $insertCategory = DB::table('deal_product')
                             ->insert([
                                 'varient_id'=>$varient_id,
                                 'deal_price'=>$deal_price,
                                 'valid_from'=>$valid_from,
                                 'valid_to'=>$valid_to,
                                 'status'=>1,
                                 'vendor_id'=>$vendor_id,
                                
                             ]);
         
         if($insertCategory){

            $mess = array('status'=>'1', 'message'=>'data found', 'data'=>$insertCategory );
            return $mess;             }
         
           else
           {
            $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[] );
            return $message;
           }
       
     }
     public function store_editdealproduct(Request $request)
     {
        $deal_id = $request->deal_id;
        $deal = DB::table('product_varient')
               ->join('product','product_varient.product_id','=','product.product_id')
               ->get();
       
         $deal_p = DB::table('deal_product')
                   ->join('product_varient','deal_product.varient_id','=','product_varient.varient_id')
                   ->join('product','product_varient.product_id','=','product.product_id')
                   ->where('deal_id',$deal_id)
                   ->first();
 
       if($deal_p)	{                     
           $mess = array('status'=>'1', 'message'=>'data found', 'data'=>$deal_p, 'productVarient'=>$deal);
           return $mess;
        }
       else
        {
           $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[] );
           return $message;
        }
 
     }
     public function store_updatedealproduct(Request $request)
     {
        $deal_id = $request->deal_id;
        $varient_id = $request->varient_id;
         $deal_price = $request->deal_price;
         $valid_from = $request->valid_from;
         $valid_to = $request->valid_to;
         $date=date('d-m-Y');
  
 
         $updateDeal = DB::table('deal_product')
                     ->where('deal_id', $deal_id)
                             ->update([
                                 'varient_id'=>$varient_id,
                                 'deal_price'=>$deal_price,
                                 'valid_from'=>$valid_from,
                                 'valid_to'=>$valid_to,
                                 'status'=>1,
                                
                             ]);
 
       if($updateDeal)	{                     
           $mess = array('status'=>'1', 'message'=>'data update', 'data'=>$updateDeal);
           return $mess;
        }
       else
        {
           $message = array('status'=>'0', 'message'=>'data not update', 'data'=>[] );
           return $message;
        }
 
     }
     public function store_deletedealproduct(Request $request)
     {
         $deal_id=$request->deal_id;
 
         $delete=DB::table('deal_product')->where('deal_id',$deal_id)->delete();
         if($delete)
         {
            $delete = array('status'=>'1', 'message'=>'Deleted Successfully');

            return $delete;     
            }
         else
         {
            $delete = array('status'=>'0', 'message'=>'Unsuccessfull Delete');
            return $delete;         
        }
     }
}