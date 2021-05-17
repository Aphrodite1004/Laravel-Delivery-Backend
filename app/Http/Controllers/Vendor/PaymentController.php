<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function paymentviavendor(Request $request)
    {
         $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();	
        
        $adminpaymentvia = DB::table('paymentvia')
                        ->where('vendor_id',$vendor->vendor_id)
    			         ->get();
        return view('vendor.paymentvia.show_paymentvia',compact("adminpaymentvia", "admin_email", "admin"));
    	
    }
    
     public function vendorpayment(Request $request)
    {
       
        $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
                    
    	$payment = DB::table('paymentvia')
    			         ->get();
    			         
    	$vendor_payment = DB::table('vendor_payment')
    	                ->where('vendor_id',$vendor->vendor_id)
    	                ->get();
        
        return view('vendor.paymentvia.add_paymentvia',compact("payment", "vendor_email", "vendor","vendor_payment"));
    }
    
     public function vendorpaymentadd(Request $request)
    {
        $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
        $vendor_id = $vendor->vendor_id;          
        $payment_mode = $request->payment_mode;
        $status = $request->status;
        $payment_key = $request->payment_key;
       
        $created_at = Carbon::now();
        $updated_at = Carbon::now();
        $date=date('d-m-Y');
    
    	         
    			         
        if($status=="")
        {
            $status=0;
        }
        
        $this->validate(
            $request,
                [
                    'payment_mode' => 'required',
                ],
                [
                    'payment_mode.required' => 'Enter payment mode.',
                    
                ]
        );

        

        $insertpaymentvia = DB::table('vendor_payment')
                            ->insert([
                                'payment_mode'=>$payment_mode,
                                'status'=>$status,
                                'vendor_id'=>$vendor_id,
                                'payment_key'=>$payment_key,
                            ]);
        
        if($insertpaymentvia){
            return redirect()->back()->withErrors('Payment Gateway Added');
        }
        else{
            return redirect()->back()->withErrors("Something wents wrong");
        }
    
}
    
    public function vendorpaymentedit(Request $request)
    {
         $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
                    
    	$payment_id = $request->payment_id;

    	$paymentvia = DB::table('paymentvia')
        			  ->get();
        			  
        $vendor_payment	= DB::table('vendor_payment')
                        ->where('payment_id',$payment_id)
                        ->first();
        

        return view('vendor.paymentvia.update_paymentvia',compact("paymentvia","vendor_email","vendor","vendor_payment"));
    }

    public function adminUpdatepaymentvia(Request $request)
    {
       
       
        $paymentvia_id = $request->paymentvia_id;
        $payment_mode = $request->payment_mode;
        $status = $request->status;
        $api_key = $request->api_key;
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
                                'Papi_key'=> $api_key,
                                'status'=>$status,
                                'updated_at'=>$updated_at
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

}