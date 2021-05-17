<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class cancel_reasonController extends Controller
{
    public function cancel_reason(Request $request)
    {
        $admin_email=Session::get('admin');
    	$admincancel_reason = DB::table('cancel_for')
    			         ->get();
        $admin=DB::table('admin')
        ->where('admin_email',$admin_email)
        ->first();	
        return view('admin.cancel_reason.show_cancel_reason',compact("admincancel_reason", "admin_email", "admin"));
    	
    }
    
     public function adminAddcancel_reason(Request $request)
    {
        
        $admin_email=Session::get('admin');
    	$admincancel_reason = DB::table('cancel_for')
    			         ->get();
        $admin=DB::table('admin')
        ->where('admin_email',$admin_email)
        ->first();
        return view('admin.cancel_reason.add_cancel_reason',compact("admincancel_reason", "admin_email", "admin"));
    }
    
     public function adminAddNewcancel_reason(Request $request)
    {

        $cancel_reason_name = $request->reason;
		
        
        $this->validate(
            $request,
                [
                    'reason' => 'required'
                ],
                [
                    'reason.required' => 'Enter reason .',
                ]
        );

        

        $insertcancel_reason = DB::table('cancel_for')
                            ->insert([
                                'reason'=>$cancel_reason_name,
                            ]);
        
        if($insertcancel_reason){
            return redirect()->back()->withErrors('Reason added successfully');
        }
        else{
            return redirect()->back()->withErrors("Something wents wrong");
        }
    }
    
    public function adminEditcancel_reason(Request $request)
    {
        
    	$reason_id = $request->res_id;

    	$cancel_reason = DB::table('cancel_for')
        	          ->where('res_id', $reason_id)
        			  ->first();
        $admin_email=Session::get('admin');
        
        $admin=DB::table('admin')
        ->where('admin_email',$admin_email)
        ->first();
       

        return view('admin.cancel_reason.update_cancel_reason',compact("cancel_reason","admin_email","admin"));
    }

    public function adminUpdatecancel_reason(Request $request)
    {
        
        $reason_id = $request->res_id;
        $reason = $request->reason;
        $getcancel_reason = DB::table('cancel_for')
                    ->where('res_id',$reason_id)
                    ->first();

        $updatecancel_reason = DB::table('cancel_for')
                            ->where('res_id', $reason_id)
                            ->update([
                                'reason'=>$reason,
                            ]);
        
        if($updatecancel_reason){
            return redirect()->back()->withErrors('reason updated successfully');
        }
        else{
            return redirect()->back()->withErrors("Something wents wrong");
        }
    }
    
     public function adminDeletecancel_reason(Request $request)
    {
        $reason_id=$request->res_id;

        $getfile=DB::table('cancel_for')
                ->where('res_id',$reason_id)
                ->first();

    	$delete=DB::table('cancel_for')->where('res_id',$request->reason_id)->delete();
        if($delete)
        { 
        return redirect()->back()->withErrors('delete successfully');
        }
        else
        {
           return redirect()->back()->withErrors('unsuccessfull delete'); 
        }

    }

}