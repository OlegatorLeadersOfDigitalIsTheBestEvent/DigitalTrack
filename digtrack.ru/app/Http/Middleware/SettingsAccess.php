<?php

namespace App\Http\Middleware;

use Closure;
use App\Settings;
use Auth;
class SettingsAccess
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
        
        $settings = Settings::find(1);
        
        if(!$settings->game_is_in_the_process){
            return abort(404);
        }
    
    
     
       
        return $next($request);
    }
}
