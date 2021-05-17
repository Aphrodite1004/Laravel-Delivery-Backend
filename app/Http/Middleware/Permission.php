<?php

namespace App\Http\Middleware;

use Closure;
use View;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function __construct()
    {
        View::composers([
            'App\Composers\HomeComposer' =>[
                                                'admin.*',
                                            ]
        ]);
    }

    public function handle($request, Closure $next)
    {
         if(!$request->session()->exists('admin'))
         {
            return redirect()->route('login');
         }
    return $next($request);

    }
}
