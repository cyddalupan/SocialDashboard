<?php

Blade::setContentTags('<%', '%>');  
Blade::setEscapedContentTags('<%%', '%%>'); 

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
	$settings = App\settings::all();
	foreach ($settings as $key => $value) {
		$setting_session[$value->name] = $value->value;
	}
	Session::put('settings', $setting_session);

	$code = App\Code::all();
	foreach ($code as $key => $value) {
		$code_session[$value->name] = $value->value;
	}
	Session::put('code', $code_session);

	if(!isset($_COOKIE[$_ENV['APP_KEY']])) {
		return view('noAuth')->with('contact',session('settings')['AdminEmail']);
	} else {
		$codearray = [];
		$login_codes = App\loginCode::all();
		//insert all codes to array
		foreach ($login_codes as $key => $value) {
			//if the code is not used
			if($value->used == 1)
				array_push($codearray, $value->code);
		}
		//check if value is in the reserved
		if(in_array($_COOKIE[$_ENV['APP_KEY']], $codearray)){
			$competitor2filterCount = App\competitor2filter::count();
			return view('client')->withComp2count($competitor2filterCount); 
		}else{
			return view('noAuth')->with('contact',session('settings')['AdminEmail']);
		}
	}
});

Route::any('auth/{login_code}', 'authController@index');

Route::get('twitter', function () { return view('twitter'); });

Route::get('comp1Twitter', function () { return view('comp1Twitter'); });

Route::get('comp2Twitter', function () { return view('comp2Twitter'); });

Route::get('facebook', function () { 
	return view('facebook'); 
});

Route::get('comp1Facebook', function () { 
	return view('comp1Facebook'); 
});

Route::get('comp2Facebook', function () { 
	return view('comp2Facebook'); 
});

Route::get('youtube', function () { return view('youtube'); });

Route::get('trending', function () { return view('trending'); });

Route::any('get_trends', function () {
	$expiresAt = Carbon::now()->addMinutes(7);
	$localTrends = Cache::remember('localTrends', $expiresAt, function()
	{
		include('TwitterAPIExchange.php');
		/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
		$settings = array(
		   'oauth_access_token' => "64071328-bneUfTdLTqJ8nLMPNC4Pyx6yHgJmYJhvq6FM3uOU9",
		   'oauth_access_token_secret' => "vhLKcOIUNjkkbLwIYXbhdkJPHg00uzJ4q4x8v0ASRlnew",
		   'consumer_key' => "R7R1NeNLhssyQXqGw2KL43laV",
		   'consumer_secret' => "w4emmZ9KM8OfPtki98vw8xctwFAYsCfo8Y4KR2w16AyQPSUDVy"
		);

		//default json url
		$url1 = 'https://api.twitter.com/1.1/trends/place.json';
		$requestMethod1 = 'GET';

		//the query of info needed
		$getfield1 = '?id=23424934'; 
		$twitter1 = new TwitterAPIExchange($settings);
		$response = json_decode($twitter1->setGetfield($getfield1)
			   ->buildOauth($url1, $requestMethod1)
		->performRequest(),$assoc = TRUE);

		return json_encode($response);
	});

	return $localTrends;
});

Route::any('get_global_trends', function () {
	$expiresAt = Carbon::now()->addMinutes(10);
	$trending = Cache::remember('trending', $expiresAt, function()
	{
		include('TwitterAPIExchange.php');
		/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
		$settings = array(
		   'oauth_access_token' => "64071328-bneUfTdLTqJ8nLMPNC4Pyx6yHgJmYJhvq6FM3uOU9",
		   'oauth_access_token_secret' => "vhLKcOIUNjkkbLwIYXbhdkJPHg00uzJ4q4x8v0ASRlnew",
		   'consumer_key' => "R7R1NeNLhssyQXqGw2KL43laV",
		   'consumer_secret' => "w4emmZ9KM8OfPtki98vw8xctwFAYsCfo8Y4KR2w16AyQPSUDVy"
		);

		//default json url
		$url1 = 'https://api.twitter.com/1.1/trends/place.json';
		$requestMethod1 = 'GET';

		//the query of info needed
		$getfield1 = '?id=1'; 
		$twitter1 = new TwitterAPIExchange($settings);
		$response = json_decode($twitter1->setGetfield($getfield1)
			   ->buildOauth($url1, $requestMethod1)
		->performRequest(),$assoc = TRUE);

		return json_encode($response);
	});

	return $trending;
});

