<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class SearchController extends Controller
{
 
    public function resturantsearchingFor(Request $request)
    {
        $keyword = $request->prod_name;
         $lat = $request->lat;
       $lng = $request->lng;
        // $vendor_id = $request->vendor_id;

        $searchclass = DB::table('resturant_product')
                      ->join('vendor','resturant_product.vendor_id','=','vendor.vendor_id' )
                      ->select('vendor.*','resturant_product.product_id','resturant_product.subcat_id',DB::raw("6371 * acos(cos(radians(".$lat . ")) 
                    * cos(radians(vendor.lat)) 
                    * cos(radians(vendor.lng) - radians(" . $lng . ")) 
                    + sin(radians(" .$lat. ")) 
                    * sin(radians(vendor.lat))) AS distance"))
                    // ->groupBy('vendor.vendor_name','vendor.lat', 'vendor.lng')
                    ->where('resturant_product.product_name', 'like', $keyword.'%')
                  ->orderBy('distance')
                      ->get();
                      
  if(count($searchclass)>0){
         foreach($searchclass as $searchclasss){
           $prod = DB::table('resturant_product')
                        ->where('product_id',$searchclasss->product_id)
                      ->get();
         if(count($prod)>0){
            $result =array();
            $i = 0;

            foreach ($prod as $prods) {
                array_push($result, $prods);

                $app = json_decode($prods->product_id);
                $apps = array($app);
                $app =  DB::table('resturant_variant')
                     ->join ('resturant_product', 'resturant_variant.product_id', '=', 'resturant_product.product_id')
                     ->whereIn('resturant_variant.product_id', $apps)
                     ->get();
                        
                $result[$i]->varients = $app;
                $i++; 
             
            }

         }          
            $subcat = DB::table('resturant_category')
                        ->where('resturant_cat_id',$searchclasss->subcat_id)
                      ->get();   
                
             $cat = DB::table('resturant_category')
             ->join('vendor','resturant_category.vendor_id','=','vendor.vendor_id' )
              ->select('resturant_category.*','vendor.vendor_name',DB::raw("6371 * acos(cos(radians(".$lat . ")) 
                    * cos(radians(vendor.lat)) 
                    * cos(radians(vendor.lng) - radians(" . $lng . ")) 
                    + sin(radians(" .$lat. ")) 
                    * sin(radians(vendor.lat))) AS distance"))
                    ->orderBy('distance')
                ->where('resturant_category.resturant_cat_id',$searchclasss->subcat_id)
                ->get();           
                      
                      
        
        $data=array('status'=>'1','message'=>'Stores Found', 'stores'=>$searchclass, 'category'=>$cat, 'products'=>$prod); 
           }
        }
        else{
            $data[]=array('status'=>'0','message'=>'Stores Found');
        }
        return $data;       
                        
    }
    
     public function searchingFor(Request $request)
    {
        $keyword = $request->prod_name;
         $lat = $request->lat;
       $lng = $request->lng;
        // $vendor_id = $request->vendor_id;

        $searchclass = DB::table('product')
                      ->join('vendor','product.vendor_id','=','vendor.vendor_id' )
                      ->select('vendor.*','product.product_id','product.subcat_id',DB::raw("6371 * acos(cos(radians(".$lat . ")) 
                    * cos(radians(vendor.lat)) 
                    * cos(radians(vendor.lng) - radians(" . $lng . ")) 
                    + sin(radians(" .$lat. ")) 
                    * sin(radians(vendor.lat))) AS distance"))
                    // ->groupBy('vendor.vendor_name','vendor.lat', 'vendor.lng')
                    ->where('product.product_name', 'like', $keyword.'%')
                  ->orderBy('distance')
                      ->get();
                      
  if(count($searchclass)>0){
         foreach($searchclass as $searchclasss){
           $prod = DB::table('product')
                        ->where('product_id',$searchclasss->product_id)
                      ->get();
         if(count($prod)>0){
            $result =array();
            $i = 0;

            foreach ($prod as $prods) {
                array_push($result, $prods);

                $app = json_decode($prods->product_id);
                $apps = array($app);
                $app =  DB::table('product_varient')
                     ->join ('product', 'product_varient.product_id', '=', 'product.product_id')
                     ->whereIn('product_varient.product_id', $apps)
                     ->get();
                        
                $result[$i]->varients = $app;
                $i++; 
             
            }

         }          
            $subcat = DB::table('subcat')
                        ->where('subcat_id',$searchclasss->subcat_id)
                      ->get();   
                
             $cat = DB::table('tbl_category')
             ->join('vendor','tbl_category.vendor_id','=','vendor.vendor_id' )
              ->join('subcat','tbl_category.category_id','=','subcat.category_id' )
              ->select('tbl_category.*','vendor.vendor_name',DB::raw("6371 * acos(cos(radians(".$lat . ")) 
                    * cos(radians(vendor.lat)) 
                    * cos(radians(vendor.lng) - radians(" . $lng . ")) 
                    + sin(radians(" .$lat. ")) 
                    * sin(radians(vendor.lat))) AS distance"))
                    ->orderBy('distance')
                ->where('subcat.subcat_id',$searchclasss->subcat_id)
                ->get();           
                      
                      
        
        $data=array('status'=>'1','message'=>'Stores Found', 'stores'=>$searchclass, 'category'=>$cat, 'subcat'=>$subcat, 'products'=>$prod); 
           }
        }
        else{
            $data[]=array('status'=>'0','message'=>'Stores Found');
        }
        return $data;       
                        
    }
}
