<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
use App\twitterFilters;

class ClientTwitterHashtagController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$twiiterfilters = twitterFilters::all();
		return view('admin/client_twitter_hashtag')
			->withActivemenu_3('active')
			->withAddlink('admin/client-twitter-hashtag-create')
			->withDestroylink('admin/client-twitter-hashtag-destroy')
			->withTwitterfilters($twiiterfilters);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin/client_twitter_hashtag_create')
			->withAddlink('admin/client-twitter-hashtag-store');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$twitterFilter = new twitterFilters;

		$twitterFilter->filter = Request::input('NewTwitterHashtag');

		$twitterFilter->save();

		return redirect('admin/client-twitter-hashtag');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$twitterFilter = twitterFilters::find($id);
		$twitterFilter->delete();
		return redirect('admin/client-twitter-hashtag');
	}

}
