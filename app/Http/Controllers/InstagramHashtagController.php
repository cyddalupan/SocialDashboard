<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
use App\instagramFilters;

class InstagramHashtagController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$twitterfilters = instagramFilters::all();
		return view('admin/client_twitter_hashtag')
			->withActivemenu_6('active')
			->withAddlink('admin/instagram-hashtag-create')
			->withDestroylink('admin/instagram-hashtag-destroy')
			->withTwitterfilters($twitterfilters);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin/client_twitter_hashtag_create')
			->withAddlink('admin/instagram-hashtag-store');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$twitterFilter = new instagramFilters;

		$twitterFilter->filter = Request::input('NewTwitterHashtag');

		$twitterFilter->save();

		return redirect('admin/instagram-hashtag');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$twitterFilter = instagramFilters::find($id);
		$twitterFilter->delete();
		return redirect('admin/instagram-hashtag');
	}

}
