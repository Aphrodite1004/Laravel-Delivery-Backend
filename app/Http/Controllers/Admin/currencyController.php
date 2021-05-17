<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class currencyController extends Controller
{
    public function currency(Request $request)
    {
    	

                 $admin_email=Session::get('admin');
        
                    $admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();
    	         $currency= DB::table('currency')
    	 		          ->get();
    	 		$currency_sign =   DB::table('payment_currency')
                        ->get();  
    	         return view('admin.currency.currency',compact("admin_email","currency","admin","currency_sign"));



    }
  
    public function Editcurrency(Request $request)
{
   
	 $admin_email=Session::get('admin');
	 $currency_id=$request->id;
	 $currency= DB::table('currency')
	            ->where('currency_id',$currency_id)
                ->first();
    $currency_sign =   DB::table('payment_currency')
                        ->get();         
     $admin=DB::table('admin')
                ->where('admin_email',$admin_email)
                ->first();
	 return view('admin.currency.Editcurrency',compact("admin_email","currency","currency_id","admin","currency_sign"));
}
public function Updatecurrency(Request $request)
{
    
        
        $currency_id = $request->id;
        $currency = $request->currency;
        $currency_sign = $request->currency_sign;
       

        $update = DB::table('currency')
                                ->where('currency_id', $currency_id)
                                ->update(['currency'=>$currency, 'currency_sign'=>$currency_sign]);

        if($update){

             

            return redirect()->back()->withErrors(' updated successfully');
        }
        else{
            return redirect()->back()->withErrors("something wents wrong.");
        }
    }
  
	

}