Route::get('peopleSay', function () { return view('peopleSay'); });

Route::get('clientTwitter', function () { return view('clientTwitter'); });
Route::any('get_brand_twitter', function () {
	$expiresAt = Carbon::now()->addMinutes(14);
	$brand_twitter = Cache::remember('brand_twitter', $expiresAt, function()
	{
		include('TwitterAPIExchange.php');
		/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
		$settings = array(
		   'oauth_access_token' => "64071328-bneUfTdLTqJ8nLMPNC4Pyx6yHgJmYJhvq6FM3uOU9",
		   'oauth_access_token_secret' => "vhLKcOIUNjkkbLwIYXbhdkJPHg00uzJ4q4x8v0ASRlnew",
		   'consumer_key' => "R7R1NeNLhssyQXqGw2KL43laV",
		   'consumer_secret' => "w4emmZ9KM8OfPtki98vw8xctwFAYsCfo8Y4KR2w16AyQPSUDVy"
		);

		//default json url
		$url1 = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		$requestMethod1 = 'GET';

		//the query of info needed
		//add user id
		//get user id here http://gettwitterid.com/
		$getfield1 = '?user_id=377443782'; 
		$twitter1 = new TwitterAPIExchange($settings);
		$response = json_decode($twitter1->setGetfield($getfield1)
			   ->buildOauth($url1, $requestMethod1)
		->performRequest(),$assoc = TRUE);

		return json_encode($response);
	});
	return $brand_twitter;
});

Route::get('client1Twitter', function () { return view('client1Twitter'); });
Route::any('get_brand1_twitter', function () {
	$expiresAt = Carbon::now()->addMinutes(50);
	$brand_1_twitter = Cache::remember('brand_1_twitter', $expiresAt, function()
	{
		include('TwitterAPIExchange.php');
		/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
		$settings = array(
		   'oauth_access_token' => "64071328-bneUfTdLTqJ8nLMPNC4Pyx6yHgJmYJhvq6FM3uOU9",
		   'oauth_access_token_secret' => "vhLKcOIUNjkkbLwIYXbhdkJPHg00uzJ4q4x8v0ASRlnew",
		   'consumer_key' => "R7R1NeNLhssyQXqGw2KL43laV",
		   'consumer_secret' => "w4emmZ9KM8OfPtki98vw8xctwFAYsCfo8Y4KR2w16AyQPSUDVy"
		);

		//default json url
		$url1 = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		$requestMethod1 = 'GET';

		//the query of info needed
		//add user id
		//get user id here http://gettwitterid.com/
		$getfield1 = '?user_id=72457332'; 
		$twitter1 = new TwitterAPIExchange($settings);
		$response = json_decode($twitter1->setGetfield($getfield1)
			   ->buildOauth($url1, $requestMethod1)
		->performRequest(),$assoc = TRUE);

		return json_encode($response);
	});
	return $brand_1_twitter;
});

Route::get('clien2Twitter', function () { return view('client2Twitter'); });
Route::any('get_brand2_twitter', function () {

	$expiresAt = Carbon::now()->addMinutes(55);
	$brand_2_twitter = Cache::remember('brand_2_twitter', $expiresAt, function()
	{
		include('TwitterAPIExchange.php');
		/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
		$settings = array(
		   'oauth_access_token' => "64071328-bneUfTdLTqJ8nLMPNC4Pyx6yHgJmYJhvq6FM3uOU9",
		   'oauth_access_token_secret' => "vhLKcOIUNjkkbLwIYXbhdkJPHg00uzJ4q4x8v0ASRlnew",
		   'consumer_key' => "R7R1NeNLhssyQXqGw2KL43laV",
		   'consumer_secret' => "w4emmZ9KM8OfPtki98vw8xctwFAYsCfo8Y4KR2w16AyQPSUDVy"
		);

		//default json url
		$url1 = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		$requestMethod1 = 'GET';

		//the query of info needed
		//add user id
		//get user id here http://gettwitterid.com/
		$getfield1 = '?user_id=74670001'; 
		$twitter1 = new TwitterAPIExchange($settings);
		$response = json_decode($twitter1->setGetfield($getfield1)
			   ->buildOauth($url1, $requestMethod1)
		->performRequest(),$assoc = TRUE);

		return json_encode($response);
	});
	return $brand_2_twitter;
});

