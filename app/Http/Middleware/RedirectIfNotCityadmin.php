<?php

namespace App\Http\Middleware;

use Closure;
use View;

class RedirectIfNotCityadmin
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
            'App\Composers\CityadminComposer'  => [
                                                'cityadmin.*',
                                             ] //attaches HomeComposer to home.blade.php
        ]);
    }
    
    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('cityadmin')) {
            return redirect()->route('cityadminlogin');
        }

        return $next($request);
    }
}
