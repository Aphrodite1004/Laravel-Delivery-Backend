<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Excel;
use App\Traits\SendMail;
use App\Traits\SendSms;

class ComissionController extends Controller
{
   use SendMail;
   use SendSms;
   
    public function comission(Request $request)
    {
    	if(Session::has('vendor'))
          {
              

                 $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
    	         $orders= DB::table('comission')
                          ->where('vendor_id',$vendor->vendor_id)
                          ->orderBy('order_date', 'desc')
    	 		          ->get();

    	         return view('vendor.oder_incentive.comission',compact("vendor_email","vendor","orders"));
          }
        else
             {
                return redirect()->route('vendorlogin')->withErrors('please login first');
             }


    }
    public function allexcelgenerator(Request $request)
    {

      if(Session::has('vendor'))
      {
          

             $vendor_email=Session::get('vendor');
    
                $vendor=DB::table('vendor')
                ->where('vendor_email',$vendor_email)
                ->first();
            $orders= DB::table('comission')
                      ->where('vendor_id',$vendor->vendor_id)->orderBy('order_date', 'desc')
                    ->get();

          $orders_array[] = array('Vendor Name', 'Order Date', 'Total Product Price','Comission Price','Status','CartID','User Name','Payment Method');
          foreach($orders as $data)
          {
           $orders_array[] = array(
            'Vendor Name'    => $data->vendor_name,
            'Order Date'  => $data->order_date,
            'Total Product Price'   => $data->total_price,
            'Comission Price'   => $data->comission_price,
            'Status'   => $data->status,
            'Cart ID'   => $data->cart_id,
            'User Name'   => $data->user_name,
            'Payment Method' => $data->payment_method

 
           );
          }
          Excel::create('commission', function($excel) use ($orders_array){
            $excel->setTitle('commission');
            $excel->sheet('commission', function($sheet) use ($orders_array){
             $sheet->fromArray($orders_array, null, 'A2', false, false);
            });
         })->download('xlsx');

               }
    else
         {
            return redirect()->route('vendorlogin')->withErrors('please login first');
         }

    }

    public function searchcomission(Request $request)
    {

      $this->validate($request,[
         'startdate' => 'required',
         'enddate' => 'required',
     ]);
      $sdate=$request->startdate;
      $edate=$request->enddate;

    	if(Session::has('vendor'))
          {
                 $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
                  $vendor_id =  $vendor->vendor_id;
               If($sdate!=null && $edate!=null){
                  $orders = $this->getSearch($sdate,$edate,$vendor_id);


                   return view('vendor.oder_incentive.comission',compact("vendor_email","vendor","orders"));

               }else{

               $orders= DB::table('comission')
                                 ->where('vendor_id',$vendor->vendor_id);

                 return view('vendor.oder_incentive.comission',compact("vendor_email","vendor","orders"));
               }
            
          }
        else
             {
                return redirect()->route('vendorlogin')->withErrors('please login first');
             }


    }
    public function getSearch($sdate,$edate,$vendor_id)
{
    if($sdate!=null && $edate!=null ){
        
     $od = DB::table('comission')->where([['order_date','>=',$sdate],['order_date','<=',$edate]])->where('vendor_id',$vendor_id)->get();
       return $od;
    }
     
     
}
 public function excelgenerator($startdate,$enddate)
 {
   $vendor_email=Session::get('vendor');
 $vendor=DB::table('vendor')
 ->where('vendor_email',$vendor_email)
 ->first();

 $ordersdata= DB::table('comission')
 ->where([['order_date','>=',$startdate],['order_date','<=',$enddate]])
 ->where('vendor_id',$vendor->vendor_id)->orderBy('order_date', 'desc')
->get();

$orders_array[] = array('Vendor Name', 'Order Date', 'Total Product Price','Comission Price','Status','CartID','User Name','Payment Method');
foreach($ordersdata as $data)
{
$orders_array[] = array(
'Vendor Name'    => $data->vendor_name,
'Order Date'  => $data->order_date,
'Total Product Price'   => $data->total_price,
'Comission Price'   => $data->comission_price,
'Status'   => $data->status,
'Cart ID'   => $data->cart_id,
'User Name'   => $data->user_name,
'Payment Method' => $data->payment_method



);
}
Excel::create('commission', function($excel) use ($orders_array){
$excel->setTitle('commission');
$excel->sheet('commission', function($sheet) use ($orders_array){
$sheet->fromArray($orders_array, null, 'A1', false, false);
});
})->download('xlsx');
 }
 
  public function sendrequest(Request $request)
    {
    	if(Session::has('vendor'))
          {
              

                 $vendor_email=Session::get('vendor');
                 $com_id = $request->com_id;
  
    	         $orders= DB::table('comission')
                          ->where('com_id',$com_id)
                          ->update([
                                     'status'=>1,
                                     ]);
    	 	return redirect()->back()->withErrors('Request Send to Admin');

    	         return view('vendor.oder_incentive.comission',compact("vendor_email","orders"));
          }
        else
             {
                return redirect()->route('vendorlogin')->withErrors('please login first');
             }


    }

    public function vendorsendrequest($com_id)
    {

      $comm= DB::table('comission')
      ->where('com_id',$com_id)
    ->get();

    $logo = DB::table('logo')
    ->where('logo_id', '1')
    ->first();
$app_name =  $logo->logo_name; 

      $vendor_id = $comm[0]->vendor_id;
      $vendor_name = $comm[0]->vendor_name;
      $amount = $comm[0]->total_price;

      $or = DB::table('payout_notification')->insert([
         'vendor_id'=>$vendor_id,
         'vendor_name'=>$vendor_name,
         'amount'=>$amount
         ]);

        


      $data = DB::table('comission')
      ->where('com_id',$com_id)->update(['status'=>"RequestSend"]);

      return redirect()->back()->withErrors('successfully');
   }
}