Route::any('get_mentions/{inkey}', function ($inkey) {

	$expiresAt = Carbon::now()->addMinutes(4);
	$mentions[$inkey] = Cache::remember('mentions'.$inkey, $expiresAt, function()use($inkey)
	{
		include('TwitterAPIExchange.php');
		/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
		$settings = array(
		   'oauth_access_token' => "64071328-bneUfTdLTqJ8nLMPNC4Pyx6yHgJmYJhvq6FM3uOU9",
		   'oauth_access_token_secret' => "vhLKcOIUNjkkbLwIYXbhdkJPHg00uzJ4q4x8v0ASRlnew",
		   'consumer_key' => "R7R1NeNLhssyQXqGw2KL43laV",
		   'consumer_secret' => "w4emmZ9KM8OfPtki98vw8xctwFAYsCfo8Y4KR2w16AyQPSUDVy"
		);

		//default json url
		$url1 = 'https://api.twitter.com/1.1/search/tweets.json';
		$requestMethod1 = 'GET';

		//the query of info needed
		$getfield1 = '?q='.$inkey; 
		$twitter1 = new TwitterAPIExchange($settings);
		$response = json_decode($twitter1->setGetfield($getfield1)
			   ->buildOauth($url1, $requestMethod1)
		->performRequest(),$assoc = TRUE);

		$response['keyword'] = $inkey;

		return json_encode($response);
	});
	return $mentions[$inkey];
});

Route::get('recommendation', function () { return view('recommendation'); });

Route::get('get_recommendation', function () {
	$recommendation = App\recommendation::all();
	echo $recommendation; 
});

Route::get('login', function () { return view('login'); });

Route::any('login_send', 'LoginController@login');

Route::get('cms', function () { return view('cms'); });

Route::get('addRecommendation', function () { return view('addRecommendation'); });

Route::post('submit_reco', 'cmsController@add_reco');

Route::get('get_rand_reco', function () {
	$recommendation = App\recommendation::orderBy(\DB::raw('RAND()'))->take(1)->get();
	echo $recommendation; 
});

Route::get('comp1Mentions', function () { return view('comp1Mentions'); });
Route::get('comp2Mentions', function () { return view('comp2Mentions'); });

Route::any('comp1_get_mentions/{inkey}', function ($inkey) {
	$expiresAt = Carbon::now()->addMinutes(15);
	$comp_1_mentions[$inkey] = Cache::remember('comp_1_mentions'.$inkey, $expiresAt, function()use($inkey)
	{
		include('TwitterAPIExchange.php');
		/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
		$settings = array(
		   'oauth_access_token' => "64071328-bneUfTdLTqJ8nLMPNC4Pyx6yHgJmYJhvq6FM3uOU9",
		   'oauth_access_token_secret' => "vhLKcOIUNjkkbLwIYXbhdkJPHg00uzJ4q4x8v0ASRlnew",
		   'consumer_key' => "R7R1NeNLhssyQXqGw2KL43laV",
		   'consumer_secret' => "w4emmZ9KM8OfPtki98vw8xctwFAYsCfo8Y4KR2w16AyQPSUDVy"
		);

		//default json url
		$url1 = 'https://api.twitter.com/1.1/search/tweets.json';
		$requestMethod1 = 'GET';

		//the query of info needed
		$getfield1 = '?q='.$inkey; 
		$twitter1 = new TwitterAPIExchange($settings);
		$response = json_decode($twitter1->setGetfield($getfield1)
			   ->buildOauth($url1, $requestMethod1)
		->performRequest(),$assoc = TRUE);

		$response['keyword'] = $inkey;

		return json_encode($response);
	});

	return $comp_1_mentions[$inkey];

});

