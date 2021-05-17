<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Service;
use Session;
use Hash;
use Auth;
use App\User;
use Carbon\Carbon;


class Restaurant extends Controller
{
    public function restauranthome($id){
        $data = DB::table("resturant_category")
        ->join('vendor','vendor.vendor_id','=','resturant_category.vendor_id')
        ->where('resturant_category.vendor_id', $id)->get();
          return view('web.restauranthome',['category' => $data,'storeid'=>$id]);    
    }
    public function resturantproductweb($id){
        $product =DB::table("resturant_category")
        ->join('vendor','vendor.vendor_id','=','resturant_category.vendor_id')
        ->join('resturant_product','resturant_product.subcat_id','=','resturant_category.resturant_cat_id')
        ->where('resturant_category.resturant_cat_id', $id)->get();

        if(count($product)>0){
          foreach($product as $products){
          $varient = DB::table('resturant_variant')
                  ->where('resturant_variant.product_id',$products->product_id)
                  ->get();
                      
            
            $data1[]=array( 'product_id'=>$products->product_id ,'subcat_id'=>$products->subcat_id,'vendor_id'=>$products->vendor_id ,'product_name'=>$products->product_name, 'products_image'=>$products->product_image, 'data'=>$varient); 
            }
            }
            else{
                $data1[]=array('data'=>'no orders found');
            }
            $currency = DB::table('currency')->first();
            $category = DB::table('resturant_category')->where('vendor_id',$product[0]->vendor_id)->get();

          return view('web.restaurantproduct',['product' => $data1,'category' => $category,'currency' => $currency,'storeid'=>$product[0]->vendor_id]); 
    }
    public function resturantwebvarient($id)
    {
         $data=  DB::table('resturant_variant')
              ->where('variant_id',$id)
              ->get()->tojson();
        return $data;
    }
     public function resturantproductdetail(Request $request)
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
    
        return view('web.resturantproductdetails',['productvarient' =>$data1,'category' => $category,'productdetails' => $productdetails,'currency' => $currency,'storeid' => $request->storeid]);
    }
    public function restaurantindex(Request $request){
       
        $data = Service::get();
        $serviceinfo = DB::table("vendor_category")->where('ui_type','=',2)->first();
        $id   = $serviceinfo->vendor_category_id;
        $shopdata = DB::table("vendor_category")
        ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
        ->where('vendor_category.ui_type','=',2)
        ->get();
        $map1 = DB::table('map_API')
          ->first();
        $map = $map1->map_api_key;     
        $mapset = DB::table('map_settings')
             ->first();
        $mapbox = DB::table('mapbox')
              ->first();
              $storelist = NULL;
          $category = DB::table('resturant_category')->where(array('vendor_id' => $request->id))->get();
          $vendor = DB::table('vendor')->where(array('vendor_category_id' => $request->id))->get();
          print_r($vendor);die;
          return view('web.restaurantindex',['vendor' => $vendor,'category' => $category,'services' => $data,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);    
   
    }
    function getTableWhere($table,$where) {

    $data = \DB::table($table)
        ->select(\DB::raw('*'))
        ->where($where)
        ->get();
 
    return $data;
 }
    public function resturantcart(Request $request){
    
          $where= array('user_id'=> session('userid'),'store_id' => $request->storeid);
          $cartdata = $this->getTableWhere('cart',$where);
         
          if(!$cartdata->isEmpty())
          {
              $storeid =$cartdata[0]->store_id;
          }else
          {
              $storeid =0;
          }
          
          $category = DB::table('resturant_category')->where('vendor_id',$storeid)->get();
        
            return view('web.resturantcart',['category' => $category,'cartdata' => $cartdata,'storeid' => $storeid]);
    }
    public function  resturantcheckout(Request $request)
    {
         $where= array('user_id'=> session('userid'),'store_id' => $request->storeid);
          $cartdata = $this->getTableWhere('cart',$where);
          $storeid =$cartdata[0]->store_id;
          $category = DB::table('resturant_category')->where('vendor_id',$storeid)->get();
            $deliverycart = DB::table('user_address')
            ->leftjoin('area','user_address.area_id', '=','area.area_id')
            ->leftjoin('vendor_area','area.area_id', '=','vendor_area.area_id')
            ->where('user_address.user_id',$where)
            ->where('user_address.select_status','!=',2)
            ->where('vendor_area.vendor_id',$storeid)
            ->first();
            
        return view('web.resturantcheckout',['category' => $category,'cartitem' =>$cartdata,'storeid' => $storeid,'delivery' => $deliverycart]);
    }
    public function restaurantupdateqtycart(Request $request)
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
    public function restaurantremovecartitem(Request $request)
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
    public function resturantplaceorder(Request $request)
    {
            $delcharges = $request->deliverycharges;
            $cartdetails = DB::table('cart')->where(array('user_id' => session('userid'),'store_id' => $request->storeid))->get();
            $cartitem = DB::table('cart')->where(array('user_id' => session('userid'),'store_id' => $request->storeid))->get();
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
          
               $emptycart = DB::table('cart')->where(array('user_id' => session('userid')))->delete();
              echo $insert;
            }
    }
    public function resturantgetproductlist(Request $request)
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
  
            return view('web.restaurantproduct',['product' => $data1,'category' => $category,'currency' => $currency,'storeid'=>$product[0]->vendor_id]); 
    }
    public function resturantaddtobag(Request $request)
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
    public function subrestaurant(Request $request)
    {
        $data = Service::get();
        $serviceinfo = DB::table("vendor_category")->where('ui_type','=',2)->first();
        $id   = $serviceinfo->vendor_category_id;
        $shopdata = DB::table("vendor_category")
        ->leftjoin('vendor','vendor.vendor_category_id','=','vendor_category.vendor_category_id')
        ->where('vendor_category.ui_type','=',2)
        ->get();
        $map1 = DB::table('map_API')
          ->first();
        $map = $map1->map_api_key;     
        $mapset = DB::table('map_settings')
             ->first();
        $mapbox = DB::table('mapbox')
              ->first();
              $storelist = NULL;
        $restproduct = DB::table('resturant_product')->where(array('vendor_id' => $request->id))->get();
            $banner = DB::table('banner_resturant')->where(array('vendor_id' => $request->id))->get();
            $category = DB::table('resturant_category')->where(array('vendor_id' => $request->id))->get();
        return view('web.subrestaurant',['restproduct' => $restproduct,'banner' => $banner,'category' => $category,'services' => $data,'id' => $id,'storelist' =>$storelist,'shopdata' => $shopdata,'map1' =>$map1,'mapset'=>$mapset,'mapbox'=>$mapbox,'map'=>$map]);
    }
    
    public function getpriceweight(Request $request)
    {
            $productvarient = DB::table('resturant_variant')->where(array('variant_id' => $request->weight ))->first();
    
            $productprice = $productvarient->price;
            $productarray = array('productprice' => $productprice);
           
            echo json_encode($productarray);
    }
}
?>