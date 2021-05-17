<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class Incentive_orderController extends Controller
{
    
    public function incentive_order(Request $request)
    {
     if(Session::has('vendor'))
     {
     $vendor_email=Session::get('vendor');

    	  $vendor=DB::table('vendor')
    			->where('vendor_email',$vendor_email)
    			->first();
    			
    	$cityadmin_id = $vendor->vendor_id;
    	
    	$incentive = DB::table('incentive')
    	           ->join('delivery_boy', 'incentive.delivery_boy_id','=','delivery_boy.delivery_boy_id')
    	           ->where('delivery_boy.vendor_id', $cityadmin_id)
    	           ->get();
    	           
    	return view('vendor.oder_incentive.incentive_order', compact("vendor_email", "cityadmin_id","vendor","incentive"));		
     }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }			
    }
    
    
    public function pay_incentive(Request $request)
    {
        
      if(Session::has('vendor'))
      {
    	$vendor_email=Session::get('vendor');

    	  $vendor=DB::table('vendor')
    			->where('vendor_email',$vendor_email)
    			->first();
    	$pay = $request->pay;		
    	$remaining_incentive = $request->remaining_incentive;
    	$remaining = $remaining_incentive-$pay;
    	$paid_incentive = $request->paid_incentive;
    	$paid = $paid_incentive+$pay;
    	$cityadmin_id = $vendor->vendor_id;
    	$delivery_boy_id = $request->delivery_boy_id;
    	
    	$update = DB::table('incentive')
    	->where('delivery_boy_id', $delivery_boy_id)
    	->update(['paid_incentive'=>$paid,
    	'remaining_incentive'=>$remaining]);
       
       	  if($update){
            return redirect()->back()->withErrors('Rs. ' .$pay.  '  marked paid');
        }
        else{
            return redirect()->back()->withErrors("Something wents wrong");
        }
	 }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
    }
 
    
      public function edit_incentive_order(Request $request)
    {
       
      if(Session::has('vendor'))
       {
    	
    	$vendor_email=Session::get('vendor');

    	  $vendor=DB::table('vendor')
    			->where('vendor_email',$vendor_email)
    			->first();
    	   
    	  $cityadmin_id =$vendor->vendor_id;			
    			
    	   $amount=  DB::table('incentive_amount')
                ->where('vendor_id', $cityadmin_id)
                ->first(); 
                
                
        if($amount){
              $incentive = $amount->delivery_boy_incentive;
            	return view('vendor.oder_incentive.incentive_edit', compact("vendor_email", "cityadmin_id","vendor", "incentive"));
            	
            
        }        
                
         else{
             $insert=	DB::table('incentive_amount')
     		         ->insert(['vendor_id'=>$cityadmin_id]);
     		   $incentive = 0;      
     		  return view('vendor.oder_incentive.incentive_edit', compact("vendor_email", "cityadmin_id","vendor", "incentive"));       
         }                  
    			
    	
	 }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
    }
 
      public function update_incentive_order(Request $request)
    {
       
      if(Session::has('vendor'))
     {
    
    	 	$vendor_email=Session::get('vendor');

    	  $vendor=DB::table('vendor')
    			->where('vendor_email',$vendor_email)
    			->first();
    			
    	$vendor_id =$vendor->vendor_id;	
    	$amount=  DB::table('incentive_amount')
                ->where('vendor_id', $vendor_id)
               // ->where(strtotime('tbl_subscription.delivery_date') ,$current)
                ->first(); 	
                

         $incentive_amount= $request->incentive_amount;       
             
             $update=	DB::table('incentive_amount')
    	             ->where('vendor_id', $vendor_id)
     		         ->update(['delivery_boy_incentive'=>$incentive_amount]);
     		         
     		$subs_id=  DB::table('tbl_subscription')
    	                    ->join('product' , 'tbl_subscription.varient_id','=','product.product_id')
    	                    ->join('subcat','product.subcat_id','=','subcat.subcat_id')
    	                    ->join('tbl_category', 'subcat.category_id', '=', 'tbl_category.vendor_id')
    	                    ->join('vendor', 'tbl_category.vendor_id', '=', 'vendor.vendor_id')
    	                    ->select('tbl_subscription.subs_id','vendor.vendor_id')
    	                    ->where('vendor.vendor_id', $vendor_id)
    	                   
    	                    ->get();         
     		         
     	  foreach($subs_id as $subs_id){
     	
    	  $update1=	DB::table('tbl_subscription')
    	            ->where('subs_id',$subs_id->subs_id)    
    	            ->where('sub_status','!=','completed')
     		         ->update(['delivery_boy_incentive'=>$incentive_amount]);
    	}	         
         
        
    	
    
    	
     if($update){
            return redirect()->back()->withErrors('incentive amount set to rs. '.$incentive_amount.'  per order');
        }
        else{
            return redirect()->back()->withErrors("Something wents wrong");
        }
	 }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
    }
}