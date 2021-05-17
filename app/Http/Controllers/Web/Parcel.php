<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Category;
use Session;
use Hash;
use Auth;
use App\User;
use App\Vendor;
use Carbon\Carbon;

class Parcel extends Controller
{
    public function parcelhome($id){
        $data = DB::table("parcel_category")
        ->join('vendor','vendor.vendor_id','=','parcel_category.vendor_id')
        ->where('parcel_category.vendor_id', $id)->get();

          return view('web.parcelhome',['category' => $data,'storeid'=>$id]);    
    }
    public function parcelsender($id,$storeid){
        
       

      
            $currency = DB::table('currency')->first();
              $category = DB::table("parcel_category")
        ->join('vendor','vendor.vendor_id','=','parcel_category.vendor_id')
        ->where('parcel_category.vendor_id', $storeid)->get();
        
          return view('web.parcelsender',['category' => $category,'currency' => $currency,'storeid' => $storeid]); 
    } 
    public function pharmacywebvarient($id){

        $data=  DB::table('resturant_variant')
              ->where('variant_id',$id)
              ->get()->tojson();
        return $data;
    }
    public function pharmacyproductdetail(Request $request)
{
    
    $productdetails = DB::table('resturant_product')
    ->join('vendor','vendor.vendor_id','=','resturant_product.vendor_id')
    ->where('resturant_product.subcat_id', $request->id)->get();

    if(count($productdetails)>0){
        foreach($productdetails as $products){
        $varient = DB::table('resturant_variant')
                ->where('product_id',$products->product_id)
                ->get();
                    
          
          $data1[]=array( 'product_id'=>$products->product_id ,'subcat_id'=>$products->subcat_id ,'vendor_id'=>$products->vendor_id ,'product_name'=>$products->product_name, 'products_image'=>$products->product_image,'description'=>$products->description, 'data'=>$varient); 
          }
          }
          else{
              $data1[]=array('data'=>'no orders found');
          }
    $currency =  DB::table('currency')->first();
    $category = DB::table('resturant_category')->where('vendor_id',$request->storeid)->get();

    return view('web.pharmacyproductdetails',['productvarient' =>$data1,'category' => $category,'productdetails' => $productdetails,'currency' => $currency,'storeid' => $request->storeid]);
}
public function addsenderaddress(Request $request)
{
  $info = array(
                'source_name' => $request->sendername,
                'source_phone' => $request->sendercontact,
                'source_houseno' => $request->senderhouseno,
                'source_pincode' => $request->senderpincode,
                'source_landmark' => $request->senderlandmark,
                'source_city' => $request->sendercity,
                'source_state' => $request->senderstate,
                'source_add' => $request->senderaddress,
          );
    $data = DB::table('source_address')->insertGetId($info);
    if($data != 1)
    {
        return redirect('destination/'.$request->storeid.'/'.$data);
    }
}
public function destination(Request $request)
{
   $currency = DB::table('currency')->first();
              $category = DB::table("parcel_category")
        ->join('vendor','vendor.vendor_id','=','parcel_category.vendor_id')
        ->where('parcel_category.vendor_id', $request->storeid)->get();
        
          return view('web.parcelreceiver',['category' => $category,'currency' => $currency,'storeid' => $request->storeid,'senderid' => $request->id]); 
}
public function addreceiveraddress(Request $request)
{
   $info = array(
                'destination_name' => $request->receivername,
                'destination_phone' => $request->receivercontact,
                'destination_houseno' => $request->receiverhouseno,
                'destination_pincode' => $request->receiverpincode,
                'destination_landmark' => $request->receiverlandmark,
                'destination_city' => $request->receivercity,
                'destination_state' => $request->receiverstate,
                'destination_add' => $request->receiveraddress,
          );
    $data = DB::table('destination_address')->insertGetId($info);
    if($data != 1)
    {
        return redirect('parceldetails/'.$request->storeid.'/'.$data.'/'.$request->senderid);
    }
}
public function parceldetails(Request $request)
{
    
  $currency = DB::table('currency')->first();
              $category = DB::table("parcel_category")
        ->join('vendor','vendor.vendor_id','=','parcel_category.vendor_id')
        ->where('parcel_category.vendor_id', $request->storeid)->get();
        
          return view('web.parceldetails',['category' => $category,'currency' => $currency,'storeid' => $request->storeid,'senderid' => $request->senderid,'receiverid' => $request->receiverid]);
}
public function parcelgettimeslot(Request $request)
{
      $html = '';
        $current_time = Carbon::Now();
          $date = date('Y-m-d');
          $time_slot = DB::table('time_slot')->where('vendor_id','=',$request->storeid)->first();
          $starttime  = $time_slot->open_hour;
          $endtime  = $time_slot->close_hour;
          $duration  = $time_slot->time_slot;
          $selected_date  = $request->datedata;
          $day = 1;
          $next_date = date('Y-m-d', strtotime($selected_date.' + '.$day.' days'));
          $array_of_time = array ();
          $array_of_time1 = array ();
          $currenttime = strtotime ($current_time);
          $start_time    = strtotime ($selected_date." ".$starttime); //change to strtotime
          $end_time      = strtotime ($selected_date." ".$endtime); //change to strtotime
          if($end_time<$start_time){
              $end_time = strtotime ($next_date." ".$endtime);
          }
          $add_mins  = $duration * 60;
          if($currenttime <= $start_time){
           $k = 0;
          }
           elseif($currenttime <= $start_time+$add_mins){
           $k = 0;
           }
           else{
              $k=1; 
           }
           
          
      if(strtotime($date)==strtotime($selected_date)){
          while ($start_time <= $currenttime) // loop between time
          {
             $array_of_time[] = date ("h:i a", $start_time);
             $start_time += $add_mins; // to check endtie=me
          }

          $new_array_of_time = array ();
          for($i = 0; $i < count($array_of_time) - 1; $i++)
          {
              $new_array_of_time[] = '' . $array_of_time[$i] . ' - ' . $array_of_time[$i + 1];
          }
          
      $items=last($new_array_of_time);
      $numbers = explode('-', $items);
      $last_Number = end($numbers);
       $lastNumber    = strtotime ($last_Number);
       if($last_Number!= NULL){
      while ($lastNumber <= $end_time) // loop between time
          {
             $array_of_time1[] = date ("h:i a", $lastNumber);
             $lastNumber += $add_mins; // to check endtie=me
          }

          $new_array_of_time1 = array ();
          for($i = 0; $i < count($array_of_time1) - 1; $i++)
          {
              $new_array_of_time1[] = '' . $array_of_time1[$i] . ' - ' . $array_of_time1[$i + 1];
          }
       }
       else{
           while ($start_time <= $end_time) // loop between time
          {
             $array_of_time1[] = date ("h:i a", $start_time);
             $start_time += $add_mins; // to check endtie=me
          }
          
          $new_array_of_time1 = array ();
          for($i = 0; $i < count($array_of_time1) - 1; $i++)
          {
              $new_array_of_time1[] = '' . $array_of_time1[$i] . ' - ' . $array_of_time1[$i + 1];
          }
       }
          
      }
      elseif(strtotime($date)>strtotime($selected_date)){
         
                      $message = array('status'=>'0', 'message'=>"You can't select the back date", 'data'=>$current_time);
                  return $message; 
      }
      else{
          while ($start_time <= $end_time) // loop between time
          {
             $array_of_time1[] = date ("h:i a", $start_time);
             $start_time += $add_mins; // to check endtie=me
          }

          $new_array_of_time1 = array ();
          for($i = 0; $i < count($array_of_time1) - 1; $i++)
          {
              $new_array_of_time1[] = '' . $array_of_time1[$i] . ' - ' . $array_of_time1[$i + 1];
          }
          
      }

      if(count($new_array_of_time1)>0){
        $message = array('status'=>'1', 'message'=>'Present time Slot', 'data'=>$new_array_of_time1);
          
            }
            else
            {
                $message = array('status'=>'0', 'message'=>'Oops No time slot present', 'data'=>$current_time);
            
            }
            // $html = '<br><input type="hidden" name="deliverydate" value="'.$request->datedata.'"><p><b>Choose Time</b></p>';
            if($request->datedata == date('Y-m-d'))
            {
                
                // $html = '<br><input type="hidden" name="deliverydate" value="'.$request->datedata.'"><p><b>Choose Time</b></p>';
                 $html = '<option>Choose Time</option>';
                foreach($new_array_of_time1 as $new_array_of_time1data)
                {
                // $html .= '<div class="row"><div class="col-md-1"><input type="radio" name="timedelivery" value="'.$new_array_of_time1data.'"></div><div class="col-md-3">'.$new_array_of_time1data.'</div><div class="col-md-3">available</div></div>';
                 $html .=  '<option value="'.$new_array_of_time1data.'">'.$new_array_of_time1data.'</option>';
                }
            }
        else
        {
           $html = '<option>Choose Time</option>';
            foreach($new_array_of_time1 as $new_array_of_time1datafinal)
                {
                    $html .=  '<option value="'.$new_array_of_time1datafinal.'">'.$new_array_of_time1datafinal.'</option>';
                }
        }
        echo $html;
    
}
public function addparceldetails(Request $request)
{
  $user = DB::table('user_address')->where('user_id','=',session('userid'))->first();
   $charges = DB::table('parcel_charges')->where('vendor_id','=',$request->storeid)->first();
  $info = array(
                'source_address_id' => $request->senderid,
                'destination_address_id' => $request->receiverid,
                'cart_id' => 1,
                'user_id' => session('userid'),
                'vendor_id' => $request->storeid,
                'weight' => $request->weight,
                'length' => $request->length,
                'height' => $request->height,
                'width' => $request->width,
                'pickup_time' => $request->pickuptime,
                'pickup_date' => $request->pickupdate,
                'city_id' => $user->city_id,
                'lat' => $user->lat,
                'lng' => $user->lng,
                'charges' => $charges->parcel_charge,
                'description' => $request->parceldetails,
                'total_price' =>  $charges->parcel_charge,
                'distance' => 20

            );
     $data = DB::table('parcel_details')->insertGetId($info);
    if($data != 1)
    {
        return redirect('parcelconfirmdetails/'.$request->storeid.'/'.$data);
    }
}
public function parcelconfirmdetails(Request $request)
{
   $currency = DB::table('currency')->first();
              $category = DB::table("parcel_category")
        ->join('vendor','vendor.vendor_id','=','parcel_category.vendor_id')
        ->where('parcel_category.vendor_id', $request->storeid)->get();
    $parceldetails = DB::table("parcel_details")->where('parcel_id','=',$request->parceldetailid)->first();
    $sourceaddress =  DB::table("source_address")->where('source_address_id','=',$parceldetails->source_address_id)->first();  
    $recieveraddress =  DB::table("destination_address")->where('destination_address_id','=',$parceldetails->destination_address_id)->first();    
          return view('web.parcelconfirmdetails',['category' => $category,'currency' => $currency,'storeid' => $request->storeid,'praceldetailid' => $request->parceldetailid,'recieveraddress'  => $recieveraddress,'sourceaddress' => $sourceaddress,'parceldetails' => $parceldetails]);
}
public function addorder(Request $request)
{
    $parceldetails = DB::table('parcel_details')->where('parcel_id','=',$request->praceldetailid)->first();
    $vendor = DB::table('vendor')->where('vendor_id','=',$parceldetails->vendor_id)->first();
    $info = array(
                'user_id' => $parceldetails->user_id,
                'vendor_id' => $parceldetails->vendor_id,
                'address_id' => $parceldetails->destination_address_id,
                'cart_id' => $parceldetails->parcel_id,
                'total_price' => $parceldetails->charges,
                'price_without_delivery' => $parceldetails->charges,
                'total_products_mrp' => $parceldetails->charges,
                'payment_method' => $request->paymentmethod,
                'order_date' => date('Y-m-d'),
                'delivery_date' => $parceldetails->pickup_date,
                'delivery_charge' => 0,
                'time_slot' => $parceldetails->pickup_time,
                'ui_type' => $vendor->ui_type,
                'dboy_incentive' => 0
                

            );
     $data = DB::table('orders')->insertGetId($info);
    if($data != 1)
    {
          $info = array(
                'product_name' => 'parcel',
                'quantity' => 0,
                'unit' => $parceldetails->weight,
                'varient_id' => $parceldetails->parcel_id,
                'qty' => $parceldetails->weight,
                'price' => $parceldetails->charges,
                'total_mrp' => $parceldetails->charges,
                'order_cart_id' => $parceldetails->parcel_id,
                'order_date' => date('Y-m-d'),
                'varient_image' => 'sample',
                'addon_id' => 0,
                'addon_price' => 0,
               
                

            );
     $data = DB::table('order_details')->insertGetId($info);
        return redirect()->back()->with('orderid',$data);
    }

}
public function pharmacyaddtobag(Request $request)
{ 
    $exist = DB::table('pharmacy_cart')->where(array('product_id' => $request->pid,'user_id' => $request->userid,'varient_id' =>  $request->varient))->first();

    if(!empty($exist->cart_id))
    {
        echo 2;
    }else
    {
        $cartref = 'CA00'.session('userid');
        $insertarray =  array(
                        'store_id' => $request->storeid,
                        'cartref'  => $cartref,
                        'product_id' => $request->pid,
                        'user_id'    => $request->userid,
                        'qty'        => $request->qty,
                        'varient_id' => $request->varient
                    );
        $insert = DB::table('pharmacy_cart')->insert($insertarray);

        if($insert == 1)
        {
            echo 1;
        }else
        { 
            echo 0;
        }
    }
    
    
}
function getTableWhere($table,$where) {

    $data = \DB::table($table)
        ->select(\DB::raw('*'))
        ->where($where)
        ->get();
 
    return $data;
 }
 public function pharmacygetproductdata(Request $request)
{
    $product = DB::table('resturant_product')->where('product_id', $request->pid)->get();
    if(count($product)>0){
        foreach($product as $products){
        $varient = DB::table('resturant_variant')
                ->where('product_id',$products->product_id)
                ->get();
                    
          
          $data1[]=array('product_id'=>$products->product_id ,'subcat_id'=>$products->subcat_id ,'vendor_id'=>$products->vendor_id ,'product_name'=>$products->product_name, 'products_image'=>$products->product_image, 'data'=>$varient); 
          }
          }
          else{
              $data1[]=array('data'=>'no orders found');
          }
    
          $array = array('productvarient' => $data1);
          echo json_encode($array);


}
public function pharmacycart(Request $request)
{
  $where= array('user_id'=> session('userid'));
  $cartdata = $this->getTableWhere('pharmacy_cart',$where);
  $storeid =$cartdata[0]->store_id;
  $category = DB::table('resturant_category')->where('vendor_id',$storeid)->get();

    return view('web.pharmacycart',['category' => $category,'cartdata' => $cartdata,'storeid' => $storeid]);
}
public function pharmacyupdateqtycart(Request $request)
{
    $updateqty = DB::table('pharmacy_cart')->where(array('cart_id' => $request->cartid))->update(array('qty' => $request->data));
    if($updateqty == 1)
    {
        echo 1;
    }else
    {
        echo 0;
    }
}
public function pharmacyremovecartitem(Request $request)
{
    $cartremove = DB::table('pharmacy_cart')->where(array('cart_id' => $request->cartid))->delete();
    if($cartremove == 1)
    {
        echo 1;

    }else
    {
        echo 0;
    }
}

public function pharmacysearchcategory(Request $request)
{
   
    $product = DB::table('resturant_product')->where(array('product_name' => $request->category))->first();
    $prdouctvarient = DB::table('resturant_variant')->where(array('product_id' => $product->product_id))->first();
      
    $newurl = url('/');
   echo "<script>window.location.href = '".$newurl.'/pharmacyproductdetail/'.$product->subcat_id.'?storeid='.$product->vendor_id."'</script>";

}
public function pharmacygetproductlist(Request $request)
{
     
        $product =  DB::table("resturant_category")
        ->join('vendor','vendor.vendor_id','=','resturant_category.vendor_id')
        ->join('resturant_product','resturant_product.subcat_id','=','resturant_category.resturant_cat_id')
        ->where('resturant_category.resturant_cat_id', $request->cat_id)->get();

        if(count($product)>0){
            foreach($product as $products){
            $varient = DB::table('resturant_variant')
                    ->where('resturant_variant.product_id',$products->product_id)
                    ->get();
                        
              
              $data1[]=array( 'product_id'=>$products->product_id ,'category_id'=>$products->resturant_cat_id ,'subcat_id'=>$products->subcat_id ,'vendor_id'=>$products->vendor_id ,'product_name'=>$products->product_name, 'products_image'=>$products->product_image, 'data'=>$varient); 
              }
              }
              else{
                  $data1[]=array('data'=>'no orders found');
              }      
     

              $currency = DB::table('currency')->first();
              $category = DB::table('resturant_category')->where('vendor_id',$product[0]->vendor_id)->get();
  
            return view('web.pharmacyproduct',['product' => $data1,'category' => $category,'currency' => $currency,'storeid'=>$product[0]->vendor_id]); 

}

public function pharmacycheckout(Request $request)
{
   
  $where= array('user_id'=> session('userid'));
  $cartdata = $this->getTableWhere('pharmacy_cart',$where);
  $storeid =$cartdata[0]->store_id;
  $category = DB::table('resturant_category')->where('vendor_id',$storeid)->get();
    $deliverycart = DB::table('user_address')
    ->leftjoin('area','user_address.area_id', '=','area.area_id')
    ->leftjoin('vendor_area','area.area_id', '=','vendor_area.area_id')
    ->where('user_address.user_id',$where)
    ->where('user_address.select_status','!=',2)
    ->where('vendor_area.vendor_id',$storeid)
    ->first();
    return view('web.pharmacycheckout',['category' => $category,'cartitem' =>$cartdata,'storeid' => $storeid,'delivery' => $deliverycart]);

}
public function pharmacyplaceorder(Request $request)
{
  
    $delcharges = $request->deliverycharges;
    $cartdetails = DB::table('pharmacy_cart')->where(array('user_id' => session('userid')))->get();
    $cartitem = DB::table('pharmacy_cart')->where(array('user_id' => session('userid')))->get();
    $cartarray = array();
     $storearray = array();
    foreach($cartdetails as $cartdetails)
    {
       array_push($cartarray,$cartdetails->cart_id);
       array_push($storearray,$cartdetails->store_id);
    }
   
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    $orderiddata = substr(str_shuffle($permitted_chars), 0, 10);
    $info = array(
            'user_id' => session('userid'),
            'vendor_id' => $request->storeid,
            'ui_type' => $request->uitype,
            'address_id' => $request->addressid,
            'total_price' => $request->finalamount,
            'price_without_delivery' => $request->subtotal,
            'payment_method' => $request->paymentmethod,
            'order_date'     => date('Y-m-d'),
            'delivery_charge' => $delcharges,
            'cart_id'         => $orderiddata,
            'total_products_mrp' => 0,
            'paid_by_wallet'    => 0,
            'rem_price'         => 0,
            'delivery_date'     => $request->deliverydate,
            'time_slot'         => $request->deliverytime,
            'dboy_id'           => 0,
            'order_status'      =>'Pending',
            'coupon_id'         => 0,
            'coupon_discount'   => 0,
            'cancel_by_store'   => 0,
            'dboy_incentive'    => 0
    );
    $insert = DB::table('orders')->insertGetId($info);
  
    if($insert != 0)
    {
        if($request->paymentmethod == 'wallet')
        {
            $walletexist = DB::table('tbl_user')->where(array('user_id' => session('userid')))->first();
            $totwalletamount = $walletexist->wallet_credits - $request->finalamount;
            $walletupdate = DB::table('tbl_user')->where(array('user_id' => session('userid')))->update(array('wallet_credits' => $totwalletamount));
        }
        foreach($cartitem as $cartitem)
        {
            $product = DB::table('resturant_product')->where(array('product_id' =>  $cartitem->product_id))->first();
            $productvarient = DB::table('resturant_variant')->where(array('variant_id' =>  $cartitem->varient_id))->first();
            $base_price =  $productvarient->price * $cartitem->qty;
            $total_mrp  =  $productvarient->strick_price * $cartitem->qty;
            $infodata = array(
                          'product_name' => $product->product_name,
                          'varient_image' => $product->product_image,
                          'quantity'      => $productvarient->quantity,
                          'unit'          => $productvarient->unit,
                          'varient_id'    => $productvarient->variant_id,
                          'qty'           => $cartitem->qty,
                          'price'         => $base_price,
                          'total_mrp'     => $total_mrp,
                          'order_cart_id' => $orderiddata,
                          'order_date'    => date('Y-m-d H:i:s'),
                          'addon_price'   =>0

                      );
             $storeinsert = DB::table('order_details')->insert($infodata);
        }
  
       $emptycart = DB::table('pharmacy_cart')->where(array('user_id' => session('userid')))->delete();
      echo $insert;
    }
}

}
