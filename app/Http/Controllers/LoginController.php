<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\users;

class LoginController extends Controller {

    public function login(Request $request){
        $user = users::where(
        	'username', 
        	$request->input('username')
        )->first();

        if (is_null($user)) {
		    echo 'Incorrect Username';
		} else {
		    if($user->password == md5($request->input('password'))) {
		    	echo 'loged';
		    }else{
		    	echo 'Incorrect Password';
		    }
		}

    }
}
