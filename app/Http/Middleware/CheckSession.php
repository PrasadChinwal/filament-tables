<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use URL;
use Session;


class CheckSession
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(!empty($request->session()))
		{
			if((is_null($request->server('Shib-Session-ID'))) && (Cookie::get(\Illuminate\Support\Str::slug(env("APP_NAME")).'_session' ) == null))
			{
				$request->session()->flush();
				return redirect()->route('shibboleth-authenticate');
			}
		}
		return $next($request);
	}
}
