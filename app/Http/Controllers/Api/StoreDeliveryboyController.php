<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth; 


class StoreDeliveryboyController extends Controller
{
    public function store_deliveryboy(Request $request)
    {
        $vendor_id = $request->vendor_id;
        $delivery_boy= DB::table('delivery_boy')
        ->where('vendor_id', $vendor_id)
        ->get();
       if($delivery_boy)	{                     
        $message = array('status'=>'1', 'message'=>'data found', 'data'=>$delivery_boy);
        return $message;
     }
    else
     {
        $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[] );
        return $message;
     }		

    }
    public function store_adddeliveryboy(Request $request)
    {
      $area= DB::table('area')->get();
       if($area)	{                     
        $message = array('status'=>'1', 'message'=>'data found', 'data'=>$area);
        return $message;
     }
    else
     {
        $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[] );
        return $message;
     }		

    }
    public function store_addnewdeliveryboy(Request $request)
    {

      $area_id=$request->area_id;
      $vendor_id=$request->vendor_id;
      $delivery_boy_name=$request->delivery_boy_name;
      $delivery_boy_phone=$request->delivery_boy_phone;
      $password=$request->password1;
      $password2=$request->password2;
      // $old_delivery_boy_image=$request->old_delivery_boy_image;
      $date = date('d-m-Y');
      $created_at=date('d-m-Y h:i a');
      $delivery_boy_image = $request->delivery_boy_image;
      $fileName = date('dmyhisa').'-'.$delivery_boy_image->getClientOriginalName();
      $fileName = str_replace(" ", "-", $fileName);
      $delivery_boy_image->move('delivery_boy_img/images/'.$date.'/', $fileName);
      $delivery_boy_image = 'delivery_boy_img/images/'.$date.'/'.$fileName;
    
   
      if($password!=$password2){
           return redirect()->back()->withErrors('password are not same');
      }

     else{
          $new_pass=Hash::make($password);
          $insert = DB::table('delivery_boy')
            ->insertGetId(['vendor_id'=>$vendor_id,'delivery_boy_name'=>$delivery_boy_name,'delivery_boy_image'=>$delivery_boy_image,'delivery_boy_phone'=> $delivery_boy_phone, 'delivery_boy_pass'=>$new_pass, 'created_at'=>$created_at]);
          $total_area=count($area_id);
  for($i=0;$i<=($total_area-1);$i++)
      {
          $insert2 = DB::table('delivery_boy_area')
                ->insert(['delivery_boy_id'=>$insert, 'area_id'=>$area_id[$i]]);
      }

      if($insert2)	{                     
        $message = array('status'=>'1', 'message'=>'data found', 'data'=>$insert2);
        return $message;
     }
    else
     {
        $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[] );
        return $message;
     }		

    }
   }
   public function store_editdeliveryboy(Request $request)
   {

      $delivery_boy_id=$request->deliveryboy_id;
        
      $delivery_boy= DB::table('delivery_boy')
              ->where('delivery_boy_id',$delivery_boy_id)
              ->first();
      $delivery_boy_area = DB::table('delivery_boy_area') //
             ->join('area','delivery_boy_area.area_id','=', 'area.area_id' )
              ->where('delivery_boy_id',$delivery_boy_id)
              ->get();   	
          $area= DB::table('area')
              ->get();

      if($delivery_boy)	{                     
       $message = array('status'=>'1', 'message'=>'data found', 'data'=>$delivery_boy, 'delivery_boy_area'=>$delivery_boy_area ,'area'=>$area);
       return $message;
    }
   else
    {
       $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[] );
       return $message;
    }		

   }
   public function store_updatedeliveryboy(Request $request)
   {

      $area_id=$request->area_id;
      $delivery_boy_id=$request->delivery_boy_id;
      $delivery_boy_name=$request->delivery_boy_name;
      $delivery_boy_phone=$request->delivery_boy_phone;
      $password=$request->password1;
      $password2=$request->password2;
      $date = date('d-m-Y');
      $updated_at = date("d-m-y h:i a");
      $date=date('d-m-y');
      

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
          $delivery_boy_image = $image;
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
          $value=array('delivery_boy_name'=>$delivery_boy_name,'delivery_boy_image'=>$delivery_boy_image, 'delivery_boy_phone'=>$delivery_boy_phone,'updated_at'=>$updated_at);
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
       $message = array('status'=>'1', 'message'=>'data found', 'data'=>$update);
       return $message;
    }
   else
    {
       $message = array('status'=>'0', 'message'=>'data not found', 'data'=>[] );
       return $message;
    }		
   }
   }
   public function store_deletedeliveryboy(Request $request)
   {
       $deliveryboy_id=$request->deliveryboy_id;

       $delete=DB::table('delivery_boy')->where('delivery_boy_id',$deliveryboy_id)->delete();
               DB::table('delivery_boy_area')->where('delivery_boy_id', $deliveryboy_id)->delete();
       if($delete)
       {
          $delete = array('status'=>'1', 'message'=>'Deleted Successfully');

          return $delete;     
          }
       else
       {
          $delete = array('status'=>'0', 'message'=>'Unsuccessfull Delete');
          return $delete;         
      }
   }
   public function store_confirmdeliveryboy(Request $request)
   {
      $status = $request->status;
      $delivery_boy_id = $request->delivery_boy_id;
      
      $confirmdeliverystatus = DB::table('delivery_boy')->where('delivery_boy_id', $delivery_boy_id)->update(['is_confirmed'=>$status]);
      
      if($confirmdeliverystatus){
          $confirmdeliverystatus = array('status'=>'1', 'message'=>'update Successfully');

          return $confirmdeliverystatus;     
          }
       else
       {
          $confirmdeliverystatus = array('status'=>'0', 'message'=>'Unsuccessfull update');
          return $confirmdeliverystatus;         
      }
   }
}