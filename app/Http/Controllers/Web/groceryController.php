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

class groceryController extends Controller
{

    public function groceryhome($id){
        $data = DB::table("tbl_category")
        ->join('vendor','vendor.vendor_id','=','tbl_category.vendor_id')
        ->where('tbl_category.vendor_id', $id)->get();
          return view('web.groceryhome',['category' => $data,'storeid'=>$id]);    
    }
    public function groceryproduct($id){
        $product =DB::table("tbl_category")
        ->join('vendor','vendor.vendor_id','=','tbl_category.vendor_id')
        ->join('subcat','tbl_category.category_id','=','subcat.category_id')
        ->join('product','product.subcat_id','=','subcat.subcat_id')
        ->where('tbl_category.category_id', $id)->get();
         
        if(count($product)>0){
          foreach($product as $products){
          $varient = DB::table('product_varient')
                  ->where('product_varient.product_id',$products->product_id)
                  ->get();
                      
            
            $data1[]=array( 'product_id'=>$products->product_id ,'category_id'=>$products->category_id ,'subcat_id'=>$products->subcat_id ,'vendor_id'=>$products->vendor_id ,'product_name'=>$products->product_name, 'products_image'=>$products->product_image, 'data'=>$varient); 
            }
            }
            else{
                $data1[]=array('data'=>'no orders found');
            }
            $currency = DB::table('currency')->first();
            $category = DB::table('tbl_category')->where('vendor_id',$product[0]->vendor_id)->get();

          return view('web.groceryproduct',['product' => $data1,'category' => $category,'currency' => $currency,'storeid'=>$product[0]->vendor_id]);    
    }

    public function varient($id){

      $data=  DB::table('product_varient')
            ->where('varient_id',$id)
            ->get()->tojson();
      return $data;
  }
  public function addtobag(Request $request)
  { 
      $exist = DB::table('cart')->where(array('product_id' => $request->pid,'user_id' => $request->userid,'varient_id' =>  $request->varient))->first();

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
          $insert = DB::table('cart')->insert($insertarray);

          if($insert == 1)
          {
              echo 1;
          }else
          { 
              echo 0;
          }
      }
      
      
  }

  public function updateqtycart(Request $request)
{
    $updateqty = DB::table('cart')->where(array('cart_id' => $request->cartid))->update(array('qty' => $request->data));
    if($updateqty == 1)
    {
        echo 1;
    }else
    {
        echo 0;
    }
}
public function removecartitem(Request $request)
{
    $cartremove = DB::table('cart')->where(array('cart_id' => $request->cartid))->delete();
    if($cartremove == 1)
    {
        echo 1;

    }else
    {
        echo 0;
    }
}

