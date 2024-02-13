<?php
namespace app\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

class LoginController extends AuthenticatedSessionController
{


    /**
     * Get the post login redirect response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LoginResponse
     */
    protected function redirectTo($request): LoginResponse
    {
        if ($request->filled('redirect')) {
            dd($request->input('redirect'));
            return app(LoginResponse::class)->redirectTo($request->input('redirect'));
        }
        dd($request->input('redirect'));
        return app(LoginResponse::class);
    }
}

