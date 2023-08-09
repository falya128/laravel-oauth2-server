<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        // 入力チェック
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // 認証成功
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // 認証失敗
        return back()
            ->withErrors(['email' => '認証に失敗しました。'])
            ->onlyInput('email');
    }
}
