<?php

namespace App\Http\Middleware;

use App\Models\Authorizations;
use App\ResponseTypes;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Apimw
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $headers = getallheaders();
        $responseMessage = [
            "status" => ResponseTypes::$unauth,
            "message" => "Unauthorized Action!"
        ];

        if(!array_key_exists('auth_token', $headers)) {
            return response()->json($responseMessage);
        } else {
            $authToken = Authorizations::whereNull("expired_at")->where("auth_token", $headers["auth_token"])->get();
            if(!$authToken->contains("auth_token", $headers["auth_token"])) {
                return response()->json($responseMessage);
            }
        }

        $response = $next($request);
        $response->headers->set('auth_token', $headers["auth_token"] ?? "");
        header("Content-Type: application/json; charset=UTF-8");

        return $response;
    }
}
