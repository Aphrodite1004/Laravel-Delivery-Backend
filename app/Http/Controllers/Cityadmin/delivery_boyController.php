<?php

namespace App\Http\Controllers\cityadmin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;
use Excel;

class delivery_boyController extends Controller
{
    public function delivery_boy(Request $request)
    {
     if(Session::has('cityadmin'))
     {

        $cityadmin_email=Session::get('cityadmin');
        $cityadmin=DB::table('cityadmin')
        ->where('cityadmin_email',$cityadmin_email)
        ->first();
        $delivery_boy= DB::table('delivery_boy')
        ->where('cityadmin_id', $cityadmin->cityadmin_id)
        ->get();
        return view('cityadmin.delivery_boy.delivery_boy',compact("cityadmin_email","delivery_boy","cityadmin"));
     }
     else
     {
        return redirect()->route('cityadminlogin')->withErrors('please login first');
     }
    }
    
     public function Adddelivery_boy(Request $request)
    {
     if(Session::has('cityadmin'))
     {
        
        $cityadmin_email=Session::get('cityadmin');
        $cityadmin=DB::table('cityadmin')
        ->where('cityadmin_email',$cityadmin_email)
        ->first();

        $area= DB::table('area')
                ->join('cityadmin','area.cityadmin_id','=','cityadmin.cityadmin_id')
                ->join('city','cityadmin.city_id', '=', 'city.city_id')
                ->where('cityadmin.cityadmin_id',$cityadmin->cityadmin_id)
                ->get();
         $vendors= DB::table('vendor')
             ->where('cityadmin_id',$cityadmin->cityadmin_id)
             ->get();       
        
         return view('cityadmin.delivery_boy.adddelivery_boy',compact("cityadmin_email","cityadmin","area","vendors"));
     }  
     else
         {
            return redirect()->route('cityadminlogin')->withErrors('please login first');
         }
    }
    
    
        public function AddNewdelivery_boy(Request $request)
    {
           $this->validate($request,[
               'delivery_boy_name' => 'required',
               'delivery_boy_phone' => 'required',
                'delivery_boy_comission' => 'required',
                'password1' => 'required',
                'password2' => 'required',
               'delivery_boy_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

           ]);
    if(Session::has('cityadmin'))
     {
      
        $cityadmin_email=Session::get('cityadmin');
        $cityadmin=DB::table('cityadmin')
        ->where('cityadmin_email',$cityadmin_email)
        ->first();
       
        $area_id=$request->area_id;
        $vendor_id=$request->vendor_id;
        $cityadmin_id=$cityadmin->cityadmin_id;
        $delivery_boy_name=$request->delivery_boy_name;
        $delivery_boy_phone=$request->delivery_boy_phone;
        $delivery_boy_comission =$request->delivery_boy_comission;
        $comission = str_replace("%",'', $delivery_boy_comission);
        $password=$request->password1;
        $password2=$request->password2;
        
        $country_code =DB::table('country_code')
                            ->first();
          $code =   $country_code->country_code; 
          
          $number = $code.$delivery_boy_phone;
      
        $date = date('d-m-Y');
        $created_at=date('d-m-Y h:i a');
        $delivery_boy_image = $request->delivery_boy_image;
        $fileName = date('dmyhisa').'-'.$delivery_boy_image->getClientOriginalName();
        $fileName = str_replace(" ", "-", $fileName);
        $delivery_boy_image->move('delivery_boy_img/images/'.$date.'/', $fileName);
        $delivery_boy_image = 'delivery_boy_img/images/'.$date.'/'.$fileName;
        
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
              ->insertGetId(['cityadmin_id'=>$cityadmin_id,'delivery_boy_name'=>$delivery_boy_name,'delivery_boy_image'=>$delivery_boy_image,'delivery_boy_phone'=> $code.$delivery_boy_phone, 'delivery_boy_pass'=>$new_pass, 'created_at'=>$created_at,'dboy_comission'=>$comission]);
            $total_area=count($area_id);
    for($i=0;$i<=($total_area-1);$i++)
        {
            $insert2 = DB::table('delivery_boy_area')
                  ->insert(['delivery_boy_id'=>$insert, 'area_id'=>$area_id[$i]]);
        }
        $total_vendor=count($vendor_id);
      if($total_vendor>0) {
        for($i=0;$i<=($total_vendor-1);$i++)
        {
  
            $insert2 = DB::table('delivery_boy_vendor')
                  ->insert(['delivery_boy_id'=>$insert,'vendor_id'=>$vendor_id[$i]]);
        }

      }        
                  
     
     return redirect()->back()->withErrors('successfully Created');
    }
     }
   else
     {
        return redirect()->route('cityadminlogin')->withErrors('please login first');
     }
    }
  
  
  
    public function Editdelivery_boy(Request $request)
    {
     if(Session::has('cityadmin'))
      {	
     
       $delivery_boy_id=$request->id;
    	 $cityadmin_email=Session::get('cityadmin');
    
         $cityadmin=DB::table('cityadmin')
                ->where('cityadmin_email',$cityadmin_email)
                ->first();       
    	 $delivery_boy= DB::table('delivery_boy')
    	 		  ->where('delivery_boy_id',$delivery_boy_id)
    	 		  ->first();
    	 $delivery_boy_area = DB::table('delivery_boy_area') //
    	        ->join('area','delivery_boy_area.area_id','=', 'area.area_id' )
    	       
                ->where('delivery_boy_id',$delivery_boy_id)
                ->get();   	
            $area= DB::table('area')
                ->join('cityadmin','area.cityadmin_id','=','cityadmin.cityadmin_id')
                ->join('city','cityadmin.city_id', '=', 'city.city_id')
                ->where('cityadmin.cityadmin_id',$cityadmin->cityadmin_id)
                ->get();   
          $delivery_boy_vendor = DB::table('delivery_boy_vendor') 
    	           ->join('vendor','delivery_boy_vendor.vendor_id','=', 'vendor.vendor_id' )
    	       
                ->where('delivery_boy_id',$delivery_boy_id)
                ->get(); 
                $vendor= DB::table('vendor')
                 ->where('cityadmin_id',$cityadmin->cityadmin_id)
                ->get();  
                
    	 return view('cityadmin.delivery_boy.Editdelivery_boy',compact("cityadmin_email","cityadmin","delivery_boy_id","delivery_boy", "delivery_boy_area", "area","delivery_boy_vendor","vendor"));
    
      }
     else
      {
        return redirect()->route('cityadminlogin')->withErrors('please login first');
      }


    }
    public function Updatedelivery_boy(Request $request)
   {
     if(Session::has('cityadmin'))
      {
       
        $area_id=$request->area_id;
        $vendor_id=$request->vendor_id;
        $delivery_boy_id=$request->id;
        $delivery_boy_name=$request->delivery_boy_name;
        $delivery_boy_phone=$request->delivery_boy_phone;
        $delivery_boy_comission =$request->delivery_boy_comission;
        $comission = str_replace("%",'', $delivery_boy_comission);
        $password=$request->password1;
        $password2=$request->password2;
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
        
        $count = count($delivery_boy_phone);
        
      
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
                $value=array('delivery_boy_name'=>$delivery_boy_name,'delivery_boy_image'=>$delivery_boy_image, 'delivery_boy_pass'=>$new_pass,'delivery_boy_phone'=>$delivery_boy_phone, 'updated_at'=>$updated_at);
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

                 $delete1 = DB::table('delivery_boy_vendor')
                 ->where('delivery_boy_id', $delivery_boy_id)
                 ->delete();

                 $total_vendor=count($vendor_id);
                 if($total_vendor>0) {
                   for($i=0;$i<=($total_vendor-1);$i++)
                   {
             
                       $insert2 = DB::table('delivery_boy_vendor')
                             ->insert(['delivery_boy_id'=>$delivery_boy_id,'vendor_id'=>$vendor_id[$i]]);
                   }
           
                 }

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
        return redirect()->route('cityadminlogin')->withErrors('please login first');
      }
}    

  public function deletedelivery_boy(Request $request)
    {
     if(Session::has('cityadmin'))
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
        return redirect()->route('cityadminlogin')->withErrors('Please Login First');
      }

    }
    
    public function confirmdeliverystatus(Request $request)
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
	    public function searchdelivery_boy(Request $request)
    {

      $this->validate($request,[
         'deliveryboy' => 'required',
     ]);
      $deliveryboy=$request->deliveryboy;

    	if(Session::has('cityadmin'))
          {
            $cityadmin_email=Session::get('cityadmin');
            $cityadmin=DB::table('cityadmin')
            ->where('cityadmin_email',$cityadmin_email)
            ->first();
                    $id=$cityadmin->cityadmin_id;
               If($deliveryboy!=null && $id!=null){
                  $delivery_boy = $this->getSearch($deliveryboy,$id);


                  return view('cityadmin.delivery_boy.delivery_boy',compact("cityadmin_email","delivery_boy","cityadmin"));

               }else{

                $delivery_boy= DB::table('delivery_boy')
                ->where('cityadmin_id', $cityadmin->cityadmin_id)
                ->get();
              
                return view('cityadmin.delivery_boy.delivery_boy',compact("cityadmin_email","delivery_boy","cityadmin"));
                }
            
          }
        else
             {
                return redirect()->route('cityadminlogin')->withErrors('please login first');
             }


    }
    public function getSearch($deliveryboy,$id)
{
    if($deliveryboy!=null && $id!=null){
        
     $od =  DB::table('delivery_boy')
     ->where('cityadmin_id', $id)
     ->where([['delivery_boy_name','=',$deliveryboy]])->get();
       return $od;
    }
}
    
}
