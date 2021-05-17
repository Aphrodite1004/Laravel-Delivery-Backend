<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class DealProductController extends Controller
{
    public function dealroduct(Request $request)
    {
        $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
                    $vendor_id = $vendor->vendor_id;
                    $currentdate = Carbon::now();
           $deal_p = DB::table('deal_product')
                    ->join('product_varient','deal_product.varient_id','=','product_varient.varient_id')
                    ->join('product','product_varient.product_id','=','product.product_id')
                    ->where('deal_product.vendor_id',$vendor_id)
                    ->get();
        
    	return view('vendor.deal_product.deal_list', compact("vendor_email", "vendor","deal_p","currentdate"));
    }

    
     public function AddDealproduct(Request $request)
    {
         $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
                $vendor_id = $vendor->vendor_id;
           $deal = DB::table('product_varient')
                ->join('product','product_varient.product_id','=','product.product_id')
                ->where('product.vendor_id',$vendor_id)
                ->get();
        
        
        
        return view('vendor.deal_product.add_deal',compact("deal", "vendor_email","vendor"));
     }
    
     public function AddNewDealproduct(Request $request)
    {
         if(Session::has('vendor'))
        {
             $vendor_email=Session::get('vendor');
             $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
            $vendor_id=$vendor->vendor_id; 
            
        $varient_id = $request->varient_id;
        $deal_price = $request->deal_price;
        $valid_from = $request->valid_from;
        $valid_to = $request->valid_to;
        $date=date('d-m-Y');
 
    
        
        $this->validate(
            $request,
                [
                    
                    'varient_id' => 'required',
                    'deal_price' => 'required',
                    'valid_from' => 'required',
                    'valid_to'=>'required',
                ],
                [
                    'varient_id.required' => 'Select Varient',
                    'deal_price.required' => 'Enter Deal Price',
                    'valid_from.required' => 'Choose valid from date',
                    'valid_to.required'=> 'Choose valid from date',
                ]
        );


        $insertCategory = DB::table('deal_product')
                            ->insert([
                                'varient_id'=>$varient_id,
                                'deal_price'=>$deal_price,
                                'valid_from'=>$valid_from,
                                'valid_to'=>$valid_to,
                                'status'=>1,
                                'vendor_id'=>$vendor_id,
                               
                            ]);
        
        if($insertCategory){
            return redirect()->back()->withSuccess('Deal Product Added successfully');
            }
        }
          else
          {
            return redirect()->route('vendorlogin')->withErrors('please login first');
          }
      
    }
    
    public function EditDealproduct(Request $request)
    {
         $deal_id = $request->id;
         $deal = DB::table('product_varient')
                ->join('product','product_varient.product_id','=','product.product_id')
                ->get();
        
          $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
          $deal_p = DB::table('deal_product')
                    ->join('product_varient','deal_product.varient_id','=','product_varient.varient_id')
                    ->join('product','product_varient.product_id','=','product.product_id')
                    ->where('deal_id',$deal_id)
                    ->first();

        return view('vendor.deal_product.edit_deal',compact("deal_p","vendor_email","deal","vendor"));
    }

    public function UpdateDealproduct(Request $request)
    {
        $deal_id = $request->id;
       $varient_id = $request->varient_id;
        $deal_price = $request->deal_price;
        $valid_from = $request->valid_from;
        $valid_to = $request->valid_to;
        $date=date('d-m-Y');
 
    
        
        $this->validate(
            $request,
                [
                    
                    'varient_id' => 'required',
                    'deal_price' => 'required',
                    'valid_from' => 'required',
                    'valid_to'=>'required',
                ],
                [
                    'varient_id.required' => 'Select Varient',
                    'deal_price.required' => 'Enter Deal Price',
                    'valid_from.required' => 'Choose valid from date',
                    'valid_to.required'=> 'Choose valid from date',
                ]
        );


        $updateDeal = DB::table('deal_product')
                    ->where('deal_id', $deal_id)
                            ->update([
                                'varient_id'=>$varient_id,
                                'deal_price'=>$deal_price,
                                'valid_from'=>$valid_from,
                                'valid_to'=>$valid_to,
                                'status'=>1,
                               
                            ]);
        
        if($updateDeal){
            return redirect()->back()->withSuccess('Deal Product Updated successfully');
        }
        else{
            return redirect()->back()->withErrors("Something Wents Wrong");
        }
    }

 public function DeleteDealproduct(Request $request)
    {
        $deal_id = $request->id;

    	$delete=DB::table('deal_product')->where('deal_id',$deal_id)->delete();
        if($delete)
        {
        return redirect()->back()->withSuccess('Deleted Successfully');
        }
        else
        {
           return redirect()->back()->withErrors('Unsuccessfull Delete'); 
        }
    }

}