<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class HomeController extends Controller
{
    
    public function adminIndex(Request $request)
    {
        $created_at = Carbon::Now();
    	 $admin_email=Session::get('admin');
    	 
    	  $admin=DB::table('admin')
    			->where('admin_email',$admin_email)
    			->first();	
                            
         $total_earnings = DB::table('orders')
    	                    ->where('order_status','=','Confirmed')
    	                    ->count(); 
    	   $orders = DB::table('orders')
    	                    ->where('order_status','=','Completed')
    	                    ->count();  
    	   $total_cash = DB::table('orders')
    	                    ->where('order_status','=','Completed')
    	                    ->sum('rem_price');                  
    	                    
    	 $total_users = DB::table('tbl_user')
    	                    ->count();     
    	  $ongoing =   DB::table('cityadmin')
    	                    ->count();      
    	   $complete =   DB::table('vendor')
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
    	   //var_dump($today);
    	   $recent_order = DB::table('orders')
    	                    ->where('order_status','=','Confirmed')
    	                    ->orderBy('delivery_date','DESC')
    	                    ->limit(5)
    	                     ->get();
    	   $reffer_arning = DB::table('tbl_user_scratch_card')
    	                    ->sum('earning');                   
    	                    
        return view('admin.index', compact("admin_email", "admin", "total_earnings", "total_users", "ongoing","complete","cityadmin","orders","user","comment","cancel","total_cash","currency","app_share","daily_count","today","recent_order","reffer_arning","created_at"));
           
      }


  }