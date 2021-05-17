<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Traits\SendMail;
use App\Traits\SendSms;
use Carbon\Carbon;

class Order_by_imageController extends Controller
{
    use SendMail;
    use SendSms;
      public function user_list(Request $request)
    {
       $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
             $list = DB::table('order_by_photo')
              ->join('tbl_user', 'order_by_photo.user_id','=','tbl_user.user_id')
              ->join('user_address', 'order_by_photo.address_id','=','user_address.address_id')
              ->where('order_by_photo.processed', '!=', 2)
               ->where('store_id',$vendor->vendor_id)
              ->get();
         return view('vendor.order_by_photo.user_orderlist', compact("vendor", "vendor_email","list"));   
      

    }
    
    
    
    public function sel_product(Request $request)
    {
        $vendor_email=Session::get('vendor');
        $ord_id = $request->id;
        $u = DB::table('order_by_photo')
           ->where('ord_id',$ord_id)
           ->first();
           
          $user_id = $u->user_id;

         
        $selected =  DB::table('list_cart')
                ->join('product_varient', 'list_cart.l_vid', '=', 'product_varient.varient_id')
                ->join('product', 'product_varient.product_id', '=', 'product.product_id')
                ->get();
                
        $check=  DB::table('list_cart')
                ->where('l_uid', $user_id)
                ->get();
        if(count($check)>0)  {
        foreach($check as $ch){
            $ch2 = $ch->l_vid;
            $ch3[] = array($ch2);
        }
          $products = DB::table('product_varient')
                ->join('product','product_varient.product_id', '=', 'product.product_id')
                ->whereNotIn('varient_id', $ch3)
                ->get();    
        
    	return view('vendor.order_by_photo.orderbyphoto', compact('vendor_email',"products","selected","u"));
        }else{
            $products = DB::table('product_varient')
                ->join('product','product_varient.product_id', '=', 'product.product_id')
                ->get(); 
                
            return view('vendor.order_by_photo.orderbyphoto', compact('vendor_email',"products","selected","user_id","u"));    
        }
      
    }
    
    
    

    
    
    public function added_product(Request $request)
    {
        $vendor_email=Session::get('vendor');
         $uid = $request->user_id;
         $pic_id = $request->pic_id;

          
    $prod = $request->prod;
    
    $countprod = count($prod);

    for($i=0;$i<=($countprod-1);$i++)
        {
            $varient_id = $prod[$i];
            $pr= DB::table('product_varient')
                 ->where('varient_id',$varient_id)
                 ->first();
                 
            $insert2 = DB::table('list_cart')
                  ->insert(['l_qty'=>1, 'l_vid'=>$prod[$i], 'l_uid'=>$uid,'ord_by_photo_id'=> $pic_id]);
        }     
          
         return redirect()->back()->withSuccess('Cart Added Successfully');
    }
    
     public function delete_product(Request $request)
    {
        $id =$request->id;
    	 $delete = DB::table('list_cart')
                ->where('l_cid', $id)
                ->delete();
         if($delete){
            return redirect()->back()->withSuccess('Product Removed from cart'); 
         } else{
         return redirect()->back()->withErrors('Something Went Wrong');
         }

    }
    
     public function add_qty(Request $request)
    {
        $id =$request->id;
        // var_dump($id);
        $qty = $request->stock;
    	 $stockupdate = DB::table('list_cart')
                ->where('l_cid', $id)
                ->update(['l_qty'=>$qty]);
         if($stockupdate){
            return redirect()->back()->withSuccess('Order Qty Updated Successfully'); 
         } else{
         return redirect()->back()->withErrors('sometzzzzhing went wrong');
         }

    }
    
