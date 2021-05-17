<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class complainController extends Controller
{
    public function complain(Request $request)
    {
        $admin_email=Session::get('admin');
    $com_orders = DB::table('orders')
    	                 ->join('vendor','orders.vendor_id','=','vendor.vendor_id')
    	                 ->join('tbl_user','orders.user_id','=','tbl_user.user_id')
    	                 ->where('orders.order_status','Cancelled')
    	                 ->where('orders.payment_method','!=',NULL)
    	                 ->where('orders.cancelling_reason','!=',NULL)
    	               
    			         ->paginate(15);
        $admin=DB::table('admin')
        ->where('admin_email',$admin_email)
        ->first();	
        return view('admin.complain.show_complain',compact("com_orders", "admin_email", "admin"));
    	
    }
    
     public function adminAddcomplain(Request $request)
    {
        
        $admin_email=Session::get('admin');
    	$admincomplain = DB::table('complains')
    			         ->get();
        $admin=DB::table('admin')
        ->where('admin_email',$admin_email)
        ->first();
        return view('admin.complain.add_complain',compact("admincomplain", "admin_email", "admin"));
    }
    
     public function adminAddNewcomplain(Request $request)
    {
       
        $complain_name = $request->complain_name;
		$description = $request->description;
		
        
        $this->validate(
            $request,
                [
                    'complain_name' => 'required',
                    'description' => 'required',
                ],
                [
                    'complain_name.required' => 'Enter complain name.',
					'description.required' => 'enter description about your complain.',
                ]
        );

        

        $insertcomplain = DB::table('complains')
                            ->insert([
                                'complain_name'=>$complain_name,
                                'description'=>$description,
                            ]);
        
        if($insertcomplain){
            return redirect()->back()->withErrors('complain added successfully');
        }
        else{
            return redirect()->back()->withErrors("Something wents wrong");
        }
    }
    
    public function adminEditcomplain(Request $request)
    {
        
        return redirect()->back()->withErrors('this function is disabled for demo.');
    	$complain_id = $request->complain_id;

    	$complain = DB::table('complains')
        	          ->where('complain_id', $complain_id)
        			  ->first();
        $admin_email=Session::get('admin');
        
        $admin=DB::table('admin')
        ->where('admin_email',$admin_email)
        ->first();
       

        return view('admin.complain.update_complain',compact("complain","admin_email","admin"));
    }

    public function adminUpdatecomplain(Request $request)
    {
        
        return redirect()->back()->withErrors('this function is disabled for demo.');
        $complain_id = $request->complain_id;
        $complain_name = $request->complain_name;
		$description = $request->description;
        $getcomplain = DB::table('complains')
                    ->where('complain_id',$complain_id)
                    ->first();

        $updatecomplain = DB::table('complains')
                            ->where('complain_id', $complain_id)
                            ->update([
                                'complain_name'=>$complain_name,
                                'description'=>$description,
                            ]);
        
        if($updatecomplain){
            return redirect()->back()->withErrors('complain updated successfully');
        }
        else{
            return redirect()->back()->withErrors("Something wents wrong");
        }
    }
    
     public function adminDeletecomplain(Request $request)
    {
    
        $complain_id=$request->complain_id;

        $getfile=DB::table('complains')
                ->where('complain_id',$complain_id)
                ->first();

    	$delete=DB::table('complains')->where('complain_id',$request->complain_id)->delete();
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