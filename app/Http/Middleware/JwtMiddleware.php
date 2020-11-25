<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JwtMiddleware
{

    public function handle($request, Closure $next, $guard = null) {

        $token                  = $request->bearerToken();

        if( !$token )
            return response()->json(['success' => false, 'message' => 'Token not provided.'], 401);

        try {

            $credentials            = JWT::decode($token, env('APP_KEY'), ['HS256']);

        } catch(ExpiredException $e) {

            return response()->json(['success' => false, 'message' => 'Provided token is expired.'], 400);

        } catch(Exception $e) {

            return response()->json(['success' => false, 'message' => 'An error while decoding token.'], 400);

        }

        $request->user_id 			= $credentials->sub;

        return $next($request);

    }

}