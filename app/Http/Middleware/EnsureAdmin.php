<?php


namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;


class EnsureAdmin
{
public function handle(Request $request, Closure $next)
{
$user = $request->user();
// Eğer authentication yoksa veya role admin değilse 403 döndür
if (! $user || $user->role !== 'admin') {
return response()->json(['message' => 'Only admins can perform this action.'], 403);
}


return $next($request);
}
}