<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiTokenController extends Controller
{
    public function createToken(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            // 'device_name' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['err' => $validator->errors()]);
        }

        $user = User::where('email', $request->email)->first(); // поиск пользователя

        // хэш пароля пользователя
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['err' => 'user not found'], 401);
        }

        // получение токена после всех проверок
        // $token = $user->createToken($request->device_name);
        // testing

        // return ['token' => $token->plainTextToken];
        $token = $user->createToken("API TOKEN")->plainTextToken;
        return ['token' => $token];
    }

}
