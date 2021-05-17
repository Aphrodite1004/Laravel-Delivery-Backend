<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class CouponController extends Controller
{
    public function pharmacycouponlist(Request $request)
    {
        
         $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
                
         $coupon= DB::table('coupon')
                ->where("vendor_id",$vendor->vendor_id)
                ->get();
        return view('pharmacy.coupon.couponlist',compact("vendor","coupon","vendor_email"));
    }
    
     public function pharmacycoupon(Request $request)
    {
         $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
       
        $coupon= DB::table('coupon')
                ->get();
        return view('pharmacy.coupon.couponadd',compact("vendor","coupon","vendor_email"));
    }
    
    
    public function pharmacyaddcoupon(Request $request)
    {
       
        if(Session::has('vendor'))
        {
             $vendor_email=Session::get('vendor');
             $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
            $vendor_id=$vendor->vendor_id;    
    
        $coupon_name = $request->coupon_name;
        $coupon_code = $request->coupon_code;
        $coupon_desc = $request->coupon_desc;
        $valid_to = $request->valid_to;
        $valid_from = $request->valid_from;
        $cart_value = $request->cart_value;
        $coupon_type = $request->coupon_type;
        $coupon_discount =$request->coupon_discount;
        $restriction = $request->restriction;


        
      $this->validate(
            $request,
                [
                    
                    'coupon_name'=>'required',
                    'coupon_code'=>'required',
                    'coupon_desc'=>'required',
                    'valid_to'=>'required',
                    'valid_from'=>'required',
                    'cart_value'=>'required',
                    'restriction'=>'required'
                ],
                [
                    
                    'coupon_name.required'=>'Coupon Name Required',
                    'coupon_code.required'=>'Coupon Code Required',
                    'coupon_desc.required'=>'Coupon Description Required',
                    'valid_to.required'=>'Date Required',
                    'valid_from.required'=>'Date Required',
                    'cart_value.required'=>'Cart value Required',
                    'restriction.required'=>'Enter Uses Restiction limit'

                ]
        );


        $insert = DB::table('coupon')
                  ->insert([
                       'coupon_name'=>$coupon_name,
                       'coupon_description'=>$coupon_desc,
                       'coupon_code'=>$coupon_code,
                       'start_date'=>$valid_to,
                       'end_date'=>$valid_from,
                       'type'=>$coupon_type,
                       'uses_restriction'=>$restriction,
                       'amount'=>$coupon_discount,
                       'vendor_id'=>$vendor_id,
                       'cart_value'=>$cart_value]);
     
            return redirect()->back()->withErrors('Added Successfully');
        }
       else
          {
            return redirect()->route('vendorlogin')->withErrors('please login first');
          }

    }
    
    
    public function pharmacyeditcoupon(Request $request)
    {
       
    	$vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
         $coupon_id=$request->coupon_id;
    	 $coupon= DB::table('coupon')
    	 		  ->where('coupon_id',$coupon_id)
    	 		  ->first();
    	 return view('pharmacy.coupon.couponedit',compact("vendor","coupon","vendor_email"));


    }
    public function pharmacyupdatecoupon(Request $request)
    {
       
        if(Session::has('vendor'))
     {
        $vendor_email=Session::get('vendor');
             $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
            $vendor_id=$vendor->vendor_id;  
        $coupon_id = $request->coupon_id;
        $coupon_name = $request->coupon_name;
        $coupon_code = $request->coupon_code;
        $coupon_type = $request->coupon_type;
        $coupon_desc = $request->coupon_desc;
        $valid_to = $request->valid_to;
        $valid_from = $request->valid_from;
        $cart_value = $request->cart_value;
        $restriction = $request->restriction;
        
      $this->validate(
            $request,
                [
                    
                    'coupon_name'=>'required',
                    'coupon_code'=>'required',
                    'coupon_desc'=>'required',
                    'valid_to'=>'required',
                    'valid_from'=>'required',
                    'cart_value'=>'required',
                    'restriction'=>'required'
                ],
                [
                    
                    'coupon_name.required'=>'Coupon Name Required',
                    'coupon_code.required'=>'Coupon Code Required',
                    'coupon_desc.required'=>'Coupon Description Required',
                    'valid_to.required'=>'Date Required',
                    'valid_from.required'=>'Date Required',
                    'cart_value.required'=>'Cart value Required',
                    'restriction.required'=>'Enter Uses Restiction limit'

                ]
        );
        $update = DB::table('coupon')
                 ->where('coupon_id', $coupon_id)
                 ->update([
                      'coupon_name'=>$coupon_name,
                       'coupon_description'=>$coupon_desc,
                       'coupon_code'=>$coupon_code,
                       'start_date'=>$valid_to,
                       'type'=>$coupon_type,
                       'end_date'=>$valid_from,
                       'cart_value'=>$cart_value,
                       'vendor_id'=>$vendor_id,
                       'uses_restriction'=>$restriction]);

        if($update){

             

            return redirect()->back()->withErrors(' Updated Successfully');
        }
        else{
            return redirect()->back()->withErrors("something wents wrong.");
        }
     }
     else
      {
        return redirect()->route('vendorlogin')->withErrors('please login first');
      }
    }
  public function pharmacydeletecoupon(Request $request)
    {
        
       
        $coupon_id=$request->coupon_id;

        $getfile=DB::table('coupon')
                ->where('coupon_id',$coupon_id)
                ->first();


    	$delete=DB::table('coupon')->where('coupon_id',$request->coupon_id)->delete();
        if($delete)
        {
         return redirect()->back()->withSuccess('Deleted Successfully');
            }
   
        else
        {
           return redirect()->back()->withErrors('Unsuccessfull Delete'); 
        }

    }
	

}


