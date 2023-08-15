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
        $inputs = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
        ]);

        /** @var User ログインユーザ */
        $user = Auth::user();

        $user->fill($inputs)->save();

        return response()->json();
    }
}
