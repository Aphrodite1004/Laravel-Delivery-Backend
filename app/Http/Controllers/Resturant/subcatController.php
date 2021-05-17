<?php

namespace App\Http\Controllers\Resturant;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use DB;
use Session;

class subcatController extends Controller
{
    public function resturantsubcat(Request $request)
    {
        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        $subcat= DB::table('resturant_category')
        ->where('vendor_id',$vendor->vendor_id)
        ->paginate(10);
        return view('resturant.subcat.subcat',compact("vendor_email","subcat","vendor"));
    }
    
     public function resturantaddsubcat(Request $request)
    {
        
        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        $category= DB::table('resturant_category')
                ->where('vendor_id',$vendor->vendor_id)
                ->get();
         return view('resturant.subcat.addsubcat',compact("vendor_email","category","vendor"));
    }
    
    
        public function resturantAddNewsubcat(Request $request)
    {
           $this->validate($request,[
            'subcat_name' => 'required',
           

        ]);
        
        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        
        $subcat_name=$request->subcat_name;
        
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');
   


        $insert = DB::table('resturant_category')
                  ->insert(['cat_name'=>$subcat_name,'vendor_id'=>$vendor->vendor_id]);
     
     return redirect()->back()->withErrors('successfully');

    }
    
    public function resturantEditsubcat(Request $request)
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
    	 return view('resturant.subcat.Editsubcat',compact("vendor_email","vendor","category","subcat_id","subcat"));


    }
    public function resturantUpdatesubcat(Request $request)
    {
       
        $subcat_id=$request->subcat_id;
        $category_name=$request->category_name;
        $subcat_name=$request->subcat_name;
        $old_subcat_image=$request->old_subcat_image;
        $date = date('d-m-Y');
        $updated_at = date("d-m-y h:i a");
        $date=date('d-m-y');
        
        $this->validate(
            $request,
                [
                    'category_name'=>'required',
                    'subcat_image' => 'mimes:jpeg,png,jpg|max:400',
                    'old_subcat_image'=>'required',
                ],
                [
        
                    'category_name.required'=>'Enter your name',
                    'old_subcat_image.required' => 'choose picture.',
                ]
        );

        $getImage = DB::table('subcat')
                     ->where('subcat_id',$subcat_id)
                    ->first();

        $image = $getImage->subcat_image;  

        if($request->hasFile('subcat_image')){
             if(file_exists($image)){
                unlink($image);
            }
            $subcat_image = $request->subcat_image;
            $fileName = date('dmyhisa').'-'.$subcat_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $subcat_image->move('subcat/images/'.$date.'/', $fileName);
            $subcat_image = 'subcat/images/'.$date.'/'.$fileName;
        }
        else{
            $subcat_image = $old_subcat_image;
        }

        $update = DB::table('subcat')
                 ->where('subcat_id', $subcat_id)
                 ->update(['category_id'=>$category_name,'subcat_name'=>$subcat_name, 'subcat_image'=>$subcat_image,'updated_at'=>$updated_at]);

        if($update){

             

            return redirect()->back()->withErrors(' updated successfully');
        }
        else{
            return redirect()->back()->withErrors("something wents wrong.");
        }
    }
  public function resturantdeletesubcat(Request $request)
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

                $subcat= DB::table('resturant_category')
                ->where('vendor_id',$vendor->vendor_id)
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
        
     $od = DB::table('resturant_category')
     ->where('vendor_id', $id)
     ->where([['cat_name','=',$subcatname]])->get();
       return $od;
    }
}
    
}
