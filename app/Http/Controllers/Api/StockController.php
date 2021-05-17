<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;


class StockController extends Controller
{
     public function stock_update(Request $request)
    {  
      
        $data= $request->order_array;
        $data_array = json_decode($data);
        
             foreach ($data_array as $h){
                $varient_id = $h->varient_id;
                 $p =  DB::table('product_varient')
                        ->where('varient_id',$varient_id)
                        ->first();
                $total_stock =   $p->stock;          
                $order_qty = $h->qty;
                
                $new_stock = $total_stock-$order_qty;
                
                $insert = DB::table('product_varient')
                            ->where('varient_id',$varient_id)
                            ->update([
                                     'stock'=>$new_stock,
                                     ]);
             }
    
         if($insert){
            $message = array('status'=>'1', 'message'=>"Stock Updated Successfully");
            return $message;
            }
        else{
            $message = array('status'=>'0', 'message'=>"Oops, Somehting went wrong");
            return $message;
        }
    }
    
     public function stock_check(Request $request)
    {  
      
        $data= $request->order_array;
        $data_array = json_decode($data);
        
             foreach ($data_array as $h){
                $varient_id = $h->varient_id;
                 $p =  DB::table('product_varient')
                        ->where('varient_id',$varient_id)
                        ->first();
                $total_stock =   $p->stock;          
                $order_qty = $h->qty;
                
                
                
                
             }
    
         if($total_stock>=$order_qty){
            $message = array('status'=>'1', 'message'=>"Stock Available");
            return $message;
            }
        else{
            $message = array('status'=>'0', 'message'=>"Product is out of Stock ");
            return $message;
        }
    }
    

    
}    