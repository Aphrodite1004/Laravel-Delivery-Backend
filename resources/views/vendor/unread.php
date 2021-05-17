<?php
   $vendor_email=Session::get('vendor');
    
   $vendor=DB::table('vendor')
         ->where('vendor_email',$vendor_email)
         ->first();	
 $note = DB::table('vendor_notification')->where('vendor_id',$vendor->vendor_id)->where('read_by_vendor',0)
 ->count();

 echo $note;

?>