<?php

namespace App\Http\Controllers\Cityadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;
use Carbon\Carbon;

class HomeController extends Controller
{
	public function cityadminIndex(Request $request)
    {
        $created_at = Carbon::Now();
    if(Session::has('cityadmin'))
     {
        $cityadmin_email=Session::get('cityadmin');
        
        $cityadmin=DB::table('cityadmin')
        ->where('cityadmin_email',$cityadmin_email)
        ->first();
        $cityadmin_id = $cityadmin->cityadmin_id;
        
        
        	$currentDate = date('Y-m-d');
				$day = 1;
       $current2 = date('d-m-Y', strtotime($currentDate.' + '.$day.' days'));
        
        
                            
         $total_earnings = DB::table('orders')
                             ->join('vendor','orders.vendor_id','=','vendor.vendor_id')
    	                    ->join('cityadmin','vendor.cityadmin_id','=','cityadmin.cityadmin_id')
    	                    ->where('orders.order_status','=','Confirmed')
    	                    ->where('vendor.cityadmin_id',$cityadmin->cityadmin_id)
    	                    ->count(); 
    	   $orders = DB::table('orders')
    	                     ->join('vendor','orders.vendor_id','=','vendor.vendor_id')
    	                    ->join('cityadmin','vendor.cityadmin_id','=','cityadmin.cityadmin_id')
    	                    ->where('orders.order_status','=','Completed')
    	                    ->where('vendor.cityadmin_id',$cityadmin->cityadmin_id)
    	                    ->count();  
    	   $total_cash = DB::table('orders')
    	                    ->join('vendor','orders.vendor_id','=','vendor.vendor_id')
    	                    ->join('cityadmin','vendor.cityadmin_id','=','cityadmin.cityadmin_id')
    	                    ->where('order_status','=','Completed')
    	                    ->where('vendor.cityadmin_id',$cityadmin->cityadmin_id)
    	                    ->sum('rem_price');                  
    	                    
    	 $total_users = DB::table('tbl_user')
    	                    ->count();     
    	  $ongoing =   DB::table('cityadmin')
    	                    ->count();      
    	   $complete =   DB::table('vendor')
    	                    ->where('cityadmin_id',$cityadmin->cityadmin_id)
    	                    ->count(); 
    	   $cityadmin1 =   DB::table('delivery_boy')
    	                    ->where('cityadmin_id',$cityadmin->cityadmin_id)
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
    	                    ->join('vendor','orders.vendor_id','=','vendor.vendor_id')
    	                     ->join('cityadmin','vendor.cityadmin_id','=','cityadmin.cityadmin_id')
    	                    ->where('vendor.cityadmin_id',$cityadmin_id)
    	                    
    	                    ->where('orders.payment_status','!=', 'NULL')
    	                    ->orderBy('delivery_date','DESC')
    	                    ->whereDate('orders.delivery_date', $currentDate)
    	                    ->paginate(5);
    	   $reffer_arning = DB::table('tbl_user_scratch_card')
    	                    ->sum('earning');                   
    	                    
        return view('cityadmin.index', compact("cityadmin_email", "cityadmin", "total_earnings", "total_users", "ongoing","complete","cityadmin1","orders","user","comment","cancel","total_cash","currency","app_share","daily_count","today","recent_order","reffer_arning"));
	 }
	else
	 {
	    return redirect()->route('cityadminlogin')->withErrors('please login first');
	 }
    }
    
}
