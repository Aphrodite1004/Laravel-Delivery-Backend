<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Excel;

class ComissionController extends Controller
{
   
    public function admincomission(Request $request)
    {
    	if(Session::has('admin'))
          {
              

            $admin_email=Session::get('admin');
        
            $admin=DB::table('admin')
            ->where('admin_email',$admin_email)
            ->first();
    	         $orders= DB::table('comission')
                          ->orderBy('order_date', 'desc')->where('status','!=','Pending')
    	 		          ->get();
               $vendors= DB::table('vendor')
                      ->get();
    	         return view('admin.comission.comission',compact("admin_email","admin","orders","vendors"));
          }
        else
             {
                return redirect()->route('adminlogin')->withErrors('please login first');
             }


    }
    public function adminallexcelgenerator(Request $request)
    {

      if(Session::has('admin'))
      {
          

         $admin_email=Session::get('admin');
        
         $admin=DB::table('admin')
         ->where('admin_email',$admin_email)
         ->first();
            $orders= DB::table('comission')->where('status','!=','Pending')
                      ->orderBy('order_date', 'desc')
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
            'Payment Method'   => $data->payment_method


 
           );
          }
          Excel::create('commission', function($excel) use ($orders_array){
            $excel->setTitle('commission');
            $excel->sheet('commission', function($sheet) use ($orders_array){
             $sheet->fromArray($orders_array, null, 'A1', false, false);
            });
         })->download('xlsx');

               }
    else
         {
            return redirect()->route('vendorlogin')->withErrors('please login first');
         }

    }

    public function adminsearchcomission(Request $request)
    {

      $this->validate($request,[
         'startdate' => 'required',
         'enddate' => 'required',
     ]);
      $sdate=$request->startdate;
      $edate=$request->enddate;
      $vendor_id=$request->vendor_id;

    	if(Session::has('admin'))
          {
                 $admin_email=Session::get('admin');
        
                    $admin=DB::table('admin')
                    ->where('admin_email',$admin_email)
                    ->first();
               if($sdate!=null && $edate!=null && $vendor_id!=null){
                  $orders = $this->getSearch($sdate,$edate,$vendor_id);
                  $vendors= DB::table('vendor')
                  ->join('comission','comission.vendor_id','=','vendor.vendor_id')
                  ->select('comission.com_id','comission.vendor_id','comission.order_date','comission.total_price','comission.comission_price','comission.status','comission.cart_id','comission.user_name','vendor.vendor_name')
                  ->get();

                   return view('admin.comission.comission',compact("admin_email","admin","orders","vendors"));

               }else{

               $orders= DB::table('comission')
                                 ->get();

                 return view('admin.comission.comission',compact("admin_email","admin","orders"));
               }
            
          }
        else
             {
                return redirect()->route('vendorlogin')->withErrors('please login first');
             }


    }
    public function getSearch($sdate,$edate,$vendor_id)
{
    if($sdate!=null && $edate!=null && $vendor_id ){
        
     $od = DB::table('comission')->where([['order_date','>=',$sdate],['order_date','<=',$edate],['vendor_id',$vendor_id],['status','!=','Pending']])->get();
       return $od;
    }
     
     
}
 public function adminexcelgenerator($startdate,$enddate,$vendor_id)
 {
   $admin_email=Session::get('admin');
 $admin=DB::table('admin')
 ->where('admin_email',$admin_email)
 ->first();

 $ordersdata= DB::table('comission')
 ->where([['order_date','>=',$startdate],['order_date','<=',$enddate],['status','!=','Pending']])
 ->where('vendor_id',$vendor_id)->orderBy('order_date', 'desc')
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
 public function adminsendrequest($com_id)
 {
   $data = DB::table('comission')
   ->where('com_id',$com_id)->update(['status'=>"Paid"]);
   return redirect()->back()->withErrors('successfully');

}
}

