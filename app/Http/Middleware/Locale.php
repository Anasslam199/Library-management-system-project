<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Session;
use Config;
class Locale
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
        // echo "<script>alert('hello'); </script>";
        $locale=Session::get('locale',Config::get('app.locale'));
        App::setlocale($locale);
        // dd(App::setlocale($locale));
        return $next($request);
      }
}
