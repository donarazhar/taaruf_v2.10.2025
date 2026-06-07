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
            $cekemail = DB::table('karyawan')
                ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
                ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
                ->select('karyawan.email', 'biodata.email as biodata_email', 'kriteriapasangan.email as kriteriapasangan_email')
                ->where('karyawan.email', $user->email)
                ->first();

            if ($cekemail && $cekemail->biodata_email !== null && $cekemail->kriteriapasangan_email !== null) {
                $menuAktif = true;
            }
        }

        View::share('menuAktif', $menuAktif);

        return $next($request);
    }
}
