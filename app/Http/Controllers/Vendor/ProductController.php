<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use DB;
use Session;

class ProductController extends Controller
{
    public function product(Request $request)
    {
    if(Session::has('vendor'))
     {
        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        $product= DB::table('product')
                 ->join('subcat','product.subcat_id', '=', 'subcat.subcat_id')
                 ->join('tbl_category','subcat.category_id', '=', 'tbl_category.category_id')
                 ->where('tbl_category.vendor_id', $vendor->vendor_id)
                ->get();
        $currency =  DB::table('currency')
               ->select('currency_sign')
                ->paginate(10);         
        return view('vendor.product.product',compact("vendor_email","product","vendor","currency"));
	 }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
    }
    
     public function Addproduct(Request $request)
    {
      if(Session::has('vendor'))
      {
        
        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        $subcat= DB::table('subcat')
                ->join('tbl_category','subcat.category_id', '=', 'tbl_category.category_id')
                ->where('vendor_id', $vendor->vendor_id)
                ->get();
                
            
         return view('vendor.product.addproduct',compact("vendor_email","subcat","vendor"));
	 }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
    }
    
    
    public function AddNewproduct(Request $request)
    {
        $this->validate(
            $request,
                [
                    'stock'=> 'required',
                    'product_name'=>'required',
                    'product_name_arabic'=>'required',
                    'subcat_name'=>'required',
                    'price'=>'required',
                    'product_description'=>'required',
                    'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                      'mrp' => 'required',
                       'unit' => 'required',
                       'stock' => 'required',
                       'quantity' => 'required',

                ],
                [    
                    'stock.required' => 'enter stock value',
                    'product_name.required'=> 'enter product name',
                    'subcat_name.required'=>'select subcat name',
                    'price.required'=>'enter price',
                    'product_description.required'=>'enter description about product',
                    'product_image.required'=>'enter image product',
                    'mrp.required'=>'enter mrp',
                    'unit.required'=>'enter unit',
                    'stock.required'=>'enter stock',
                    'quantity.required'=>'enter quantity'

                ]
        );

        if(Session::has('vendor'))
        {
            $vendor_email=Session::get('vendor');
            $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
            $vendor_id=$vendor->vendor_id;
            $vendor_id = $vendor->vendor_id;
            $product_id=$request->id;
            $subcat_name=$request->subcat_name;
            $product_name=$request->product_name;
            $product_name_arabic = $request->product_name_arabic;
            $mrp = $request->mrp;
            $price=$request->price;
            $unit=$request->unit;
            $stock=$request->stock;
            $qty=$request->quantity;
            $old_product_image=$request->old_product_image;
            $product_description =$request->product_description;
            $product_description_arabic =$request->product_description_arabic;
            
            $date = date('d-m-Y');
            $created_at=date('d-m-Y h:i a');
            $product_image = $request->product_image;
            $fileName = date('dmyhisa').'-'.$product_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $product_image->move('product/images/'.$date.'/', $fileName);
            $product_image = 'product/images/'.$date.'/'.$fileName;
        

            $insert = DB::table('product')
                  ->insertGetId(['subcat_id'=>$subcat_name,'product_name'=>$product_name, 'product_name_arabic'=>$product_name_arabic, 'product_image'=>$product_image,'created_at'=>$created_at,'vendor_id'=>$vendor_id]);
            if($insert){
                $add1stvarient = DB::table('product_varient')
                                ->insert(['product_id'=>$insert,'price'=>$mrp, 'strick_price'=>$price, 'varient_image'=>$product_image, 'unit'=>$unit, 'quantity'=>$qty, 'stock'=>$stock,'description'=>$product_description, 'description_arabic'=>$product_description_arabic, 'vendor_id'=>$vendor_id]);
                return redirect()->back()->withErrors('successfully added');
            }
            else{
                return redirect()->back()->withErrors('something went wrong');
            }
        }
        else
        {
            return redirect()->route('vendorlogin')->withErrors('please login first');
        }
    }
    
