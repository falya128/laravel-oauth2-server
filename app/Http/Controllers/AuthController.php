<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;

class AuthController extends Controller
{
    /**
     * ログイン
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            /** @var User ログインユーザ */
            $user = Auth::user();

            $user->update(['last_login_at' => Carbon::now()]);

            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return back()
            ->withErrors(['email' => '認証に失敗しました。'])
            ->onlyInput('email');
    }

    /**
     * ログアウト
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect($request->input('redirect_uri', '/login'));
    }

    /**
     * トークンの取消
     *
     * @param Request $request
     * @param string $clientId
     * @return JsonResponse
     */
    public function revokeToken(Request $request, string $clientId): JsonResponse
    {
        $tokenIds = Passport::token()
            ->where('user_id', Auth::id())
            ->where('client_id', $clientId)
            ->where('revoked', false)
            ->get()
            ->pluck('id');

        Passport::token()
            ->whereIn('id', $tokenIds)
            ->update(['revoked' => true]);

        Passport::refreshToken()
            ->whereIn('access_token_id', $tokenIds)
            ->update(['revoked' => true]);

        return response()->json();
    }
}
