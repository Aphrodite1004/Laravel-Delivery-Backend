<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class RewardController extends Controller
{
    public function RewardList(Request $request)
    {
          $admin_email=Session::get('admin');
        
                    $admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();
        
        $reward = DB::table('reward_points')
                ->get();
                
        return view('admin.reward.rewardlist', compact('admin_email','reward','admin'));    
        
        
    }
    public function reward(Request $request)
    {
         $admin_email=Session::get('admin');
        
                    $admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();
        
         $reward = DB::table('reward_points')
                ->get();
                
        return view('admin.reward.rewardadd', compact('admin_email','reward','admin'));    
        
        
    }
    public function rewardadd(Request $request)
    {
        
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
                        
                        ]);
                        
      if($insert){
        return redirect()->back()->withSuccess('Added Successfully');
      }else{
         return redirect()->back()->withErrors('Something Wents Wrong'); 
      }

    }
    
    public function rewardedit(Request $request)
    {
          $admin_email=Session::get('admin');
        
                    $admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();
        
        $reward_id = $request->reward_id;

        $reward = DB::table('reward_points')
                ->where('reward_id',$reward_id)
                ->first();
                
        return view('admin.reward.rewardedit', compact('admin_email','reward','admin'));    
        
        
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

