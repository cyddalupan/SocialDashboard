<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\UpdateRequest;
use App\Http\Controllers\Controller;

use Request;
use App\settings;
use Illuminate\Support\Facades\Session;

class UpdatesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin/updates')
			->withActivemenu_13('active');
	}

	/**
	 * Editing the content of Recommendation
	 *
	 * @return Response
	 */
	public function insert(UpdateRequest $request)
	{
		$setting = settings::where('name','recoText')->update(['value' => Request::input('recommendation')]);
		
		if (Request::hasFile('recoomendationImage')){
			$newPath = Request::file('recoomendationImage')->move('uploads/'.date('Y_m'));
			$setting = settings::where('name','recoImg')->update(['value' => $newPath]);
		}

		$settings = settings::all();
		foreach ($settings as $key => $value) {
			$setting_session[$value->name] = $value->value;
		}
		Session::put('settings', $setting_session);

		return redirect('admin/updates');
	}
}
