<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class WalletController extends Controller
{
    public function amountlist(Request $request)
    {
          $admin_email=Session::get('admin');
        
                    $admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();
        
        $reward = DB::table('wallets_plans')
                ->get();
                
        return view('admin.wallet_credits.wallet_credits', compact('admin_email','reward','admin'));    
        
        
    }
    public function wallet_amount(Request $request)
    {
         $admin_email=Session::get('admin');
        
                    $admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();
        
         $reward = DB::table('wallets_plans')
                ->get();
                
        return view('admin.wallet_credits.Add_wallet_credits', compact('admin_email','reward','admin'));    
        
        
    }
    public function wallet_amount_add(Request $request)
    {
        
        $amount = $request->amount;
        
        
        $this->validate(
            $request,
                [
                    
                    'amount'=>'required',
                   
                   
                ],
                [
                    
                    'amount.required'=>'Minimum Value Required',
                   
                   

                ]
        );
        
    	$insert = DB::table('wallets_plans')
                    ->insertgetid([
                        'plans'=>$amount,
                        
                        ]);
                        
      if($insert){
        return redirect()->back()->withSuccess('Added Successfully');
      }else{
         return redirect()->back()->withErrors('Something Wents Wrong'); 
      }

    }
    
    
    public function plan_delete(Request $request)
    {
        
        $reward_id=$request->plan_id;

    	$delete=DB::table('wallets_plans')->where('plan_id',$reward_id)->delete();
        if($delete)
        {
        return redirect()->back()->withSuccess('Deleted successfully');

        }
        else
        {
           return redirect()->back()->withErrors('Something Wents Wrong'); 
        }
    }
    
    public function offer_list(Request $request)
    {
          $admin_email=Session::get('admin');
        
                    $admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();
        
        $reward = DB::table('wallet_offers')
                ->get();
                
        return view('admin.wallet_credits.offerlist', compact('admin_email','reward','admin'));    
        
        
    }
    public function offer_amount(Request $request)
    {
         $admin_email=Session::get('admin');
        
                    $admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();
        
         $reward = DB::table('wallet_offers')
                ->get();
                
        return view('admin.wallet_credits.Wallet_offer_add', compact('admin_email','reward','admin'));    
        
        
    }
    public function offer_amount_add(Request $request)
    {
        
        $amount = $request->amount;
          $max_offer = $request->max_offer;
          $discount_type = $request->discount_type;
          $offer_discount = $request->offer_discount;
          	$date = date('d-m-Y');
        
        
        $this->validate(
            $request,
                [
                    
                    'amount'=>'required',
                    'city_image'=>'required',
                   
                   
                ],
                [
                    
                    'amount.required'=>'Minimum Value Required',
                    'city_image.required'=>'Image  Required',
                   
                   

                ]
        );
        
                if($request->hasFile('city_image'))
        {
        	      	$city_image = $request->city_image;
			        $fileName = date('dmyhisa').'-'.$city_image->getClientOriginalName();
			        $fileName = str_replace(" ", "-", $fileName);
			        $city_image->move('images/admin/admin_banner/'.$date.'/', $fileName);
			        $city_image = 'images/admin/admin_banner/'.$date.'/'.$fileName;

      }
      else
      {
      	$city_image = 'N/A';
      }
        
    	$insert = DB::table('wallet_offers')
                    ->insertgetid([
                        'offer_amount'=>$amount,
                        'value'=>$offer_discount,
                        'type'=>$discount_type,
                        'maximum_offer'=>$max_offer,
                        'offer_image'=>$city_image
                        
                        ]);
                        
      if($insert){
        return redirect()->back()->withSuccess('Added Successfully');
      }else{
         return redirect()->back()->withErrors('Something Wents Wrong'); 
      }

    }
    
    
    public function offer_delete(Request $request)
    {
        
        $reward_id=$request->wallet_id;

    	$delete=DB::table('wallet_offers')->where('wallet_id',$reward_id)->delete();
        if($delete)
        {
        return redirect()->back()->withSuccess('Deleted successfully');

        }
        else
        {
           return redirect()->back()->withErrors('Something Wents Wrong'); 
        }
    }
}

