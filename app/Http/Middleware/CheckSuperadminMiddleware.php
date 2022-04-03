<?php namespace App\Http\Middleware;

use Closure;

class CheckSuperadminMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(session('superadmin') == 'true')
			return $next($request);
		else
			return redirect('admin/error')->with('message','You Are not Cyd!');
	}

}
