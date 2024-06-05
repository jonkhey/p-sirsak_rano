<?php

namespace App\Http\Middleware;

use App\Models\MenuAccess;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyApprovedCanAccess
{
   /**
    * Handle an incoming request.
    *
    * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    */
   public function handle(Request $request, Closure $next, ...$idMenu): Response
   {
      if ($request->user()?->isCanAcces($idMenu)) {
         return $next($request);
      }

      abort(403, 'Anda tidak mempunyai akses ke halaman ini');
   }
}
