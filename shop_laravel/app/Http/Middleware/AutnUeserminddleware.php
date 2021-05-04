<?php

namespace App\Http\Middleware;

use Closure;
use App\Shop\Entity\User;

class AutnUeserminddleware
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
        $is_allow_access = false;

        $user_id = session()->get('user_id');

        if(!is_null($user_id)){
            $User = User::findOrFail($user_id);

            $is_allow_access=true;
            }


        if(!$is_allow_access){

            return redirect()->to('/user/auth/sign-in');
        }

        return $next($request);
    }
}
