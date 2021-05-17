<?php

namespace App\Http\Controllers\Resturant;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;
use Excel;


class delivery_boyController extends Controller
{
    public function resturantdelivery_boy(Request $request)
    {
     if(Session::has('vendor'))
     {

        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        $delivery_boy= DB::table('delivery_boy')
        ->where('vendor_id', $vendor->vendor_id)
        ->get();
        return view('resturant.delivery_boy.delivery_boy',compact("vendor_email","delivery_boy","vendor"));
     }
     else
     {
        return redirect()->route('vendorlogin')->withErrors('please login first');
     }
    }
    
     public function resturantAdddelivery_boy(Request $request)
    {
       
     if(Session::has('vendor'))
     {
       
        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();

        $area= DB::table('vendor_area')
    	                  ->join('area','vendor_area.area_id','=','area.area_id')
    	                   ->where('vendor_area.vendor_id', $vendor->vendor_id)
    	                   ->select('area.area_name','vendor_area.vendor_area_id','vendor_area.delivery_charge','vendor_area.cod','vendor_area.area_id')
    	 		          ->get();
        
         return view('resturant.delivery_boy.adddelivery_boy',compact("vendor_email","vendor","area"));
     }  
     else
         {
            return redirect()->route('vendorlogin')->withErrors('please login first');
         }
    }
    
    
        public function resturantAddNewdelivery_boy(Request $request)
    {
    if(Session::has('vendor'))
     {
   
        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        $delivery_boy_id=$request->id;
        $area_id=$request->area_id;
        $vendor_id=$vendor->vendor_id;
        $delivery_boy_name=$request->delivery_boy_name;
        $delivery_boy_phone=$request->delivery_boy_phone;
        $delivery_boy_comission =$request->delivery_boy_comission;
        $comission = str_replace("%",'', $delivery_boy_comission);
        $password=$request->password1;
        $password2=$request->password2;
        $old_delivery_boy_image=$request->old_delivery_boy_image;
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');
        $delivery_boy_image = $request->delivery_boy_image;
        $fileName = date('dmyhisa').'-'.$delivery_boy_image->getClientOriginalName();
        $fileName = str_replace(" ", "-", $fileName);
        $delivery_boy_image->move('delivery_boy_img/images/'.$date.'/', $fileName);
        $delivery_boy_image = 'delivery_boy_img/images/'.$date.'/'.$fileName;
      $country_code =DB::table('country_code')
                            ->first();
          $code =   $country_code->country_code; 
          
          $chkstorphon = DB::table('delivery_boy')
                      ->where('delivery_boy_phone', $delivery_boy_phone)
                      ->first(); 
                
          if($chkstorphon){
             return redirect()->back()->withErrors('This Phone Number are Already Registered With Another Delivery boy');
        }
     
        if($password!=$password2){
             return redirect()->back()->withErrors('password are not same');
        }

       else{
            $new_pass=Hash::make($password);
            $insert = DB::table('delivery_boy')
              ->insertGetId(['vendor_id'=>$vendor_id,'delivery_boy_name'=>$delivery_boy_name,'delivery_boy_image'=>$delivery_boy_image,'delivery_boy_phone'=> $code.$delivery_boy_phone, 'delivery_boy_pass'=>$new_pass, 'created_at'=>$created_at,'dboy_comission'=>$comission]);
            $total_area=count($area_id);
    for($i=0;$i<=($total_area-1);$i++)
        {
            $insert2 = DB::table('delivery_boy_area')
                  ->insert(['delivery_boy_id'=>$insert, 'area_id'=>$area_id[$i]]);
        }
                  
                  
     
     return redirect()->back()->withErrors('successfully Created');
    }
     }
   else
     {
        return redirect()->route('vendorlogin')->withErrors('please login first');
     }
    }
  
  
  