Route::any('comp2_get_mentions/{inkey}', function ($inkey) {

	$expiresAt = Carbon::now()->addMinutes(16);
	$comp_2_mentions[$inkey] = Cache::remember('comp_2_mentions'.$inkey, $expiresAt, function()use($inkey)
	{
		include('TwitterAPIExchange.php');
		/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
		$settings = array(
		   'oauth_access_token' => "64071328-bneUfTdLTqJ8nLMPNC4Pyx6yHgJmYJhvq6FM3uOU9",
		   'oauth_access_token_secret' => "vhLKcOIUNjkkbLwIYXbhdkJPHg00uzJ4q4x8v0ASRlnew",
		   'consumer_key' => "R7R1NeNLhssyQXqGw2KL43laV",
		   'consumer_secret' => "w4emmZ9KM8OfPtki98vw8xctwFAYsCfo8Y4KR2w16AyQPSUDVy"
		);

		//default json url
		$url1 = 'https://api.twitter.com/1.1/search/tweets.json';
		$requestMethod1 = 'GET';

		//the query of info needed
		$getfield1 = '?q='.$inkey; 
		$twitter1 = new TwitterAPIExchange($settings);
		$response = json_decode($twitter1->setGetfield($getfield1)
			   ->buildOauth($url1, $requestMethod1)
		->performRequest(),$assoc = TRUE);

		$response['keyword'] = $inkey;

		return json_encode($response);
	});

	return $comp_2_mentions[$inkey];
});

Route::get('twitterKeyword', function () { return view('twitterKeyword'); });
Route::get('editTwitterKeyword', function () { return view('editTwitterKeyword'); });


Route::post('update_keyword', 'settingsController@change_keyword');
Route::post('update_instagram_keyword', 'settingsController@update_instagram_keyword');

Route::get('instaHash', function () { return view('instaHash'); });

Route::get('get_insta_filter/{keyword}', function ($keyword) {

	$expiresAt = Carbon::now()->addMinutes(30);
	$insta_filter[$keyword] = Cache::remember('insta_filter'.$keyword, $expiresAt, function()use($keyword)
	{
		$json = file_get_contents('https://api.instagram.com/v1/tags/'.$keyword.'/media/recent?client_id=598774a2df7247d78b31381b7965ef4a');
		$jsondecode = json_decode($json);
		$jsondecode->hashtag = $keyword;

		return json_encode($jsondecode);
	});

	return $insta_filter[$keyword];
});

Route::get('instaClient', function () { return view('instaClient'); });
Route::get('get_brand_insta', function () {
	$expiresAt = Carbon::now()->addMinutes(31);
	$brand_insta = Cache::remember('brand_insta', $expiresAt, function()
	{
		$json = file_get_contents('https://api.instagram.com/v1/users/'.session('code')['ClientInstagram'].'/media/recent/?client_id=598774a2df7247d78b31381b7965ef4a');
		return $json;
	});
	// echo '<pre>';
	// echo print_r(json_decode($brand_insta));
	// echo '</pre>';
	return $brand_insta;
});

Route::get('changeinstakeyword', function () { return view('changeinstakeyword'); });


Route::get('changeinstakeyword', function () { return view('changeinstakeyword'); });

Route::get('shareOfVoice', function () { return view('shareOfVoice'); });

Route::get('change_to_stats', function () {
	$stat_image_link = App\settings::find(3);
	echo $stat_image_link->value;
});
Route::get('change_to_bar', function () {
	
	$stat_image_link = App\settings::find(4);
	echo $stat_image_link->value;
});

Route::get('competitorSetOne', function () { return view('competitorSetOne'); });
Route::get('competitorSetTwo', function () { return view('competitorSetTwo'); });

Route::get('get_twitter_dropdown_list', function () {
	$twitterFilters = App\twitterFilters::all();
	echo json_encode($twitterFilters);
});
Route::get('get_comp1_dropdown_list', function () {
	$comp1Filters = App\competitor1filter::all();
	echo json_encode($comp1Filters);
});
Route::get('get_comp2_dropdown_list', function () {
	$comp2Filters = App\competitor2filter::all();
	echo json_encode($comp2Filters);
});


Route::get('get_instagram_dropdown_list', function () {
	$instagramFilters = App\instagramFilters::all();
	echo json_encode($instagramFilters);
});

Route::get('recomail', function () { return view('recomail'); });


Route::get('get_latest_reco', function () {
	$getLatestReco = App\recommendation::orderBy('id', 'desc')->first();
	echo json_encode(array_merge(json_decode($getLatestReco, true),json_decode($getLatestReco->recouser, true)));
});


Route::any('json_reco', function () {
	$jsonFromFile = file_get_contents(url().'/settings/recommendation.json');
	$jsonFromFile = preg_replace("/\s+/", " ", $jsonFromFile);
	echo $jsonFromFile;
});

Route::any('json_client_tw', function () {
	$client_tw = App\twitterFilters::all();
	echo $client_tw->toJson();
});

