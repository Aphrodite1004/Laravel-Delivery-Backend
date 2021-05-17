<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class RewardController extends Controller
{
    public function RewardList(Request $request)
    {
         $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
    	  
        
        $reward = DB::table('reward_points')
                ->where('vendor_id',$vendor->vendor_id)
                ->get();
                
        return view('vendor.reward.rewardlist', compact('vendor_email','vendor','reward'));    
        
        
    }
    public function reward(Request $request)
    {
        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        
         $reward = DB::table('reward_points')
                ->get();
                
        return view('vendor.reward.rewardadd', compact('vendor_email','reward','vendor'));    
        
        
    }
    public function rewardadd(Request $request)
    {
        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        $vendor_id =$vendor->vendor_id;
        
        $min_cart_value = $request->min_cart_value;
        $reward_value = $request->reward_points;
        
        
        $this->validate(
            $request,
                [
                    
                    'min_cart_value'=>'required',
                    'reward_points'=>'required',
                   
                   
                ],
                [
                    
                    'min_cart_value.required'=>'Minimum Value Required',
                    'reward_points.required'=>'Reward Point Required',
                   
                   

                ]
        );
        
    	$insert = DB::table('reward_points')
                    ->insertgetid([
                        'min_cart_value'=>$min_cart_value,
                        'reward_point'=>$reward_value,
                        'vendor_id'=>$vendor_id,
                        
                        ]);
                        
      if($insert){
        return redirect()->back()->withSuccess('Added Successfully');
      }else{
         return redirect()->back()->withErrors('Something Wents Wrong'); 
      }

    }
    
    public function rewardedit(Request $request)
    {
          $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        
        $reward_id = $request->reward_id;

        $reward = DB::table('reward_points')
                ->where('reward_id',$reward_id)
                ->first();
                
        return view('vendor.reward.rewardedit', compact('vendor_email','reward','vendor'));    
        
        
    }
    
    public function rewardupate(Request $request)
    {
        $min_cart_value = $request->min_cart_value;
        $reward_value = $request->reward_points;
       
        $reward_id = $request->reward_id;
        
        $this->validate(
            $request,
                [
                    
                    'min_cart_value'=>'required',
                    'reward_points'=>'required',
                    
                   
                ],
                [
                    
                    'min_cart_value.required'=>'Minimum Value Required',
                    'reward_points.required'=>'Reward Point Required',
                    
                   

                ]
        );
        
    	 $insert = DB::table('reward_points')
    	            ->where('reward_id',$reward_id)
                    ->update([
                        'min_cart_value'=>$min_cart_value,
                        'reward_point'=>$reward_value,
                       
                        ]);
                    
     
        return redirect()->back()->withSuccess('Updated Successfully');
    }
    
    public function rewarddelete(Request $request)
    {
        
        $reward_id=$request->reward_id;

    	$delete=DB::table('reward_points')->where('reward_id',$reward_id)->delete();
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