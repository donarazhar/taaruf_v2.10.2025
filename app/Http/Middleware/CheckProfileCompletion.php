<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('karyawan')->user();
        $menuAktif = false;

        if ($user) {
            $user->loadMissing(['biodata', 'kriteriapasangan']);
            
            if ($user->biodata && $user->kriteriapasangan) {
                $menuAktif = true;
            }

            $dataprofile = DB::table('karyawan')->where('email', $user->email)->first();
            View::share('dataprofile', $dataprofile);
        }

        View::share('menuAktif', $menuAktif);

        return $next($request);
    }
}
