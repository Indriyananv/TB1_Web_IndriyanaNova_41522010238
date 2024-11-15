<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(Illuminate\Http\Request): (Symfony\Component\HttpFoundation\Response) $next
     */

    /** Fungsi middleware untuk membatasi akses halaman tertentu berdasarkan role user */
    public function handle(Request $request, Closure $next, $userType): Response
    {
        // cek apakah user sudah login
        if (Auth::user()->role == $userType) {
            return $next($request);
        }

        // jika user tidak memiliki akses, kirim pesan error
        return response()->json([
            'error' => 'You do not have permission to access for this page.',
            'userType' => $userType
        ]);
    }
}