         public function rejectorder(Request $request)
    {
         $ord_id=$request->id;
         $cause = $request->cause;
    			
    	 $ord = DB::table('order_by_photo')
    	 		->where('ord_id',$ord_id)
    	 		->first();	
    	 $user_id = $ord->user_id;		
    	 $user = DB::table('tbl_user')
    	 		->where('user_id',$user_id)
    	 		->first();
         
         
         $checknotificationby = DB::table('notificationby')
                              ->where('user_id',$user_id)
                              ->first();
         if($checknotificationby->sms == 1){
         $sendmsg = $this->sendrejectmsgbystore($cause,$user,$ord_id);
         }
         if($checknotificationby->app == 1){
         //////send notification to user//////////
             $notification_title = "Sorry! we are reject your order";
                        $notification_text = 'Hello '.$user->user_name.', We are cancelling your order no. = '.$ord_id.' due to following reason:  '.$cause;
                        $date = date('d-m-Y');
                        $getDevice = DB::table('tbl_user')
                                 ->where('user_id', $user_id)
                                ->select('device_id')
                                ->first();
                        $created_at = Carbon::now();
                        if($getDevice){
                        $getFcm = DB::table('fcm_key')
                                    ->where('unique_id', '1')
                                    ->first();
                                    
                        $getFcmKey = $getFcm->user_app_key;
                        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                        $token = $getDevice->device_id;
                            $notification = [
                                'title' => $notification_title,
                                'body' => $notification_text,
                                'sound' => true,
                            ];
                            $extraNotificationData = ["message" => $notification];
                            $fcmNotification = [
                                'to'        => $token,
                                'notification' => $notification,
                                'data' => $extraNotificationData,
                            ];
                
                            $headers = [
                                'Authorization: key='.$getFcmKey,
                                'Content-Type: application/json'
                            ];
                
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL,$fcmUrl);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                            $result = curl_exec($ch);
                            curl_close($ch);
                        $dd = DB::table('user_notification')
                            ->insert(['user_id'=>$user_id,
                             'noti_title'=>$notification_title,
                             'noti_message'=>$notification_text]);
                            
                        $results = json_decode($result);
                        }
         }
         
          $ord =DB::table('order_by_photo')
             ->where('ord_id', $ord_id)
             ->update(['reason'=>"Cancelled by Store due to the following reason: ".$cause,
             'processed'=>"2"]);
         return redirect()->back()->withSuccess('Order Rejected Successfully');
    }
    
    
