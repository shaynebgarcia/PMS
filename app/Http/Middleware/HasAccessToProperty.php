<?php

namespace App\Http\Middleware;

use App\Property;
use App\PropertyAccess;
use Closure;

class HasAccessToProperty
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
        $code = $request->session()->get('property_id');
        // $code = $request->route('property'); // For example, the current URL is: /posts/1/edit
        $property = Property::findorFail($code);
        $check_access = PropertyAccess::where('user_id', auth()->user()->id)->where('property_id', $property->id)->first();

        if ($check_access) {
            return $next($request);
        } else {
            return abort(403);
        }
    }
}
