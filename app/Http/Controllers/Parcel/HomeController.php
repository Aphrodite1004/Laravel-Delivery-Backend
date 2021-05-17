<?php

namespace App\Http\Controllers\Parcel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class HomeController extends Controller
{
    
    public function vendorIndex(Request $request)
        {
        $created_at = Carbon::Now();    
     if(Session::has('vendor'))
     {
    	 $vendor_email=Session::get('vendor');

    	  $vendor=DB::table('vendor')
    			->where('vendor_email',$vendor_email)
    			->first();
    			
    	$current = Carbon::now();
        $current->toDateString();
        $currentDate = date('Y-m-d');
        $day = 1;
        $current2 = date('d-m-Y', strtotime($current.' + '.$day.' days'));
    			
    	 $total_earnings = DB::table('orders')
    	                    ->where('vendor_id',$vendor->vendor_id)
    	                    ->where('order_status','=','Confirmed')
    	                    ->count(); 
    	   $orders = DB::table('orders')
    	                    ->where('order_status','=','Completed')
    	                    ->where('vendor_id',$vendor->vendor_id)
    	                    ->count();  
    	   $total_cash = DB::table('orders')
    	                    ->where('vendor_id',$vendor->vendor_id)
    	                    ->where('order_status','=','Completed')
    	                    ->sum('rem_price');                  
    	                    
    	 $total_users = DB::table('tbl_user')
    	                    ->count();     
    	  $ongoing =   DB::table('delivery_boy')
    	  ->where('vendor_id',$vendor->vendor_id)
    	                    ->count();      
    	   $complete =   DB::table('orders')
    	   ->where('vendor_id',$vendor->vendor_id)
    	   ->whereDate('orders.delivery_date', $currentDate)
    	                    ->count(); 
    	   $cityadmin =   DB::table('cityadmin')
    	                    ->count(); 
    	   $user =   DB::table('tbl_user')
    	                    ->count(); 
    	   $comment =   DB::table('support_queries')
    	                    ->count(); 
    	   $cancel =   DB::table('cancel_for')
    	                    ->count();
    	   $currency =   DB::table('currency')
    	                    ->first(); 
    	   $app_share =   DB::table('tbl_referral')
    	                    ->count();
    	   $daily_count =   DB::table('tbl_referral')
    	                    ->where('created_at','==',$created_at)
    	                    ->count(); 
    	   $today =       ($daily_count/1)*100;
    	   
    	   $recent_order = DB::table('orders')
    	                    ->where('order_status','=','Confirmed')
    	                    ->where('vendor_id',$vendor->vendor_id)
    	                    ->orderBy('delivery_date','DESC')
    	                    ->limit(5)
    	                     ->get();
    	   $reffer_arning = DB::table('tbl_user_scratch_card')
    	                    ->sum('earning');                   
    	                    
        return view('parcel.index', compact("vendor_email", "vendor", "total_earnings", "total_users", "ongoing","complete","cityadmin","orders","user","comment","cancel","total_cash","currency","app_share","daily_count","today","recent_order","reffer_arning","created_at"));
         
           
     }
	else
	 {
	    return redirect()->route('parcelogin')->withErrors('please login first');
	 }
      }


  }