    public function Editproduct(Request $request)
    {
      if(Session::has('vendor'))
      {	
  
       $product_id=$request->product_id;
    	 $vendor_email=Session::get('vendor');
    	 
         $vendor=DB::table('vendor')
                ->where('vendor_email',$vendor_email)
                ->first();       
    	 $product= DB::table('product')
    	           ->leftjoin('product_varient', 'product.product_id','=', 'product_varient.product_id')
    	 		  ->where('product.product_id',$product_id)
    	 		  ->first();
    	 $subcat=DB::table('subcat')
    	        ->join('tbl_category','subcat.category_id', '=', 'tbl_category.category_id')
                 ->where('vendor_id', $vendor->vendor_id)
                ->get();
    	 return view('vendor.product.Editproduct',compact("vendor_email","vendor","product","product_id","subcat"));
	 }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }

    }
    public function Updateproduct(Request $request)
   {
     if(Session::has('vendor'))
     {
        
        $product_id=$request->product_id;
        $subcat_name=$request->subcat_name;
        $product_name=$request->product_name;
        $product_name_arabic=$request->product_name_arabic;
        $old_product_image=$request->old_product_image;
        $old_product_image=$request->old_product_image;
        $date = date('d-m-Y');
        $updated_at = date("d-m-y h:i a");
        $date=date('d-m-y');
        
        $this->validate(
            $request,
                [
                    'subcat_name'=>'required',
                    'product_image' => 'mimes:jpeg,png,jpg|max:400',
                    'old_product_image'=>'required',
                ],
                [
        
                    'subcat_name.required'=>'select subcat name',
                    'old_product_image.required' => 'choose picture.',
                ]
        );

        $getImage = DB::table('product')
                        ->where('product_id',$product_id)
                        ->first();

        $image = $getImage->product_image;  

        if($request->hasFile('product_image')){
             if(file_exists($image)){
                unlink($image);
            }
            $product_image = $request->product_image;
            $fileName = date('dmyhisa').'-'.$product_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $product_image->move('product/images/'.$date.'/', $fileName);
            $product_image = 'product/images/'.$date.'/'.$fileName;
        }
        else{
            $product_image = $old_product_image;
        }

        $update = DB::table('product')
                 ->where('product_id', $product_id)
                 ->update(['subcat_id'=>$subcat_name,'product_name'=>$product_name, 'product_name_arabic'=>$product_name_arabic, 'product_image'=>$product_image,'updated_at'=>$updated_at]);

        if($update){

            return redirect()->back()->withErrors(' updated successfully');
        }
        else{
            return redirect()->back()->withErrors("something wents wrong.");
        }
	 }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
    }
 public function vendordeleteproduct(Request $request)
    {
        $product_id=$request->product_id;

    	$delete=DB::table('product')->where('product_id',$request->product_id)->delete();
        if($delete)
        {
         $delete=DB::table('product_varient')->where('product_id',$request->product_id)->delete();  
         
        return redirect()->back()->withSuccess('Deleted Successfully');
        }
        else
        {
           return redirect()->back()->withErrors('Unsuccessfull Delete'); 
        }
    }
	
        public function searchproduct(Request $request)
    {

      $this->validate($request,[
         'productname' => 'required',
     ]);
      $productname=$request->productname;

    	if(Session::has('vendor'))
          {
                 $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
                    $id=$vendor->vendor_id;
               If($productname!=null && $id!=null){
                  $product = $this->getSearch($productname,$id);


                  return view('vendor.product.product',compact("vendor_email","product","vendor"));

               }else{

                $product= DB::table('product')
                 ->join('subcat','product.subcat_id', '=', 'subcat.subcat_id')
                 ->join('tbl_category','subcat.category_id', '=', 'tbl_category.category_id')
                 ->where('tbl_category.vendor_id', $vendor->vendor_id)
                ->get();

                                 return view('vendor.product.product',compact("vendor_email","product","vendor"));
                }
            
          }
        else
             {
                return redirect()->route('vendorlogin')->withErrors('please login first');
             }


    }
    public function getSearch($productname,$id)
{
    if($productname!=null && $id!=null){
        
     $od = DB::table('product')
     ->join('subcat','product.subcat_id', '=', 'subcat.subcat_id')
     ->join('tbl_category','subcat.category_id', '=', 'tbl_category.category_id')
     ->where('tbl_category.vendor_id', $id)
     ->where([['product_name','=',$productname]])->get();
       return $od;
    }
}
}
