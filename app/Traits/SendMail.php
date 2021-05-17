<?php

namespace App\Traits;
use DB;
use Mail;


trait SendMail {
    
    
      public function payoutMail($vendor_name,$vendor_email,$app_name,$password) {
       
        $data = array('to' => $vendor_email, 'from' => 'noreply@gomarket.in', 'to-name'=>$vendor_name, 'from-name' => $app_name);

        Mail::send('cityadmin.mail.vendorcreate', compact('vendor_name', 'vendor_email','password'), function ($m) use ($data){
                $m->from($data['from'], $data['from-name']);
                $m->to($data['to'], $data['to-name'])->subject("Register successfully");
            });
            
        return "send";
    }
    
      public function codorderplacedMail($cart_id,$prod_name,$price2,$delivery_date,$time_slot,$user_email,$user_name) {
      
       $app_name = "GoMarket";
       
        $data = array('to' => $user_email, 'from' => 'noreply@gomarket.in', 'to-name'=>$user_name, 'from-name' => $app_name);

        Mail::send('admin.mail.codorderplaced', compact('cart_id', 'prod_name', 'price2', 'delivery_date', 'time_slot'), function ($m) use ($data){
                $m->from($data['from'], $data['from-name']);
                $m->to($data['to'], $data['to-name'])->subject("Order Successfully Placed");
            });
            
        return "send";
    }
    
     public function orderplacedMail($cart_id,$prod_name,$price2,$delivery_date,$time_slot,$user_email,$user_name) {
      
       $app_name = "GoMarket";
       
        $data = array('to' => $user_email, 'from' => 'noreply@gomarket.in', 'to-name'=>$user_name, 'from-name' => $app_name);

        Mail::send('admin.mail.orderplaced', compact('cart_id', 'prod_name', 'price2', 'delivery_date', 'time_slot'), function ($m) use ($data){
                $m->from($data['from'], $data['from-name']);
                $m->to($data['to'], $data['to-name'])->subject("Order Successfully Placed");
            });
            
        return "send";
    }
    
    
    
     public function coddeloutMail($cart_id, $prod_name, $price2, $user_email, $user_name, $rem_price) {
        $currency = DB::table('currency')
                  ->first();
      
       $app_name = "GoMarket";
       
        $data = array('to' => $user_email, 'from' => 'noreply@gomarket.in', 'to-name'=>$user_name, 'from-name' => $app_name);

        Mail::send('admin.mail.coddel_out', compact('cart_id', 'prod_name', 'price2','currency','rem_price'), function ($m) use ($data){
                $m->from($data['from'], $data['from-name']);
                $m->to($data['to'], $data['to-name'])->subject("Out For Delivery");
            });
            
        return "send";
    }
    
    public function deloutMail($cart_id, $prod_name, $price2,$user_email, $user_name,$rem_price) {
        $currency = DB::table('currency')
                  ->first();
       $app_name = "GoMarket";
       
        $data = array('to' => $user_email, 'from' => 'noreply@gomarket.in', 'to-name'=>$user_name, 'from-name' => $app_name);

        Mail::send('admin.mail.del_out', compact('cart_id', 'prod_name', 'price2','currency','rem_price'), function ($m) use ($data){
                $m->from($data['from'], $data['from-name']);
                $m->to($data['to'], $data['to-name'])->subject("Out For Delivery");
            });
            
        return "send";
    }
    
      public function delcomMail($cart_id, $prod_name, $price2,$user_email, $user_name) {
     $app_name = "GoMarket";
       $curr =  DB::table('currency')
             ->first();
       $currency_sign = $curr->currency_sign;
        $data = array('to' => $user_email, 'from' => 'noreply@gomarket.in', 'to-name'=>$user_name, 'from-name' => $app_name);

        Mail::send('admin.mail.del_com', compact('cart_id', 'prod_name', 'price2','currency_sign'), function ($m) use ($data){
                $m->from($data['from'], $data['from-name']);
                $m->to($data['to'], $data['to-name'])->subject("Delivery Completed");
            });
            
        return "send";
    }
    
    
     public function rechargeMail($user_id,$user_name, $user_email, $user_phone,$amount) {
       $app_name = "GoMarket";
       $currency = DB::table('currency')
               ->first();
       
        $data = array('to' => $user_email, 'from' => 'noreply@gomarket.in', 'to-name'=>$user_name, 'from-name' => $app_name);

        Mail::send('admin.mail.recharge', compact( 'user_id','currency','amount'), function ($m) use ($data){
                $m->from($data['from'], $data['from-name']);
                $m->to($data['to'], $data['to-name'])->subject("Recharge Successful.");
            });
            
        return "send";
    }
     public function sendrejectmail($cause,$user,$cart_id) {
        
        $app_name = "GoMarket";
       $currency = DB::table('currency')
               ->first();
       
        $data = array('to' => $user->user_email, 'from' => 'noreply@gomarket.in', 'to-name'=>$user->user_name, 'from-name' => $app_name);

        Mail::send('admin.mail.rejectmail', compact('cause', 'user', 'cart_id'), function ($m) use ($data){
                $m->from($data['from'], $data['from-name']);
                $m->to($data['to'], $data['to-name'])->subject("Order Cancelled.");
            });
            
        return "send";
     }
     
     public function photoorderplacedMail ($cart_id,$prod_name,$price2,$delivery_date,$user_email,$user_name) {
      $app_name = "GoMarket";
       
        $data = array('to' => $user_email, 'from' => 'noreply@gomarket.in', 'to-name'=>$user_name, 'from-name' => $app_name);

        Mail::send('admin.mail.photoorderplaced', compact('cart_id', 'prod_name', 'price2', 'delivery_date'), function ($m) use ($data){
                $m->from($data['from'], $data['from-name']);
                $m->to($data['to'], $data['to-name'])->subject("Order Successfully Placed");
            });
            
        return "send";
    }
    
      public function ordercanceledMail($cart_id,$user_email,$user_name) {
      
       $app_name = "GoMarket";
       
        $data = array('to' => $user_email, 'from' => 'noreply@gomarket.in', 'to-name'=>$user_name, 'from-name' => $app_name);

        Mail::send('admin.mail.ordercancel', compact('cart_id'), function ($m) use ($data){
                $m->from($data['from'], $data['from-name']);
                $m->to($data['to'], $data['to-name'])->subject("Order Successfully Placed");
            });
            
        return "send";
    }
}