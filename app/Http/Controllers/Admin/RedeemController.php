<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class RedeemController extends Controller
{

    public function reedem(Request $request)
    {
        $admin_email=Session::get('admin');
        
                    $admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();
        $reedem_id = $request->reedem_id;
        
        $reedem = DB::table('reedem_values')
                
                ->first();
                
                
        return view('admin.reward.redeemedit', compact('admin_email',"reedem",'admin'));    
        
        
    }

    
    public function reedemupdate(Request $request)
    {
        $reward_point = $request->reward_point;
        $value = $request->value;
    	 $insert = DB::table('reedem_values')
                    ->update([
                        'reward_point'=>$reward_point,
                        'value'=>$value,
                        ]);
     
    return redirect()->back()->withSuccess('Updated Successfully');

    }

}

