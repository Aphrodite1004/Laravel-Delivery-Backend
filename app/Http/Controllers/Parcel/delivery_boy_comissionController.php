<?php

namespace App\Http\Controllers\Parcel;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;
use Excel;

class delivery_boy_comissionController extends Controller
{

    public function parceldelivery_boy_comission(Request $request)
    {
    	if(Session::has('vendor'))
          {
              

                 $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
                 $orders= DB::table('delivery_boy_comission')
                 ->join('delivery_boy', 'delivery_boy_comission.delivery_boy_id', '=', 'delivery_boy.delivery_boy_id')
                          ->where('delivery_boy_comission.vendor_id',$vendor->vendor_id)
                          ->orderBy('order_date', 'desc')
    	 		          ->get();

    	         return view('parcel.deliveryboy_comission.comission',compact("vendor_email","vendor","orders"));
          }
        else
             {
                return redirect()->route('vendorlogin')->withErrors('please login first');
             }


    }

    
    public function resturantallexceldownload(Request $request)
    {

      if(Session::has('vendor'))
      {
          

             $vendor_email=Session::get('vendor');
    
                $vendor=DB::table('vendor')
                ->where('vendor_email',$vendor_email)
                ->first();
            $orders= DB::table('delivery_boy_comission')
            ->join('vendor', 'delivery_boy_comission.vendor_id', '=', 'vendor.vendor_id')
            ->join('delivery_boy', 'delivery_boy_comission.delivery_boy_id', '=', 'delivery_boy.delivery_boy_id')
                      ->where('delivery_boy_comission.vendor_id',$vendor->vendor_id)
                    ->get();

          $orders_array[] = array('Delivery Boy Name','Vendor Name', 'Order Date', 'Total Product Price','Comission Price','Amount Status','CartID','User Name','Payment method');
          foreach($orders as $data)
          {
           $orders_array[] = array(
            'Delivery Boy Name'    => $data->delivery_boy_name,
            'Vendor Name'    => $data->vendor_name,
            'Order Date'  => $data->order_date,
            'Total Product Price'   => $data->total_price,
            'Comission Price'   => $data->comission_price,
            'Status'   => $data->status,
            'Cart ID'   => $data->cart_id,
            'User Name'   => $data->user_name,
            'Payment method'   => $data->payment_method

 
           );
          }
          Excel::create('delivery boy commission', function($excel) use ($orders_array){
            $excel->setTitle('delivery boy commission');
            $excel->sheet('delivery boy commission', function($sheet) use ($orders_array){
             $sheet->fromArray($orders_array, null, 'A1', false, false);
            });
         })->download('xlsx');

               }
    else
         {
            return redirect()->route('vendorlogin')->withErrors('please login first');
         }

    }
    public function resturantsearchdeliveryboy(Request $request)
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
                  $orders = $this->resturantgetSearch($sdate,$edate,$vendor_id);


                  return view('vendor.deliveryboy_comission.comission',compact("vendor_email","vendor","orders"));

               }else{

               $orders= DB::table('delivery_boy_comission')
               ->join('vendor', 'delivery_boy_comission.vendor_id', '=', 'vendor.vendor_id')
               ->join('delivery_boy', 'delivery_boy_comission.delivery_boy_id', '=', 'delivery_boy.delivery_boy_id')
                         ->where('delivery_boy_comission.vendor_id',$vendor->vendor_id)
                       ->get();

                       return view('vendor.deliveryboy_comission.comission',compact("vendor_email","vendor","orders"));
                     }
            
          }
        else
             {
                return redirect()->route('vendorlogin')->withErrors('please login first');
             }


    }
    public function resturantgetSearch($sdate,$edate,$vendor_id)
{
    if($sdate!=null && $edate!=null ){
        
     $od = DB::table('delivery_boy_comission')
     ->join('vendor', 'delivery_boy_comission.vendor_id', '=', 'vendor.vendor_id')
     ->join('delivery_boy', 'delivery_boy_comission.delivery_boy_id', '=', 'delivery_boy.delivery_boy_id')
     ->where([['order_date','>=',$sdate],['order_date','<=',$edate]])
     ->where('delivery_boy_comission.vendor_id',$vendor_id)
     ->get();
       return $od;
    }
     
     
}
public function resturantexceldownload($startdate,$enddate)
{
  $vendor_email=Session::get('vendor');
$vendor=DB::table('vendor')
->where('vendor_email',$vendor_email)
->first();

$orders= DB::table('delivery_boy_comission')
->join('vendor', 'delivery_boy_comission.vendor_id', '=', 'vendor.vendor_id')
->join('delivery_boy', 'delivery_boy_comission.delivery_boy_id', '=', 'delivery_boy.delivery_boy_id')
->where([['delivery_boy_comission.order_date','>=',$startdate],['delivery_boy_comission.order_date','<=',$enddate]])
->where('delivery_boy_comission.vendor_id',$vendor->vendor_id)->orderBy('order_date', 'desc')
->get();

$orders_array[] = array('Delivery Boy Name','Vendor Name', 'Order Date', 'Total Product Price','Comission Price','Amount Status','CartID','User Name','Payment method');
foreach($orders as $data)
{
 $orders_array[] = array(
  'Delivery Boy Name'    => $data->delivery_boy_name,
  'Vendor Name'    => $data->vendor_name,
  'Order Date'  => $data->order_date,
  'Total Product Price'   => $data->total_price,
  'Comission Price'   => $data->comission_price,
  'Status'   => $data->status,
  'Cart ID'   => $data->cart_id,
  'User Name'   => $data->user_name,
  'Payment method'   => $data->payment_method


 );
}
Excel::create('delivery boy commission', function($excel) use ($orders_array){
  $excel->setTitle('delivery boy commission');
  $excel->sheet('delivery boy commission', function($sheet) use ($orders_array){
   $sheet->fromArray($orders_array, null, 'A1', false, false);
  });
})->download('xlsx');
}
}
