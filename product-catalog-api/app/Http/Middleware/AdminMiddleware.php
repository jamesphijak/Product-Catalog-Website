<?php
namespace App\Http\Middleware;

use App\Users;
use Closure;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;

class AdminMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $user = $request->auth;
        // Now let's put the user in the request class so that you can grab it from there
        if($user['type'] == 'admin'){
            return $next($request);
        }else{
            return response()->json([
                'error' => 'No Authorization (Require as admin role)',
            ], 400);
        }
        
    }
}