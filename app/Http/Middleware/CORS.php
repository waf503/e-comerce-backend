<?php
namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;
use Closure;
use Illuminate\Support\Facades\Response;

class CORS extends Middleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {            
        

       

        return $next($request)
                ->header("Access-Control-Allow-Origin","*")
                ->header("Access-Control-Allow-Methods","*")
                ->header("Access-Control-Allow-Headers","Content-Type, Authorization");

        
    }

}