public function productdetail(Request $request)
{
    
    $productdetails = DB::table('product')
    ->join('vendor','vendor.vendor_id','=','product.vendor_id')
    ->where('subcat_id', $request->id)->get();

    if(count($productdetails)>0){
        foreach($productdetails as $products){
        $varient = DB::table('product_varient')
                ->where('product_id',$products->product_id)
                ->get();
                    
          
          $data1[]=array( 'product_id'=>$products->product_id ,'subcat_id'=>$products->subcat_id ,'vendor_id'=>$products->vendor_id ,'product_name'=>$products->product_name, 'products_image'=>$products->product_image, 'data'=>$varient); 
          }
          }
          else{
              $data1[]=array('data'=>'no orders found');
          }
    $category = DB::table('tbl_category')->where('vendor_id',$request->storeid)->get();
    $currency =  DB::table('currency')->first();
    
    return view('web.groceryproductdetails',['category' => $category,'productvarient' =>$data1,'productdetails' => $productdetails,'currency' => $currency,'storeid' => $request->storeid]);
}
public function getproductdetailschange(Request $request)
{
    
    $varienttdetails = DB::table('product_varient')->where(array('varient_id' => $request->varientid))->first();
       $array = array('price' => $varienttdetails->price,'pid' => $varienttdetails->product_id);
        echo json_encode($array);

}
public function getproductdata(Request $request)
{
    $product = DB::table('product')->where('product_id', $request->pid)->get();
    if(count($product)>0){
        foreach($product as $products){
        $varient = DB::table('product_varient')
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
function getTableWhere($table,$where) {

    $data = \DB::table($table)
        ->select(\DB::raw('*'))
        ->where($where)
        ->get();
 
    return $data;
 }
public function grocerycart(Request $request)
{
  $where= array('user_id'=> session('userid'));
  $cartdata = $this->getTableWhere('cart',$where);
  if(count($cartdata)>0){
  $storeid =$cartdata[0]->store_id;
  $category = DB::table('tbl_category')->where('vendor_id',$storeid)->get();
  return view('web.grocerycart',['category' => $category,'cartdata' => $cartdata,'storeid' => $storeid]);

  }else{
    return redirect('/');

  }
}

public function getproductlist(Request $request)
{
     
        $product =  DB::table("tbl_category")
        ->join('vendor','vendor.vendor_id','=','tbl_category.vendor_id')
        ->join('subcat','tbl_category.category_id','=','subcat.category_id')
        ->join('product','product.subcat_id','=','subcat.subcat_id')
        ->where('tbl_category.category_id', $request->cat_id)->get();

        if(count($product)>0){
            foreach($product as $products){
            $varient = DB::table('product_varient')
                    ->where('product_varient.product_id',$products->product_id)
                    ->get();
                        
              
              $data1[]=array( 'product_id'=>$products->product_id ,'category_id'=>$products->category_id ,'subcat_id'=>$products->subcat_id ,'vendor_id'=>$products->vendor_id ,'product_name'=>$products->product_name, 'products_image'=>$products->product_image, 'data'=>$varient); 
              }
              }
              else{
                  $data1[]=array('data'=>'no orders found');
              }      
     

              $currency = DB::table('currency')->first();
              $category = DB::table('tbl_category')->where('vendor_id',$product[0]->vendor_id)->get();
  
              return view('web.groceryproduct',['product' => $data1,'category' => $category,'currency' => $currency,'storeid'=>$product[0]->vendor_id]);    
  
}

public function grocerygetsubcat(Request $request)
{
  $subdata = DB::table('subcat')
    ->join('product','product.subcat_id','=','subcat.subcat_id')
    ->select('subcat.subcat_id','subcat.subcat_name')
    ->groupBy('subcat.subcat_id','subcat.subcat_name')
    ->where(array('subcat.category_id' => $request->catid))->get();
    $html = '';
    foreach($subdata as $subdata)
    {
        $html .= '<div><a href="#" onclick="geturlproduct('.$subdata->subcat_id.','.$request->storeid.')">'.$subdata->subcat_name.'</div>';
    }
    echo $html;
}
public function grocerysearchcategory(Request $request)
{
   
    $product = DB::table('product')->where(array('product_name' => $request->category))->first();
    $prdouctvarient = DB::table('product_varient')->where(array('product_id' => $product->product_id))->first();
      
    $newurl = url('/');
   echo "<script>window.location.href = '".$newurl.'/productdetail/'.$product->subcat_id.'?storeid='.$product->vendor_id."'</script>";

}

public function grocerycheckout(Request $request)
{
  $where= array('user_id'=> session('userid'));
  $cartdata = $this->getTableWhere('cart',$where);
  if(count($cartdata)>0){
  $storeid =$cartdata[0]->store_id;
  $category = DB::table('tbl_category')->where('vendor_id',$storeid)->get();
    $deliverycart = DB::table('user_address')
    ->leftjoin('area','user_address.area_id', '=','area.area_id')
    ->leftjoin('vendor_area','area.area_id', '=','vendor_area.area_id')
    ->where('user_address.user_id',$where)
    ->where('user_address.select_status','!=',2)
    ->where('vendor_area.vendor_id',$storeid)
    ->first();
    return view('web.grocerycheckout',['category' => $category,'cartitem' =>$cartdata,'storeid' => $storeid,'delivery' => $deliverycart]);
  }else{
    return redirect('/');

  }
}

public function gettimeslot(Request $request)
{
            $current_time = Carbon::Now();
            $date = date('Y-m-d');
            $time_slot = DB::table('time_slot')
            ->where('vendor_id',$request->storeid)
            ->first();
            $starttime  = $time_slot->open_hour;
            $endtime  = $time_slot->close_hour;
            $duration  = $time_slot->time_slot;
            $selected_date  = $request->datedata;
        
            $array_of_time = array ();
            $array_of_time1 = array ();
            $currenttime = strtotime ($current_time);
            $start_time    = strtotime ($starttime); //change to strtotime
            $end_time      = strtotime ($endtime); //change to strtotime
        
            $add_mins  = $duration * 60;
        if(strtotime($date)==strtotime($selected_date)){
            while ($start_time <= $currenttime) // loop between time
            {
               $array_of_time[] = date ("H:i", $start_time);
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
               $array_of_time1[] = date ("H:i", $lastNumber);
               $lastNumber += $add_mins; // to check endtie=me
            }
        
            $new_array_of_time1 = array ();
            for($i = 2; $i < count($array_of_time1) - 1; $i++)
            {
                $new_array_of_time1[] = '' . $array_of_time1[$i] . ' - ' . $array_of_time1[$i + 1];
            }
         }
         else{
             while ($start_time <= $end_time) // loop between time
            {
               $array_of_time1[] = date ("H:i", $start_time);
               $start_time += $add_mins; // to check endtie=me
            }
        
            $new_array_of_time1 = array ();
            for($i = 1; $i < count($array_of_time1) - 1; $i++)
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
               $array_of_time1[] = date ("H:i", $start_time);
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

        if($request->datedata == date('Y-m-d'))
        {
            $html = '<br><input type="hidden" name="deliverydate" value="'.$request->datedata.'"><p><b>Choose Time</b></p>';
            foreach($new_array_of_time1 as $new_array_of_time1data)
            {
            $html .= '<div class="row"><div class="col-md-1"><input type="radio" name="timedelivery" value="'.$new_array_of_time1data.'"></div><div class="col-md-3">'.$new_array_of_time1data.'</div><div class="col-md-3">available</div></div>';
            }
        }
    else
    {
    $html = '<br><input type="hidden" name="deliverydate" value="'.$request->datedata.'"><p><b>Choose Time</b></p><div class="row"><div class="col-md-1"><input type="radio" name="timedelivery" value="07:00 - 10:00"></div><div class="col-md-3">07:00 - 10:00</div><div class="col-md-3">available</div></div><div class="row"><div class="col-md-1"><input type="radio" name="timedelivery" value="10:00 - 13:00"></div><div class="col-md-3">10:00 - 13:00</div><div class="col-md-3">available</div></div><div class="row"><div class="col-md-1"><input type="radio" name="timedelivery" value="13:00 - 16:00"></div><div class="col-md-3">13:00 - 16:00</div><div class="col-md-3">available</div></div><div class="row"><div class="col-md-1"><input type="radio" name="timedelivery" value="16:00 - 19:00"></div><div class="col-md-3">16:00 - 19:00</div><div class="col-md-3">available</div></div><div class="row"><div class="col-md-1"><input type="radio" name="timedelivery" value="19:00 - 22:00"></div><div class="col-md-3">19:00 - 22:00</div><div class="col-md-3">available</div></div>';
    }
    echo $html;
}

public function selectaddress(Request $request)
{   
    $update = DB::table('user_address')->where(array('address_id' => $request->addressid))->update(array('select_status' => 1));
    $updatedata = DB::table('user_address')->where('address_id' ,'!=', $request->addressid)->where(array('user_id' => session('userid')))->update(array('select_status' => 0));
     $addressdetails = DB::table('user_address')
     ->join('city', 'user_address.city_id','=','city.city_id')
     ->join('area', 'user_address.area_id','=','area.area_id')
     ->where(array('address_id' => $request->addressid))->first();
     

        $info = array('address' => $addressdetails);
        echo json_encode($info);
        
}

public function placeorder(Request $request)
{
  
    $delcharges = $request->deliverycharges;
    $cartdetails = DB::table('cart')->where(array('user_id' => session('userid')))->get();
    $cartitem = DB::table('cart')->where(array('user_id' => session('userid')))->get();
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
            $product = DB::table('product')->where(array('product_id' =>  $cartitem->product_id))->first();
            $productvarient = DB::table('product_varient')->where(array('varient_id' =>  $cartitem->varient_id))->first();
            $base_price =  $productvarient->price * $cartitem->qty;
            $total_mrp  =  $productvarient->strick_price * $cartitem->qty;
            $infodata = array(
                          'product_name' => $product->product_name,
                          'varient_image' => $productvarient->varient_image,
                          'quantity'      => $productvarient->quantity,
                          'unit'          => $productvarient->unit,
                          'varient_id'    => $productvarient->varient_id,
                          'qty'           => $cartitem->qty,
                          'price'         => $base_price,
                          'total_mrp'     => $total_mrp,
                          'order_cart_id' => $orderiddata,
                          'order_date'    => date('Y-m-d H:i:s'),
                          'addon_price'   =>0

                      );
             $storeinsert = DB::table('order_details')->insert($infodata);
        }
  
       $emptycart = DB::table('cart')->where(array('user_id' => session('userid')))->delete();
      echo $insert;
    }
}

}