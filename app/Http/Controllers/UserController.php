<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function update(Request $request): JsonResponse
    {
        // 入力チェック
        $inputs = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
        ]);

        // ユーザ情報更新
        $user = User::find(Auth::id());
        $user->fill($inputs)->save();

        return response()->json();
    }
}
