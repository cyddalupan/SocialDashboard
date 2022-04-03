<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddUserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$cydpassword = file_get_contents('http://iwebframework.com/cyd/password-generator/return.php');	
		if(session('password') == $cydpassword)
			return true;
		else
			return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
        	'username' => 'required|min:6|unique:users,username',
        	'email' => 'required|email',
        	'password' => 'required|min:6',
        	'profile-picture' => 'required|image|max:160',
		];
	}

}
