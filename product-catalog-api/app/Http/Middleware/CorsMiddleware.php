<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Http\Middleware;
use Closure;
/**
 * Description of CorsMiddleware
 *
 * @author Amiearth
 */
class CorsMiddleware
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
        //Intercepts OPTIONS requests
        if ($request->isMethod('OPTIONS')) {
            $response = response('', 200);
        } else {
            // Pass the request to the next middleware
            $response = $next($request);
        }

        // Check URL : 
        // let ALLOW_ORIGIN = ['domain-a.com', 'domain-b.com', 'domain-c.com']
        // let ORIGIN = req.headers.origin
        // if (ALLOW_ORIGIN.includes(ORIGIN)) {
        //     res.header('Access-Control-Allow-Origin', ORIGIN)
        // }

        // Adds headers to the response
        $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE');
        $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
        
        // Check in whitelist
        $cors_allow  = explode(',', env('CORS_ORIGIN_URL'));
        $cors = $request->header('Origin');
        if(in_array($cors, $cors_allow)){
            $response->header('Access-Control-Allow-Origin', $cors ); // '*'
        }
        
        // Sends it
        return $response;
    }
}