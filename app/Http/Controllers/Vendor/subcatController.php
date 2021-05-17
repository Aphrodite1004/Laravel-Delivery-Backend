<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use DB;
use Session;

class subcatController extends Controller
{
    public function vendorsubcat(Request $request)
    {
        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
        $subcat= DB::table('subcat')
                    ->join ('tbl_category' , 'subcat.category_id', '=', 'tbl_category.category_id')
                    ->where('vendor_id',$vendor->vendor_id)
                    ->paginate(10);

        return view('vendor.subcat.subcat',compact("vendor_email","subcat","vendor"));
    }
    
     public function vendorAddsubcat(Request $request)
    {
        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        $category= DB::table('tbl_category')
                ->where('vendor_id',$vendor->vendor_id)
                ->get();
         return view('vendor.subcat.addsubcat',compact("vendor_email","category","vendor"));
    }
    
    
    public function vendorAddNewsubcat(Request $request)
    {
        $this->validate($request,[
            'subcat_name' => 'required',
            'subcat_name_arabic' => 'required',
        ]);
        
        $subcat_id=$request->id;
        $category_name=$request->category_name;
        $subcat_name=$request->subcat_name;
        $subcat_name_arabic = $request->subcat_name_arabic;
        $old_subcat_image=$request->old_subcat_image;
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');

        $insert = DB::table('subcat')
                  ->insert(['category_id'=>$category_name,'subcat_name'=>$subcat_name, 'subcat_name_arabic'=>$subcat_name_arabic,'subcat_image'=>'null','created_at'=>$created_at]);
     
        return redirect()->back()->withErrors('successfully');
    }
    
    public function vendorEditsubcat(Request $request)
    {
    
        $subcat_id=$request->subcat_id;
        $vendor_email=Session::get('vendor');
        
        $vendor=DB::table('vendor')
            ->where('vendor_email',$vendor_email)
            ->first();       
        $subcat= DB::table('subcat')
                ->where('subcat_id',$subcat_id)
                ->first();
        $category=DB::table('tbl_category')
            ->where('vendor_id',$vendor->vendor_id)
            ->get();		  
        return view('vendor.subcat.Editsubcat',compact("vendor_email","vendor","category","subcat_id","subcat"));
    }

    public function vendorUpdatesubcat(Request $request)
    {
       
        $subcat_id=$request->subcat_id;
        $category_name=$request->category_name;
        $subcat_name=$request->subcat_name;
        $subcat_name_arabic=$request->subcat_name_arabic;
        $old_subcat_image=$request->old_subcat_image;
        $date = date('d-m-Y');
        $updated_at = date("d-m-y h:i a");
        $date=date('d-m-y');
        
        $this->validate(
            $request,
                [
                    'category_name'=>'required',
                   
                ],
                [
        
                    'category_name.required'=>'Enter your name',
                   
                ]
        );


        $update = DB::table('subcat')
                 ->where('subcat_id', $subcat_id)
                 ->update(['category_id'=>$category_name,'subcat_name'=>$subcat_name, 'subcat_name_arabic'=>$subcat_name_arabic, 'subcat_image'=>'null','updated_at'=>$updated_at]);

        if($update){

             

            return redirect()->back()->withErrors(' updated successfully');
        }
        else{
            return redirect()->back()->withErrors("something wents wrong.");
        }
    }
  public function vendordeletesubcat(Request $request)
    {
       
        $subcat_id=$request->subcat_id;

        $getfile=DB::table('subcat')
                ->where('subcat_id',$subcat_id)
                ->first();

    	$delete=DB::table('subcat')->where('subcat_id',$subcat_id)->delete();
        $deletepro=DB::table('product')->where('subcat_id',$subcat_id)->first();
        if($deletepro != null){
             DB::table('product_varient')->where('product_id',$deletepro->product_id)->delete();
             DB::table('product')->where('subcat_id',$subcat_id)->delete();
        if($delete)
        {
        
        return redirect()->back()->withErrors('delete successfully');

        }
        else
        {
           return redirect()->back()->withErrors('unsuccessfull delete'); 
        }
    }
    else
    {
       return redirect()->back()->withErrors('delete successfully'); 
    }
    }
	    public function searchsubcat(Request $request)
    {

      $this->validate($request,[
         'subcatname' => 'required',
     ]);
      $subcatname=$request->subcatname;

    	if(Session::has('vendor'))
          {
                 $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
                    $id=$vendor->vendor_id;
               If($subcatname!=null && $id!=null){
                  $subcat = $this->getSearch($subcatname,$id);


                  return view('vendor.subcat.subcat',compact("vendor_email","subcat","vendor"));

               }else{

                $subcat= DB::table('subcat')
                ->join ('tbl_category' , 'subcat.category_id', '=', 'tbl_category.category_id')
                ->where('tbl_category.vendor_id',$vendor->vendor_id)
                ->paginate(10);
                return view('vendor.subcat.subcat',compact("vendor_email","subcat","vendor"));
                }
            
          }
        else
             {
                return redirect()->route('vendorlogin')->withErrors('please login first');
             }


    }
    public function getSearch($subcatname,$id)
{
    if($subcatname!=null && $id!=null){
        
     $od = DB::table('subcat')
     ->join ('tbl_category' , 'subcat.category_id', '=', 'tbl_category.category_id')
     ->where('tbl_category.vendor_id', $id)
     ->where([['subcat_name','=',$subcatname]])->get();
       return $od;
    }
}
    
}
