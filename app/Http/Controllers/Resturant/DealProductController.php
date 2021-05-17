<?php

namespace App\Http\Controllers\Resturant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class DealProductController extends Controller
{
    public function resturantdealroduct(Request $request)
    {
        $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
                    $vendor_id = $vendor->vendor_id;
                    $currentdate = Carbon::now();
           $deal_p = DB::table('resturant_deal_product')
                    ->join('resturant_variant','resturant_deal_product.variant_id','=','resturant_variant.variant_id')
                    ->join('resturant_product','resturant_variant.product_id','=','resturant_product.product_id')
                    ->where('resturant_deal_product.vendor_id',$vendor_id)
                    ->get();
        
    	return view('resturant.deal_product.deal_list', compact("vendor_email", "vendor","deal_p","currentdate"));
    }

    
     public function resturantAddDealproduct(Request $request)
    {
         $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
                $vendor_id = $vendor->vendor_id;
           $deal = DB::table('resturant_variant')
                ->join('resturant_product','resturant_variant.product_id','=','resturant_product.product_id')
                ->where('resturant_product.vendor_id',$vendor_id)
                ->get();
        
        
        
        return view('resturant.deal_product.add_deal',compact("deal", "vendor_email","vendor"));
     }
    
     public function resturantAddNewDealproduct(Request $request)
    {
         if(Session::has('vendor'))
        {
             $vendor_email=Session::get('vendor');
             $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
            $vendor_id=$vendor->vendor_id; 
            
        $variant_id = $request->variant_id;
        $deal_price = $request->deal_price;
        $date=date('d-m-Y');
 
    
        
        $this->validate(
            $request,
                [
                    
                    'variant_id' => 'required',
                    'deal_price' => 'required',
                ],
                [
                    'variant_id.required' => 'Select Varient',
                    'deal_price.required' => 'Enter Deal Price',
                    
                ]
        );


        $insertCategory = DB::table('resturant_deal_product')
                            ->insert([
                                'variant_id'=>$variant_id,
                                'deal_price'=>$deal_price,
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
    
    public function resturantEditDealproduct(Request $request)
    {
         $deal_id = $request->id;
         $deal = DB::table('resturant_variant')
                ->join('resturant_product','resturant_variant.product_id','=','resturant_product.product_id')
                ->get();
        
          $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
          $deal_p = DB::table('resturant_deal_product')
                    ->join('resturant_variant','resturant_deal_product.variant_id','=','resturant_variant.variant_id')
                    ->join('resturant_product','resturant_variant.product_id','=','resturant_product.product_id')
                    ->where('deal_product_id',$deal_id)
                    ->first();

        return view('resturant.deal_product.edit_deal',compact("deal_p","vendor_email","deal","vendor"));
    }

    public function resturantUpdateDealproduct(Request $request)
    {
        $deal_id = $request->id;
       $variant_id = $request->variant_id;
        $deal_price = $request->deal_price;

        $date=date('d-m-Y');
 
    
        
        $this->validate(
            $request,
                [
                    
                    'variant_id' => 'required',
                    'deal_price' => 'required',
            
                ],
                [
                    'variant_id.required' => 'Select Varient',
                    'deal_price.required' => 'Enter Deal Price',
                ]
        );


        $updateDeal = DB::table('resturant_deal_product')
                    ->where('deal_product_id', $deal_id)
                            ->update([
                                'variant_id'=>$variant_id,
                                'deal_price'=>$deal_price,
                                'status'=>1,
                               
                            ]);
        
        if($updateDeal){
            return redirect()->back()->withSuccess('Deal Product Updated successfully');
        }
        else{
            return redirect()->back()->withErrors("Something Wents Wrong");
        }
    }

 public function resturantDeleteDealproduct(Request $request)
    {
        $deal_id = $request->id;

    	$delete=DB::table('resturant_deal_product')->where('deal_product_id',$deal_id)->delete();
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