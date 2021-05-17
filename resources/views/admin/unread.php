<?php
   $admin_email=Session::get('admin');
    
   $admin=DB::table('admin')
         ->where('admin_email',$admin_email)
         ->first();	
 $note = DB::table('payout_notification')->where('read_by_admin',0)
 ->count();

 echo $note;

?>