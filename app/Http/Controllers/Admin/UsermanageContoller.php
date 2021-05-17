<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;

class UsermanageContoller extends Controller
{
    public function allusers(Request $request)
    {
        $admin_email=Session::get('admin');
        $admin=DB::table('admin')
        ->where('admin_email',$admin_email)
        ->first();
        $alluser= DB::table('tbl_user')
        ->get();
        return view('admin.usemanage.alluser',compact("admin_email","alluser","admin"));
    }
    

    public function edituser(Request $request)
    {
      
       $user_id=$request->id;
    	 $admin_email=Session::get('admin');
    	 $city=DB::table('city')
                ->get();
         $admin=DB::table('admin')
                ->where('admin_email',$admin_email)
                ->first();       
    	 $user= DB::table('tbl_user')
                ->where('user_id',$user_id)
                ->first(); 
    	 return view('admin.usemanage.Edituser',compact("admin_email","admin","city","user"));


    }
    public function Updateuser(Request $request)
{
       
        $user_id=$request->id;
        $user_name=$request->user_name;
        $user_email=$request->user_email;
        $user_phone=$request->user_phone;
        $user_password=$request->user_password;
        $old_user_image=$request->old_user_image;
        
        $date = date('d-m-Y');
        $updated_at = date("d-m-y h:i a");
        $date=date('d-m-y');
        

        $getImage = DB::table('tbl_user')
                 ->where('user_id', $user_id)
                    ->first();

        $image = $getImage->user_image;  
      
       
        if($request->hasFile('user_image')){
             if(file_exists($image)){
                unlink($image);
            }
            $user_image = $request->user_image;
            $fileName = date('dmyhisa').'-'.$user_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $user_image->move('images/user/'.$date.'/', $fileName);
            $user_image = 'images/user/'.$date.'/'.$fileName;
        }
        else{
            $user_image = $old_user_image;
        }
        
        
        
            $value=array('user_name'=>$user_name,'user_image'=>$user_image,'user_email'=> $user_email, 'user_phone'=> $user_phone,'user_password'=>0,'updated_at'=>$updated_at);
        

        $update = DB::table('tbl_user')
                 ->where('user_id', $user_id)
                 ->update($value);

        if($update){

             

            return redirect()->back()->withErrors(' updated successfully');
        }
        else{
            return redirect()->back()->withErrors("something wents wrong.");
        }
    
}    

  public function deletecityadmin(Request $request)
    {
       
        $cityadmin_id=$request->id;

        $getfile=DB::table('cityadmin')
                ->where('cityadmin_id',$cityadmin_id)
                ->first();

        $cityadmin_image=$getfile->cityadmin_image;

    	$delete=DB::table('cityadmin')->where('cityadmin_id',$request->id)->delete();
        if($delete)
        {
        
            if(file_exists($cityadmin_image)){
                unlink($cityadmin_image);
            }
         
        return redirect()->back()->withErrors('delete successfully');

        }
        else
        {
           return redirect()->back()->withErrors('unsuccessfull delete'); 
        }

    }
	
    
}