Route::any('json_client_ig', function () {
	$client_ig = App\instagramFilters::all();
	echo $client_ig->toJson();
});

Route::any('json_competitor1_tw', function () {
	$competitor_tw = App\competitor1filter::all();
	echo $competitor_tw->toJson();
});
Route::any('json_competitor2_tw', function () {
	$competitor_tw = App\competitor2filter::all();
	echo $competitor_tw->toJson();
});

//CMS
Route::any('admin/', 'AdminController@index');
Route::any('admin/check-login', 'AdminController@check_login');
Route::any('admin/logout', 'AdminController@logout');
Route::any('admin/error', 'AdminController@error');
Route::any('admin/superadmin', ['middleware' => 'checkAdmin' ,'uses' => 'AdminController@superadmin']);
Route::any('admin/add-user', ['middleware' => 'checkAdmin' ,'uses' => 'AdminController@add_user']);

Route::any('admin/home', ['middleware' => 'checkUser' ,'uses' => 'UserController@home']);

Route::any('admin/client-twitter-account', ['middleware' => 'checkUser' ,'uses' => 'ClientTwitterAccountController@index']);

Route::get('admin/client-twitter-hashtag', ['middleware' => 'checkUser' ,'uses' => 'ClientTwitterHashtagController@index']);
Route::get('admin/client-twitter-hashtag-create', ['middleware' => 'checkUser' ,'uses' => 'ClientTwitterHashtagController@create']);
Route::post('admin/client-twitter-hashtag-store', ['middleware' => 'checkUser' ,'uses' => 'ClientTwitterHashtagController@store']);
Route::get('admin/client-twitter-hashtag-destroy/{id}', ['middleware' => 'checkUser' ,'uses' => 'ClientTwitterHashtagController@destroy']);

Route::get('admin/competitor-1-twitter-hashtag', ['middleware' => 'checkUser' ,'uses' => 'Competitor1TwitterHashtagController@index']);
Route::get('admin/competitor-1-twitter-hashtag-create', ['middleware' => 'checkUser' ,'uses' => 'Competitor1TwitterHashtagController@create']);
Route::post('admin/competitor-1-twitter-hashtag-store', ['middleware' => 'checkUser' ,'uses' => 'Competitor1TwitterHashtagController@store']);
Route::get('admin/competitor-1-twitter-hashtag-destroy/{id}', ['middleware' => 'checkUser' ,'uses' => 'Competitor1TwitterHashtagController@destroy']);

Route::get('admin/competitor-2-twitter-hashtag', ['middleware' => 'checkUser' ,'uses' => 'Competitor2TwitterHashtagController@index']);
Route::get('admin/competitor-2-twitter-hashtag-create', ['middleware' => 'checkUser' ,'uses' => 'Competitor2TwitterHashtagController@create']);
Route::post('admin/competitor-2-twitter-hashtag-store', ['middleware' => 'checkUser' ,'uses' => 'Competitor2TwitterHashtagController@store']);
Route::get('admin/competitor-2-twitter-hashtag-destroy/{id}', ['middleware' => 'checkUser' ,'uses' => 'Competitor2TwitterHashtagController@destroy']);

Route::get('admin/instagram-hashtag', ['middleware' => 'checkUser' ,'uses' => 'InstagramHashtagController@index']);
Route::get('admin/instagram-hashtag-create', ['middleware' => 'checkUser' ,'uses' => 'InstagramHashtagController@create']);
Route::post('admin/instagram-hashtag-store', ['middleware' => 'checkUser' ,'uses' => 'InstagramHashtagController@store']);
Route::get('admin/instagram-hashtag-destroy/{id}', ['middleware' => 'checkUser' ,'uses' => 'InstagramHashtagController@destroy']);

Route::get('admin/share-of-voice', ['middleware' => 'checkUser' ,'uses' => 'ShareOfVoiceController@index']);
Route::post('admin/share-of-voice-upload-pie', ['middleware' => 'checkUser' ,'uses' => 'ShareOfVoiceController@upload_pie']);
Route::post('admin/share-of-voice-upload-chart', ['middleware' => 'checkUser' ,'uses' => 'ShareOfVoiceController@upload_chart']);

Route::get('admin/updates', ['middleware' => 'checkUser' ,'uses' => 'UpdatesController@index']);
Route::post('admin/updates-insert', ['middleware' => 'checkUser' ,'uses' => 'UpdatesController@insert']);
