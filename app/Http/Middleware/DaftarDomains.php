<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DaftarDomains
{
   /**
    * Handle an incoming request.
    *
    * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    */
   public function handle(Request $request, Closure $next): Response
   {
      $allowedDomains = [null, 'http://127.0.0.1:8000', 'http://127.0.0.1:8001'];

      $origin = $request->header('Origin');

      if (in_array($origin, $allowedDomains)) {
         return $next($request);
      }

      return response()->json([
         'message' => 'Forbidden. Unauthorized Domain.',
         'yourDomain' => $origin,
      ], 403);
   }
}
