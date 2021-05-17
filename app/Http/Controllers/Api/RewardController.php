<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;


class RewardController extends Controller
{
   public function redeem(Request $request)
    {  
        $created_at = Carbon::now();
        $user_id = $request->user_id;
        $rewards = DB::table('tbl_user')
                ->select('rewards','wallet_credits')
                ->where('user_id',$user_id)
                ->first();
        $rew = $rewards->rewards;
        if($rew <= 0){
             $message = array('status'=>'0', 'message'=>'You have not get any rewards yet', 'data'=>[]);
            return $message;
        }
        else{
        $redeem_points = DB::table('reedem_values')
               ->select('value','reward_point')
               ->first();
        $new = $rew * $redeem_points->value/$redeem_points->reward_point;
        $newwallet = $new + $rewards->wallet_credits;
        
        
        $upuser =  DB::table('tbl_user')
                ->where('user_id',$user_id)
                ->update(['rewards'=>0,
                'wallet_credits'=>$newwallet]);
                
        $insert1 = DB::table('wallet_history') 
                         ->insert([
                             'amount'=>$new,
                             'type'=>'Reward Values',
                             'user_id'=>$user_id,
                             'created_at'=>$created_at,
                             ]);        
                
        
         if($insert1){
            $message = array('status'=>'1', 'message'=>'Rewards Redeemed Sucessfully ');
            return $message;
            }
        else{
            $message = array('status'=>'0', 'message'=>'Something Went Wrong', 'data'=>[]);
            return $message;
        }
    }
    }
    
    
     public function rewardvalues(Request $request)
    {  
       $user_id =$request->user_id;
        $redeem_points = DB::table('tbl_user')
            ->where('user_id',$user_id)
            ->select('rewards')
               ->first();
    
         if($redeem_points){
            $message = array('status'=>'1', 'message'=>'Rewards Point Values', 'data'=>$redeem_points);
            return $message;
            }
        else{
            $message = array('status'=>'0', 'message'=>'Something Went Wrong', 'data'=>[]);
            return $message;
        }
    }
    
    
     public function after_order_reward_msg(Request $request)
    {  
      $created_at = Carbon::now();
        $cart_id = $request->cart_id;
        $data= $request->order_array;
        $data_array = json_decode($data);
        
        if($data != 'Null')
        {
        $check = DB::table('orders')
               ->where('cart_id',$cart_id)
               ->first();
        $p=$check->total_price;
        $user_id=$check->user_id;
        $currency = DB::table('currency')
                  ->first();
        $cc = DB::table('reward_points')
            ->where('min_cart_value',"<=",$p)
            ->orderBy("min_cart_value", "DESC")
            ->first();
          $text1 = "You will get ".$cc->reward_point." reward points once the Order is Completed .";
         
          $cc2 = DB::table('reward_points')
            ->where('min_cart_value',">",$cc->min_cart_value)
            ->orderBy("min_cart_value", "ASC")
            ->first();
            
         if($cc2){
            $nu = $cc2->min_cart_value - $p;
              
            $text2="Add items of ".$currency->currency_sign." ".$nu." more to get ".$cc2->reward_point." reward points."; 
         }  
         else{
             $text2 = "";
         }
         
   
   
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
        
    
         if($cc){
            $message = array('status'=>'1', 'message'=>'You Got a Rewards Points', 'line1'=>$text1, 'line2'=>$text2);
            return $message;
            }
        else{
            $message = array('status'=>'0', 'message'=>'no rewards with this order', 'data'=>[]);
            return $message;
        }
     }
     else{$check = DB::table('orders')
               ->where('cart_id',$cart_id)
               ->first();
        $p=$check->total_price;
        $user_id=$check->user_id;
        $currency = DB::table('currency')
                  ->first();
        $cc = DB::table('reward_points')
            ->where('min_cart_value',"<=",$p)
            ->orderBy("min_cart_value", "DESC")
            ->first();
          $text1 = "You will get ".$cc->reward_point." reward points once the Order is Completed .";
         
          $cc2 = DB::table('reward_points')
            ->where('min_cart_value',">",$cc->min_cart_value)
            ->orderBy("min_cart_value", "ASC")
            ->first();
            
         if($cc2){
            $nu = $cc2->min_cart_value - $p;
              
            $text2="Add items of ".$currency->currency_sign." ".$nu." more to get ".$cc2->reward_point." reward points."; 
         }  
         else{
             $text2 = "";
         }
        
    
         if($cc){
            $message = array('status'=>'1', 'message'=>'You Got a Rewards Points', 'line1'=>$text1, 'line2'=>$text2);
            return $message;
            }
        else{
            $message = array('status'=>'0', 'message'=>'no rewards with this order', 'data'=>[]);
            return $message;
            
        }
         
     }
    }
    
    public function rewardhistory(Request $request)
    {  
        $user_id= $request->user_id;
        $redeem_points = DB::table('reward_history')
                ->where('user_id',$user_id)
                ->orderBy('created_at','DESC')
               ->get();
    
         if($redeem_points){
            $message = array('status'=>'1', 'message'=>'Rewards History', 'data'=>$redeem_points);
            return $message;
            }
        else{
            $message = array('status'=>'0', 'message'=>'No Reward history', 'data'=>[]);
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
				
				
            if($total_stock>=$order_qty){
            $varient1[] = varient_id;
            $variant = implode(',',$varient1);
			
			
            }else{
			$varient2[] = varient_id;
			$variants = implode(',',$varient2);
             }
			 
			 if($variant != NULL && variants != NULL){
			 $message = array(status=>'1','message'=>$variant." Stock not Available and ".$variant." Stock Available.");
             return $message;   
			 }
			 elseif($variant != NULL && variants == NULL){
			 $message = array(status=>'0','message'=>" Stock not Available of any product. ");
             return $message;    
			 }
			 
			 elseif($variant == NULL && variants != NULL){
			 $message = array(status=>'0','message'=>" Stock Available for all product. ");
             return $message;    
			 }
			 else{
			 $message = array(status=>'0','message'=>" Product not found. ");
             return $message;    
			 }
             }
        
    }
}    