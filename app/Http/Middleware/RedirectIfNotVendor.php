<?php

namespace App\Http\Middleware;

use Closure;
use View;

class RedirectIfNotVendor
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
            'App\Composers\VendorComposer'  => [
                                                'vendor.*',
                                             ] //attaches HomeComposer to home.blade.php
        ]);
    }
    
    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('vendor')) {
            return redirect()->route('vendorlogin');
        }

        return $next($request);
    }
}
