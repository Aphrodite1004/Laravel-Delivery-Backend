<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class TermConditionController extends Controller
{

    public function termcondition(Request $request)
    {
        $admin_email=Session::get('admin');
        
                    $admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();
        $id = $request->id;
        
        $reedem = DB::table('termcondition')
                ->where('id','4')
                ->first();
                
                
        return view('admin.app_setting.termcondition', compact('admin_email',"reedem",'admin'));    
        
        
    }

    
    public function termconditionupdate(Request $request)
    {
        $id = $request->id;
        $term_condition = $request->term_condition;
    	 $insert = DB::table('termcondition')
    	            ->where('id','4')
                    ->update([
                        'termcondition'=>$term_condition,
                        ]);
     
    return redirect()->back()->withSuccess('Updated Successfully');

    }
    
        public function aboutus(Request $request)
    {
        $admin_email=Session::get('admin');
        
                    $admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();
        $id = $request->id;
        
        $reedem = DB::table('termcondition')
                ->where('id','6')
                ->first();
                
                
        return view('admin.app_setting.about_us', compact('admin_email',"reedem",'admin'));    
        
        
    }

    
    public function aboutusupdate(Request $request)
    {
        $id = $request->id;
        $about_us = $request->about_us;
    	 $insert = DB::table('termcondition')
    	            ->where('id','6')
                    ->update([
                        'termcondition'=>$about_us,
                        ]);
     
    return redirect()->back()->withSuccess('Updated Successfully');

    }
    
       public function Feedback(Request $request)
    {
        
        $admin_email=Session::get('admin');
        
                    $admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();
        
        $support = DB::table('support_queries')
                ->join('tbl_user','support_queries.user_id','=','tbl_user.user_id')
                ->orderBy('query_date','DESC')
                ->get();
                
                
        return view('admin.app_setting.feedback', compact('admin_email',"support",'admin'));    
        
        
    }
    

}

