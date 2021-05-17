<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class CouponController extends Controller
{
    public function couponlist(Request $request)
    {
        
         $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
                
         $coupon= DB::table('coupon')
                ->where("vendor_id",$vendor->vendor_id)
                ->get();
        return view('vendor.coupon.couponlist',compact("vendor","coupon","vendor_email"));
    }
    
     public function vendorcoupon(Request $request)
    {
      
         $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
       
        $coupon= DB::table('coupon')
                ->get();
        return view('vendor.coupon.couponadd',compact("vendor","coupon","vendor_email"));
    }
    
    
    public function addcoupon(Request $request)
    {
       
        if(Session::has('vendor'))
        {
            $vendor_email=Session::get('vendor');
            $vendor=DB::table('vendor')
                ->where('vendor_email',$vendor_email)
                ->first();
            $vendor_id=$vendor->vendor_id;    
    
            $coupon_name = $request->coupon_name;
            $coupon_name_arabic = $request->coupon_name_arabic;
            $coupon_code = $request->coupon_code;
            $coupon_desc = $request->coupon_desc;
            $coupon_desc_arabic = $request->coupon_desc_arabic;
            $valid_to = $request->valid_to;
            $valid_from = $request->valid_from;
            $cart_value = $request->cart_value;
            $coupon_type = $request->coupon_type;
            $coupon_discount =$request->coupon_discount;
            $restriction = $request->restriction;
            // $discount = str_replace("%",'', $coupon_discount);
        
            $this->validate(
                $request,
                    [
                        
                        'coupon_name'=>'required',
                        'coupon_name_arabic'=>'required',
                        'coupon_code'=>'required',
                        'coupon_desc'=>'required',
                        'coupon_desc_arabic'=>'required',
                        'valid_to'=>'required',
                        'valid_from'=>'required',
                        'cart_value'=>'required',
                        'restriction'=>'required'
                    ],
                    [
                        
                        'coupon_name.required'=>'Coupon Name Required',
                        'coupon_name_arabic.required'=>'Arabic coupon name required',
                        'coupon_code.required'=>'Coupon Code Required',
                        'coupon_desc.required'=>'Coupon Description Required',
                        'coupon_desc_arabic.required'=>'Arabic coupon description required',
                        'valid_to.required'=>'Date Required',
                        'valid_from.required'=>'Date Required',
                        'cart_value.required'=>'Cart value Required',
                        'restriction.required'=>'Enter Uses Restiction limit'

                    ]
            );
            $insert = DB::table('coupon')
                  ->insert([
                       'coupon_name'=>$coupon_name,
                       'coupon_name_arabic'=>$coupon_name_arabic,
                       'coupon_description'=>$coupon_desc,
                       'coupon_description_arabic'=>$coupon_desc_arabic,
                       'coupon_code'=>$coupon_code,
                       'start_date'=>$valid_to,
                       'end_date'=>$valid_from,
                       'type'=>$coupon_type,
                       'uses_restriction'=>$restriction,
                       'amount'=>$coupon_discount,
                       'vendor_id'=>$vendor_id,
                       'cart_value'=>$cart_value]);
     
            return redirect()->back()->withSuccess('Added Successfully');
        }
        else
            {
                return redirect()->route('vendorlogin')->withErrors('please login first');
            }

    }
    
    
    public function editcoupon(Request $request)
    {
       
    	$vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();

        $coupon_id=$request->coupon_id;
        $coupon= DB::table('coupon')
                ->where('coupon_id',$coupon_id)
                ->first();
        return view('vendor.coupon.couponedit',compact("vendor","coupon","vendor_email"));
    }
    public function updatecoupon(Request $request)
    {
       
        if(Session::has('vendor'))
        {
   
            $coupon_id = $request->coupon_id;
            $coupon_name = $request->coupon_name;
            $coupon_name_arabic = $request->coupon_name_arabic;
            $coupon_code = $request->coupon_code;
            $coupon_type = $request->coupon_type;
            $coupon_desc_arabic = $request->coupon_desc_arabic;
            $coupon_desc = $request->coupon_desc;
            $valid_to = $request->valid_to;
            $valid_from = $request->valid_from;
            $cart_value = $request->cart_value;
            $restriction = $request->restriction;
            $vendor_id = $request->vendor_id;
        
        $this->validate(
                $request,
                    [
                        
                        'coupon_name'=>'required',
                        'coupon_name_arabic'=>'required',
                        'coupon_code'=>'required',
                        'coupon_desc'=>'required',
                        'coupon_desc_arabic'=>'required',
                        'valid_to'=>'required',
                        'valid_from'=>'required',
                        'cart_value'=>'required',
                        'restriction'=>'required'
                    ],
                    [
                        'coupon_name.required'=>'Coupon Name Required',
                        'coupon_name_arabic.required'=>'Arabic coupon name required',
                        'coupon_code.required'=>'Coupon Code Required',
                        'coupon_desc.required'=>'Coupon Description Required',
                        'coupon_desc_arabic.required'=>'Arabic coupon description required',
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
                       'coupon_name_arabic'=>$coupon_name_arabic,
                       'coupon_description'=>$coupon_desc,
                       'coupon_description_arabic'=>$coupon_desc_arabic,
                       'coupon_code'=>$coupon_code,
                       'start_date'=>$valid_to,
                       'type'=>$coupon_type,
                       'end_date'=>$valid_from,
                       'cart_value'=>$cart_value,
                       'vendor_id'=>$vendor_id,
                       'uses_restriction'=>$restriction]);

        if($update){

             

            return redirect()->back()->withSuccess(' Updated Successfully');
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
  public function deletecoupon(Request $request)
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


