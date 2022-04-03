<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
use App\loginCode;
use Illuminate\Http\Response;

use Cookie;

class authController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($login_code)
	{

		$codearray = [];
		$login_codes = loginCode::all();
		//insert all codes to array
		foreach ($login_codes as $key => $value) {
			//if the code is not used
			if($value->used == 0)
				array_push($codearray, $value->code);
		}

		//if code is on db
		if(in_array($login_code, $codearray)){
			$updCode = loginCode::where('code',$login_code)->update(['used' => 1]);
			setcookie($_ENV['APP_KEY'], $login_code,  time() + (5 * 365 * 24 * 60 * 60), "/"); // 5 * 365 * 24 * 60 * 60 = 5 years
			return redirect('/');
		}else{
			$message  = '&nbsp URL Incorrect or Code already used! ';
			$message .= ' If This Device is Already Registered. <br/>';
			$message .= '&nbsp &nbsp &nbsp Proceed to <a href="'.url().'">home page</a>';
	    	return view('error')->with('message',$message);
		}
	}
}
