<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Helpers\Content;

class Authentication
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

        if(!Session::has('identity'))
        {
            return redirect()->route('login');
        }

        if(!Content::verify_route($request->path()))
        {
            return \abort(404);
        }

        return $next($request);
    }
}
