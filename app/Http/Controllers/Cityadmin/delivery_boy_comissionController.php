<?php

namespace App\Http\Controllers\cityadmin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;
use Excel;

class delivery_boy_comissionController extends Controller
{

   public function cdelivery_boy_comission(Request $request)
   {
    if(Session::has('cityadmin'))
    {

       $cityadmin_email=Session::get('cityadmin');
       $cityadmin=DB::table('cityadmin')
       ->where('cityadmin_email',$cityadmin_email)
       ->first();
       $orders= DB::table('delivery_boy_comission')
       ->join('delivery_boy', 'delivery_boy_comission.delivery_boy_id', '=', 'delivery_boy.delivery_boy_id')
                ->where('delivery_boy.cityadmin_id',$cityadmin->cityadmin_id)
                ->orderBy('order_date', 'desc')
                ->get();
                $delivery_boy= DB::table('delivery_boy')
                ->where('cityadmin_id', $cityadmin->cityadmin_id)
                ->get();
       return view('cityadmin.deliveryboy_comission.comission',compact("cityadmin","orders","delivery_boy"));
      }
    else
    {
       return redirect()->route('cityadminlogin')->withErrors('please login first');
    }
   }

   public function cityadminallexcelgenerator(Request $request)
    {

      if(Session::has('cityadmin'))
      {
        $cityadmin_email=Session::get('cityadmin');
        $cityadmin=DB::table('cityadmin')
        ->where('cityadmin_email',$cityadmin_email)
        ->first();
        $orders= DB::table('delivery_boy_comission')
        ->join('delivery_boy_vendor', 'delivery_boy_comission.delivery_boy_id', '=', 'delivery_boy_vendor.delivery_boy_id')
        ->join('delivery_boy', 'delivery_boy_comission.delivery_boy_id', '=', 'delivery_boy.delivery_boy_id')
        ->join('vendor', 'delivery_boy_vendor.vendor_id', '=', 'vendor.vendor_id')
        ->where('vendor.cityadmin_id',$cityadmin->cityadmin_id)->orderBy('order_date', 'desc')
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

    public function cityadminsearchcomission(Request $request)
    {

      $this->validate($request,[
         'startdate' => 'required',
         'enddate' => 'required',
     ]);
      $sdate=$request->startdate;
      $edate=$request->enddate;
      $delivery_boy_id=$request->delivery_boy_id;

    	if(Session::has('cityadmin'))
          {
            $cityadmin_email=Session::get('cityadmin');
            $cityadmin=DB::table('cityadmin')
            ->where('cityadmin_email',$cityadmin_email)
            ->first();
            $id=$cityadmin->cityadmin_id;
               If($sdate!=null && $edate!=null && $delivery_boy_id!=null && $id!=null){
                  $orders = $this->getSearch($sdate,$edate,$delivery_boy_id,$id);
                  $delivery_boy= DB::table('delivery_boy')
                  ->where('cityadmin_id', $cityadmin->cityadmin_id)
                  ->get();
                 
                
                  return view('cityadmin.deliveryboy_comission.comission',compact("cityadmin_email","orders","delivery_boy","cityadmin"));

               }else{
                $delivery_boy= DB::table('delivery_boy')
                ->where('cityadmin_id', $cityadmin->cityadmin_id)
                ->get();
                              
                return view('cityadmin.deliveryboy_comission.comission',compact("orders","delivery_boy"));
               }
            
          }
        else
             {
                return redirect()->route('vendorlogin')->withErrors('please login first');
             }


    }
    public function getSearch($sdate,$edate,$delivery_boy_id,$id)
{
    if($sdate!=null && $edate!=null && $delivery_boy_id!=null && $id!=null ){
        
     $od = DB::table('delivery_boy_comission')

     ->join('delivery_boy_vendor', 'delivery_boy_comission.delivery_boy_id', '=', 'delivery_boy_vendor.delivery_boy_id')
     ->join('delivery_boy', 'delivery_boy_comission.delivery_boy_id', '=', 'delivery_boy.delivery_boy_id')
     ->join('vendor', 'delivery_boy_vendor.vendor_id', '=', 'vendor.vendor_id')
     ->where([['delivery_boy_comission.order_date','>=',$sdate],['delivery_boy_comission.order_date','<=',$edate],['delivery_boy_comission.delivery_boy_id',$delivery_boy_id]])
     ->where('vendor.cityadmin_id',$id)

     ->get();
       return $od;
    }
     
     
}
 public function cityadminexcelgenerator($startdate,$enddate,$delivery_boy_id)
 {
  $cityadmin_email=Session::get('cityadmin');
  $cityadmin=DB::table('cityadmin')
  ->where('cityadmin_email',$cityadmin_email)
  ->first();
  $orders= DB::table('delivery_boy_comission')
  ->join('delivery_boy_vendor', 'delivery_boy_comission.delivery_boy_id', '=', 'delivery_boy_vendor.delivery_boy_id')
  ->join('delivery_boy', 'delivery_boy_comission.delivery_boy_id', '=', 'delivery_boy.delivery_boy_id')
  ->join('vendor', 'delivery_boy_vendor.vendor_id', '=', 'vendor.vendor_id')
  ->where('vendor.cityadmin_id',$cityadmin->cityadmin_id)
  ->where([['delivery_boy_comission.order_date','>=',$startdate],['delivery_boy_comission.order_date','<=',$enddate],['delivery_boy_comission.delivery_boy_id',$delivery_boy_id]])
  ->orderBy('order_date', 'desc')
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
