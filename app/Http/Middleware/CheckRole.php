<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $userRole = session('user_role');

        if ($userRole === 'Admin') {
            return $next($request);
        }

        // 3. Jika user punya role yang diizinkan
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        if (! in_array($userRole, $roles)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
