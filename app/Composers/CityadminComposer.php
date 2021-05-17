<?php

namespace App\Composers;

use DB;
use Session;

/**
 * 
 */
class CityadminComposer
{
	
	public function compose($view)
	{
		if(Session::has('cityadmin')){
			$email = Session::get('cityadmin');

			$adminData = DB::table('cityadmin')
							->where('cityadmin_email', $email)
							->first();

			$view->with('cityadmin_name', $adminData->cityadmin_name)
				 ->with('cityadmin_image', $adminData->cityadmin_image)
				 ->with('cityadmin_email', $adminData->cityadmin_email);
		}
	}
}