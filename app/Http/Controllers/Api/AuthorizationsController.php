<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Authorizations;
use App\ResponseTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthorizationsController extends Controller
{
    public function authorizing(Request $request)
    {
        $ip = $request->ip();
        $auth = Authorizations::where("ip_address", $ip)->firstOrFail();

        if($auth->ip_address != null)
        {
            return $auth->auth_token;
        }
        else
        {
            $auth_token = Str::uuid();
            $auth = new Authorizations();
            $auth->ip_address = $ip;
            $auth->auth_token = $auth_token;
            $auth->is_active = true;
            $auth->expired_at = null;
            $auth->save();
            return [
                "status" => ResponseTypes::$ok,
                "auth_token" => $auth_token,
            ];
        }
    }
}
