<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ServiceController;
use App\Models\Articles;
use Illuminate\Support\Facades\Auth;
use Closure;

class Subscriber
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
		$slug=$request->route('slug');
        $article=Articles::where('slug', '=', $slug)->first();

		var_dump('<pre>', $slug, '</pre>');
		exit;
		// if article doesn't exists - exception
		if (!$article)
			abort(404,'Article not found.');


        if(intval($article->premium_content)===1)
        {
            if (!$user = Auth::user())
            {
                return redirect("/login");
            }
            else
            {
                if($user->hasRole('subscriber'))
                {
                    return $next($request);
                }
                else
                    return redirect("/article-permissions/$slug");
            }
        }

        return $next($request);
    }
}