public function checkout(Request $request)
    {   
        $current = Carbon::now();
        $vendor_email=Session::get('vendor');
    	 $store= DB::table('vendor')
    	 		   ->where('vendor_email',$vendor_email)
    	 		   ->first();
    	 $ord_id = $request->ord_id;
    	$store_id = $store->vendor_id;
    	$ui_type = $store->ui_type;
    	$ordbyphot =DB::table('order_by_photo')
                     ->where('ord_id',$ord_id)
                     ->first();
                     
        $ar= DB::table('user_address')
            ->where('address_id', $ordbyphot->address_id)
            ->first();
        $area_id = $ar->area_id;   
         $c = DB::table('vendor_area')
        ->where('area_id',$area_id)
        ->where('vendor_id',$store_id)
           ->first();             
            $del_c = $c->delivery_charge;           
                     
                     
                     
        $user_id= $ordbyphot->user_id;
         $delivery_date= $ordbyphot->delivery_date;
        $data_array = DB::table('list_cart')
                     ->where('l_uid',$user_id)
                     ->get();
       
        $payment_method = "COD";
        $payment_status = "COD";
       
        $time_slot= 'N/A';
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $val = "";
                for ($i = 0; $i < 4; $i++){
                    $val .= $chars[mt_rand(0, strlen($chars)-1)];
                }
                
        $chars2 = "0123456789";
                $val2 = "";
                for ($i = 0; $i < 2; $i++){
                    $val2 .= $chars2[mt_rand(0, strlen($chars2)-1)];
                }        
        $cr  = substr(md5(microtime()),rand(0,26),2);
        $cart_id = $val.$val2.$cr;
        $ar= DB::table('list_cart')
            ->join('order_by_photo','list_cart.ord_by_photo_id','=','order_by_photo.ord_id')
                     ->where('list_cart.l_uid',$user_id)
                     ->first();
        $created_at = Carbon::now();
        $price2=0;
        $price5=0;
        $ph = DB::table('tbl_user')
                  ->select('user_phone','wallet_credits')
                  ->where('user_id',$user_id)
                  ->first();
        $user_phone = $ph->user_phone;
       
       
    foreach ($data_array as $h){
        $varient_id = $h->l_vid;
         $p =  DB::table('product_varient')
             ->join('product','product_varient.product_id','=','product.product_id')
           ->leftjoin('deal_product','product_varient.varient_id','=','deal_product.varient_id')
           ->where('product_varient.varient_id',$varient_id)
           ->first();
           
         if($p->deal_price != NULL &&  $p->valid_from < $current && $p->valid_to > $current){
          $price= $p->deal_price;    
        }else{
            $price = $p->price;
        } 
        
         
        $mrpprice = $p->strick_price;
        $order_qty = $h->l_qty;
        $price2+= $price*$order_qty;
        $price5+=$mrpprice*$order_qty;
        $unit[] = $p->unit;
        $qty[]= $p->quantity;
        $p_name[] = $p->product_name."(".$p->quantity.$p->unit.")*".$order_qty;
        $prod_name = implode(',',$p_name);
        $price1= $price*$order_qty;
        $total_mrp = $mrpprice*$order_qty;
        $n =$p->product_name;
     

        $insert = DB::table('order_details')
                ->insertGetId([
                        'varient_id'=>$varient_id,
                        'qty'=>$order_qty,
                        'product_name'=>$n,
                        'varient_image'=>$p->varient_image,
                        'quantity'=>$p->quantity,
                        'unit'=>$p->unit,
                        'total_mrp'=>$price5,
                        'order_cart_id'=>$cart_id,
                        'order_date'=>$created_at,
                        'price'=>$price1,
                        
                        'addon_id'=>'0',
                        'addon_price'=>'0',
                        'addon_name'=>'null']);
      
 }
 
 
  if($insert){
        $oo = DB::table('orders')
            ->insertGetId(['cart_id'=>$cart_id,
            'total_price'=>$price2 + $del_c,
            'price_without_delivery'=>$price2,
            'total_products_mrp'=>$price5,
            'delivery_charge'=>$del_c,
            'user_id'=>$user_id,
            'payment_method'=> $payment_method,
            'payment_status'=> $payment_status,
            'vendor_id'=>$store_id,
             'paid_by_wallet'=>0,
            'rem_price'=>$price2 + $del_c,
            'order_date'=> $created_at,
            'delivery_date'=> $delivery_date,
            'time_slot'=>'N/A',
            'address_id'=>$ordbyphot->address_id,
            'dboy_incentive'=>'0',
            'ui_type'=>$ui_type
                    ]); 
        if($oo){     
             $dellist= DB::table('list_cart')
                     ->where('l_uid',$user_id)
                     ->delete();
                     
             $del_pic= DB::table('order_by_photo')
                     ->where('ord_id',$ord_id)
                     ->delete();         
           $ordersuccessed = DB::table('orders')
                           ->where('order_id',$oo)
                           ->first();
          
             
            $sms = DB::table('notificationby')
                       ->select('sms')
                       ->where('user_id',$user_id)
                       ->first();
            $sms_status = $sms->sms;
            
                if($sms_status == 1){
                    $orderplacedmsg = $this->ordersuccessfull($cart_id,$prod_name,$price2,$delivery_date,$time_slot,$user_phone);
                }
                      /////send mail
            $email = DB::table('notificationby')
                   ->select('email','app')
                   ->where('user_id',$user_id)
                   ->first();
             $q = DB::table('tbl_user')
                              ->select('user_email','user_name')
                              ->where('user_id',$user_id)
                              ->first();
            $user_email = $q->user_email;             
                 
            $user_name = $q->user_name;       
            $email_status = $email->email;       
            if($email_status == 1){
                   
                    $codorderplaced = $this->photoorderplacedMail($cart_id,$prod_name,$price2,$delivery_date,$user_email,$user_name);
               }
             if($email->app ==1){
                  $notification_title = "Hey ".$user_name.", Your Order is Placed";
                $notification_text = "Order Successfully Placed: Your order id #".$cart_id." contains of " .$prod_name." of price rs ".$price2. " is placed Successfully.You can expect your item(s) will be delivered on ".$delivery_date;
                
                $date = date('d-m-Y');
        
        
                $getDevice = DB::table('tbl_user')
                         ->where('user_id', $user_id)
                        ->select('device_id')
                        ->first();
                $created_at = Carbon::now();
        
                if($getDevice){
                
                
                $getFcm = DB::table('fcm_key')
                            ->where('unique_id', '1')
                            ->first();
                            
                $getFcmKey = $getFcm->user_app_key;
                $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                $token = $getDevice->device_id;
                    
        
                    $notification = [
                        'title' => $notification_title,
                        'body' => $notification_text,
                        'sound' => true,
                    ];
                    
                    $extraNotificationData = ["message" => $notification];
        
                    $fcmNotification = [
                        'to'        => $token,
                        'notification' => $notification,
                        'data' => $extraNotificationData,
                    ];
        
                    $headers = [
                        'Authorization: key='.$getFcmKey,
                        'Content-Type: application/json'
                    ];
        
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,$fcmUrl);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                    $result = curl_exec($ch);
                    curl_close($ch);
                    
             
                $dd = DB::table('user_notification')
                    ->insert(['user_id'=>$user_id,
                     'noti_title'=>$notification_title,
                     'noti_message'=>$notification_text]);
                    
                $results = json_decode($result);
                }
             }  
                $orderr1 = DB::table('orders')
                       ->where('cart_id', $cart_id)
                       ->first();   
           
                ///////send notification to store//////
                $getD = DB::table('vendor')
                         ->where('vendor_id', $store_id)
                        ->first();
                        
                $store_n = $getD->vendor_name;        
                $notification_title = "Hey ".$store_n.", You Got a New Order";
                $notification_text = "Order with cart id #".$cart_id." contains of " .$prod_name." of price rs ".$price2. " has been created successfully. It will have to delivered on ".$delivery_date.".";
                
                $date = date('d-m-Y');
                $getUser = DB::table('vendor')
                                ->get();
        
                $getDevice = DB::table('vendor')
                         ->where('vendor_id', $store_id)
                        ->select('device_id')
                        ->first();
                $created_at = Carbon::now();
        
                if($getDevice){
                
                
                $getFcm = DB::table('fcm_key')
                            ->where('unique_id', '1')
                            ->first();
                            
                $getFcmKey = $getFcm->vendor_app_key;
                $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                $token = $getDevice->device_id;
                    
        
                    $notification = [
                        'title' => $notification_title,
                        'body' => $notification_text,
                        'sound' => true,
                    ];
                    
                    $extraNotificationData = ["message" => $notification];
        
                    $fcmNotification = [
                        'to'        => $token,
                        'notification' => $notification,
                        'data' => $extraNotificationData,
                    ];
        
                    $headers = [
                        'Authorization: key='.$getFcmKey,
                        'Content-Type: application/json'
                    ];
        
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,$fcmUrl);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                    $result = curl_exec($ch);
                    curl_close($ch);
                    
                     ///////send notification to store//////
             
                $dd = DB::table('vendor_notification')
                    ->insert(['vendor_id'=>$store_id,
                     'not_title'=>$notification_title,
                     'not_message'=>$notification_text,
                     'read_by_vendor'=>'0']);
                    
                $results = json_decode($result);
                }
                            
        return redirect()->route('user_list')->withSuccess('Order Placed Successfully');
           }
           else{
              	return redirect()->back()->withSuccess('Order Cannot Created'); 
           }
        }
        else{
        	return redirect()->back()->withSuccess('Order Cannot Created');
        }
       
 }
    
    
    
}
