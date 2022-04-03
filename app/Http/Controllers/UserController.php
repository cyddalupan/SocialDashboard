<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\loginCode;

class UserController extends Controller {

	/**
	 * Home page of User
	 *
	 * @return Response
	 */
	public function home()
	{
		$login_codes = loginCode::where('used',0)->get();
		
		return view('admin/home')
			->withActivemenu_1('active')
			->withLogincodes($login_codes);
	}

}
