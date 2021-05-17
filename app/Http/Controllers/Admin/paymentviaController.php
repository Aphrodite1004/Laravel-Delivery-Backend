<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;
use App\Setting;

class paymentviaController extends Controller
{
    public function paymentvia(Request $request)
    {
        $admin_email=Session::get('admin');
    	
        $admin=DB::table('admin')
        ->where('admin_email',$admin_email)
        ->first();	
        
        $adminpaymentvia = DB::table('paymentvia')
    			         ->get();
        return view('admin.paymentvia.show_paymentvia',compact("adminpaymentvia", "admin_email", "admin"));
    	
    }
    
     public function adminAddpaymentvia(Request $request)
    {
        
    
        $admin_email=Session::get('admin');
    	$adminpaymentvia = DB::table('paymentvia')
    			         ->get();
        $admin=DB::table('admin')
        ->where('admin_email',$admin_email)
        ->first();
        return view('admin.paymentvia.add_paymentvia',compact("adminpaymentvia", "admin_email", "admin"));
    }
    
     public function adminAddNewpaymentvia(Request $request)
    {
        
        $payment_mode = $request->payment_mode;
        $status = $request->status;
        $payment_key = $request->payment_key;
       
        
        $this->validate(
            $request,
                [
                    'payment_mode' => 'required',
                ],
                [
                    'payment_mode.required' => 'Enter payment mode.',
                    
                ]
        );

        

        $insertpaymentvia = DB::table('paymentvia')
                            ->insert([
                                'payment_mode'=>$payment_mode,
                                'status'=>$status,
                                'payment_key'=>$payment_key,
                            ]);
        
        if($insertpaymentvia){
            return redirect()->back()->withErrors('Payment added successfully');
        }
        else{
            return redirect()->back()->withErrors("Something wents wrong");
        }
    
}

        public function adminEditpaymentvia(Request $request)
    {
         $admin_email=Session::get('admin');
    	
        $admin=DB::table('admin')
        ->where('admin_email',$admin_email)
        ->first();
                    
    	$paymentvia_id = $request->paymentvia_id;

    	$paymentvia = DB::table('paymentvia')
        			  ->where('paymentvia_id',$paymentvia_id)
                        ->first();
        			  

        

        return view('admin.paymentvia.update_paymentvia',compact("paymentvia","admin_email","admin"));
    }

    public function adminUpdatepaymentvia(Request $request)
    {
        
        $paymentvia_id = $request->paymentvia_id;
        $payment_mode = $request->payment_mode;
        $status = $request->status;
        $payment_key = $request->payment_key;
        $updated_at = Carbon::now();
        $date = date('d-m-Y');
         if($status=="")
        {
            $status=0;
        }
    
    	

       
        $updatepaymentvia = DB::table('paymentvia')
                            ->where('paymentvia_id', $paymentvia_id)
                            ->update([
                                'payment_mode'=>$payment_mode,
                                'payment_key'=> $payment_key,
                                'status'=>$status,
                                
                            ]);
        
        if($updatepaymentvia){
            return redirect()->back()->withErrors('paymentvia updated successfully');
        }
        else{
            return redirect()->back()->withErrors("Something wents wrong");
        }
    }

    
     public function adminDeletepaymentvia(Request $request)
    {
        $paymentvia_id=$request->paymentvia_id;


    	$delete=DB::table('paymentvia')->where('paymentvia_id',$request->paymentvia_id)->delete();
        if($delete)
        {
         
        return redirect()->back()->withErrors('delete successfully');

        }
        else
        {
           return redirect()->back()->withErrors('unsuccessfull delete'); 
        }

    }
    ////// New Payment Method////
    
        public function updatepymntvia($store = '',Request $request)
    {
       
		    foreach($_POST as $key => $value){
				 if($key == "_token"){
					 continue;
				 }
				 
				 $data = array();
				 $data['value'] = $value; 
				 $data['updated_at'] = Carbon::now();
				 if(Setting::where('name', $key)->exists()){				
					Setting::where('name','=',$key)->update($data);			
				 }else{
					$data['name'] = $key; 
					$data['created_at'] = Carbon::now();
					Setting::insert($data); 
				 }
		    } //End Loop
       return redirect()->back()->withSuccess(trans('keywords.Updated Successfully'));
    }
    
     public function gateway_status(Request $request)
    {  
        $get_status = $request->gateway;
        $payment_currency = $request->payment_currency;
        if($get_status=='razorpay'){
            $update1 = DB::table('settings')
                    ->where('name','paypal_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);
            $update2 = DB::table('settings')
                    ->where('name','razorpay_active')
                    ->update(['value'=>'Yes','payment_currency'=>$payment_currency]);
            $update3 = DB::table('settings')
                    ->where('name','stripe_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);
            $update4 = DB::table('settings')
                    ->where('name','paystack_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);
             $update5 = DB::table('settings')
                    ->where('name','paymongo_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);         
                    
        }elseif($get_status=='paypal'){
            $update1 = DB::table('settings')
                    ->where('name','paypal_active')
                    ->update(['value'=>'Yes','payment_currency'=>$payment_currency]);
            $update2 = DB::table('settings')
                    ->where('name','razorpay_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);
            $update3 = DB::table('settings')
                    ->where('name','stripe_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);
            $update4 = DB::table('settings')
                    ->where('name','paystack_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);
            $update5 = DB::table('settings')
                    ->where('name','paymongo_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);          
        }elseif($get_status=='stripe'){
            $update1 = DB::table('settings')
                    ->where('name','paypal_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);
            $update2 = DB::table('settings')
                    ->where('name','razorpay_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);
            $update3 = DB::table('settings')
                    ->where('name','stripe_active')
                    ->update(['value'=>'Yes','payment_currency'=>$payment_currency]);
            $update4 = DB::table('settings')
                    ->where('name','paystack_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);
            $update5 = DB::table('settings')
                    ->where('name','paymongo_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);          
        }elseif($get_status=='paymongo'){
            $update1 = DB::table('settings')
                    ->where('name','paymongo_active')
                    ->update(['value'=>'Yes','payment_currency'=>$payment_currency]);
            $update2 = DB::table('settings')
                    ->where('name','razorpay_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);
            $update3 = DB::table('settings')
                    ->where('name','stripe_active')
                    ->update(['value'=>'Yes','payment_currency'=>$payment_currency]);
            $update4 = DB::table('settings')
                    ->where('name','paystack_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);
            $update5 = DB::table('settings')
                    ->where('name','paypal_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);        
        }else{
            $update1 = DB::table('settings')
                    ->where('name','paypal_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);
            $update2 = DB::table('settings')
                    ->where('name','razorpay_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);
            $update3 = DB::table('settings')
                    ->where('name','stripe_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);
            $update4 = DB::table('settings')
                    ->where('name','paystack_active')
                    ->update(['value'=>'Yes','payment_currency'=>$payment_currency]);
            $update5 = DB::table('settings')
                    ->where('name','paymongo_active')
                    ->update(['value'=>'No','payment_currency'=>$payment_currency]);          
        }
        
                   
        if($update1 || $update2 || $update3 || $update4 || $update5)   { 
         return redirect()->back()->withSuccess(trans('Updated Successfully, Make Sure you have Updated the payment Curency also'));
     }            
     else{
          return redirect()->back()->withErrors(trans('Nothing to Update'));
     }

    }

}