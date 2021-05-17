<?php

namespace App\Composers;

use DB;
use Session;

/**
 * 
 */
class HomeComposer
{
	
	public function compose($view)
	{
		if(Session::has('admin')){
			$admin_email = Session::get('admin');

			$adminData = DB::table('admin')
							->where('admin_email', $admin_email)
							->first();

			$view->with('admin_name', $adminData->admin_name)
				 ->with('admin_image', $adminData->admin_image)
				 ->with('admin_email', $adminData->admin_email);
		}
	}
}