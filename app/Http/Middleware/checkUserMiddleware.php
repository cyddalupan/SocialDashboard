<?php namespace App\Http\Middleware;

use Closure;
use App\settings;
use Illuminate\Support\Facades\Session;

class checkUserMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (!Session::has('settings')){
			$settings = settings::all();
			foreach ($settings as $key => $value) {
				$setting_session[$value->name] = $value->value;
			}
			Session::put('settings', $setting_session);
		}

		if ( session('user_id') !== null )
			return $next($request);
		else
			return redirect('admin');
	}

}
