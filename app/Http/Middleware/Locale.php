<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Locale
{
    /**
     * checks current locale, if user changes it - we put it into session
     * if locale cannot be found in $langs array - default locale is used (security reasons)
     */
    public function handle($request, Closure $next)
    {
		$langs=['ru','en','ua'];

		$res=array_search(session('locale'), $langs);

		if($res !== false){
			App::setLocale(session('locale'));
		} else {
			App::setLocale('en');
		}

        return $next($request);
    }
}
