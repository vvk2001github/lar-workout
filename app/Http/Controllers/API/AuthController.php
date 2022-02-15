<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function auth;

class AuthController extends Controller
{

    use ApiResponser;

    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

//        if (!Auth::attempt($attr)) {
//            return $this->error('Credentials not match', 401);
//        }

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['error' => 'The provided credentials are incorrect.'], 401);
        }

        //!!!!!
        if($request->email == "victor@victor.ru") {
            return $this->apisuccess([
                'token' => $user->createToken('API Token', ['server-admin'])->plainTextToken
            ]);
        }
        return $this->apisuccess([
            'token' => $user->createToken('API Token', [])->plainTextToken
        ]);
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