    public function resturantEditdelivery_boy(Request $request)
    {
     if(Session::has('vendor'))
      {	
  
       $delivery_boy_id=$request->id;
    	 $vendor_email=Session::get('vendor');
    
         $vendor=DB::table('vendor')
                ->where('vendor_email',$vendor_email)
                ->first();       
    	 $delivery_boy= DB::table('delivery_boy')
    	 		  ->where('delivery_boy_id',$delivery_boy_id)
    	 		  ->first();
    	 $delivery_boy_area = DB::table('delivery_boy_area') //
    	        ->join('area','delivery_boy_area.area_id','=', 'area.area_id' )
    	       
                ->where('delivery_boy_id',$delivery_boy_id)
                ->get();   	
           $area= DB::table('vendor_area')
    	                  ->join('area','vendor_area.area_id','=','area.area_id')
    	                   ->where('vendor_area.vendor_id', $vendor->vendor_id)
    	                   ->select('area.area_name','vendor_area.vendor_area_id','vendor_area.delivery_charge','vendor_area.cod','vendor_area.area_id')
    	 		          ->get(); 
                
    	 return view('resturant.delivery_boy.Editdelivery_boy',compact("vendor_email","vendor","delivery_boy_id","delivery_boy", "delivery_boy_area", "area"));
    
      }
     else
      {
        return redirect()->route('vendorlogin')->withErrors('please login first');
      }


    }
    public function resturantUpdatedelivery_boy(Request $request)
   {
     if(Session::has('vendor'))
      {
        
        $area_id=$request->area_id;
        $delivery_boy_id=$request->id;
        $delivery_boy_name=$request->delivery_boy_name;
        $delivery_boy_phone=$request->delivery_boy_phone;
        $password=$request->password1;
        $password2=$request->password2;
        $delivery_boy_comission =$request->delivery_boy_comission;
        $comission = str_replace("%",'', $delivery_boy_comission);
        $old_delivery_boy_image=$request->old_delivery_boy_image;
        $date = date('d-m-Y');
        $updated_at = date("d-m-y h:i a");
        $date=date('d-m-y');
        
         $country_code =DB::table('country_code')
                            ->first();
          $code =   $country_code->country_code; 
        
        $getImage = DB::table('delivery_boy')
                     ->where('delivery_boy_id',$delivery_boy_id)
                    ->first();

        $image = $getImage->delivery_boy_image;  
      
       if($password!=$password2){
             return redirect()->back()->withErrors('password are not same');
        }

       else{
        if($request->hasFile('delivery_boy_image')){
             if(file_exists($image)){
                unlink($image);
            }
            $delivery_boy_image = $request->delivery_boy_image;
            $fileName = date('dmyhisa').'-'.$delivery_boy_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $delivery_boy_image->move('delivery_boy_img/images/'.$date.'/', $fileName);
            $delivery_boy_image = 'delivery_boy_img/images/'.$date.'/'.$fileName;
        }
        else{
            $delivery_boy_image = $old_delivery_boy_image;
        }
        
         if($password!="" && $password2!="")
        {
            if($password!=$password2){
                return redirect()->back()->withErrors('password are not same');
            }
            else
            {
                $new_pass=Hash::make($password);
                $value=array('delivery_boy_name'=>$delivery_boy_name,'delivery_boy_image'=>$delivery_boy_image, 'delivery_boy_pass'=>$new_pass,'delivery_boy_phone'=>$delivery_boy_phone, 'updated_at'=>$updated_at,'dboy_comission'=>$comission);
            }
            
        }
        else
        {
            $value=array('delivery_boy_name'=>$delivery_boy_name,'delivery_boy_image'=>$delivery_boy_image, 'delivery_boy_phone'=>$delivery_boy_phone,'updated_at'=>$updated_at,'dboy_comission'=>$comission);
        }
        $delete = DB::table('delivery_boy_area')
                 ->where('delivery_boy_id', $delivery_boy_id)
                 ->delete();
         $total_area=count($area_id);
        for($i=0;$i<=($total_area-1);$i++)
        {
            $insert3 = DB::table('delivery_boy_area')
                  ->insert(['delivery_boy_id'=>$delivery_boy_id, 'area_id'=>$area_id[$i]]);
        }         
        $update = DB::table('delivery_boy')
                 ->where('delivery_boy_id', $delivery_boy_id)
                 ->update($value);

        if($update){

             

            return redirect()->back()->withErrors(' updated successfully');
        }
        else{
            return redirect()->back()->withErrors("something wents wrong.");
            }
        }
      }
     else
      {
        return redirect()->route('vendorlogin')->withErrors('please login first');
      }
}    

  public function resturantdeletedelivery_boy(Request $request)
    {
     if(Session::has('vendor'))
       {
       
        $delivery_boy_id=$request->id;

        $getfile=DB::table('delivery_boy')
                ->where('delivery_boy_id',$delivery_boy_id)
                ->first();

        $delivery_boy_image=$getfile->delivery_boy_image;

    	$delete=DB::table('delivery_boy')->where('delivery_boy_id',$request->id)->delete();
        if($delete)
        {
        
            if(file_exists($delivery_boy_image)){
                unlink($delivery_boy_image);
            }
         
        return redirect()->back()->withErrors('delete successfully');

        }
        else
        {
           return redirect()->back()->withErrors('unsuccessfull delete'); 
        }
        
      }
     else
      {
        return redirect()->route('vendorlogin')->withErrors('Please Login First');
      }

    }
    
    public function resturantconfirmdeliverystatus(Request $request)
    {
        
        $status = $request->status;
        $id = $request->id;
        
        $confirmdeliverystatus = DB::table('delivery_boy')->where('delivery_boy_id', $id)->update(['is_confirmed'=>$status]);
        
        if($confirmdeliverystatus){
            return redirect()->back()->withErrors('Success');
        }
        else{
            return redirect()->back()->withErrors('Something wrong');
        }
    }
    public function resturantcityadmindelivery_boy(Request $request)
    {
     if(Session::has('vendor'))
     {

        $vendor_email=Session::get('vendor');
        $vendor=DB::table('vendor')
        ->where('vendor_email',$vendor_email)
        ->first();
        $delivery_boy= DB::table('delivery_boy_vendor')
        ->join('delivery_boy', 'delivery_boy_vendor.delivery_boy_id', '=', 'delivery_boy.delivery_boy_id')
        ->where('delivery_boy_vendor.vendor_id', $vendor->vendor_id)
         ->where('delivery_boy.is_confirmed',1)
        ->get();
        return view('resturant.delivery_boy.cityadmindelivery_boy',compact("vendor_email","delivery_boy","vendor"));
     }
     else
     {
        return redirect()->route('vendorlogin')->withErrors('please login first');
     }
    }	
      
}
