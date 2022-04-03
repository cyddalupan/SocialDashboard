<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
use App\competitor2filter;

class Competitor2TwitterHashtagController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$twitterfilters = competitor2filter::all();
		return view('admin/client_twitter_hashtag')
			->withActivemenu_11('active')
			->withAddlink('admin/competitor-2-twitter-hashtag-create')
			->withDestroylink('admin/competitor-2-twitter-hashtag-destroy')
			->withTwitterfilters($twitterfilters)
			->withNote('If there is no Hashtag, Second competitor will be Disabled');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin/client_twitter_hashtag_create')
			->withAddlink('admin/competitor-2-twitter-hashtag-store');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$twitterFilter = new competitor2filter;

		$twitterFilter->filter = Request::input('NewTwitterHashtag');

		$twitterFilter->save();

		return redirect('admin/competitor-2-twitter-hashtag');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$twitterFilter = competitor2filter::find($id);
		$twitterFilter->delete();
		return redirect('admin/competitor-2-twitter-hashtag');
	}

}
