<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class AppRefferController extends Controller
{

    public function reffer(Request $request)
    {
        $admin_email=Session::get('admin');
        
                    $admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();
        $id = $request->id;
        
        $reffer = DB::table('tbl_scratch_card')
                ->where('id','9')
                ->first();
                
                
        return view('admin.app_setting.app_share', compact('admin_email',"reffer",'admin'));    
        
        
    }

    
    public function refferupdate(Request $request)
    {
        $id = $request->id;
        $message = $request->message;
        $min_value = $request->min_value;
        $max_value = $request->max_value;
        $app_link = $request->app_link;
        
    if($min_value>=$max_value)
            {
                return redirect()->back()->withSuccess('You have Entred Min Vale is greater than Max Value');
            }
    	 $insert = DB::table('tbl_scratch_card')
    	            ->where('id','9')
                    ->update([
                        'reffer_message'=>$message,
                        'min'=>$min_value,
                        'max'=>$max_value,
                        'app_link'=>$app_link,
                        ]);
     
    return redirect()->back()->withSuccess('Updated Successfully');

    }

}

