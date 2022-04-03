<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ShareOfVoiceRequest;
use App\Http\Controllers\Controller;

use Request;
use App\settings;
use Illuminate\Support\Facades\Session;

class ShareOfVoiceController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin/share_of_voice')
			->withActivemenu_14('active');
	}

	/**
	 * Upload new pie image
	 *
	 * @return Response
	 */
	public function upload_pie(ShareOfVoiceRequest $request)
	{
		$newPath = Request::file('image')->move('uploads/'.date('Y_m'));

		$setting = settings::where('name','link2Pie')->update(['value' => $newPath]);

		$settings = settings::all();
		foreach ($settings as $key => $value) {
			$setting_session[$value->name] = $value->value;
		}
		Session::put('settings', $setting_session);

		return redirect('admin/share-of-voice');
	}

	/**
	 * Upload new Line Chart image
	 *
	 * @return Response
	 */
	public function upload_chart(ShareOfVoiceRequest $request)
	{
		$newPath = Request::file('image')->move('uploads/'.date('Y_m'));

		$setting = settings::where('name','link2Chart')->update(['value' => $newPath]);

		$settings = settings::all();
		foreach ($settings as $key => $value) {
			$setting_session[$value->name] = $value->value;
		}
		Session::put('settings', $setting_session);
		
		return redirect('admin/share-of-voice');
	}

}
