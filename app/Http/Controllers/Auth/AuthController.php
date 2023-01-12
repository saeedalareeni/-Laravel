<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function showLogin()
    {
        return response()->view('cms.auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|string',
            'remember' => 'nullable|in:on',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->getMessageBag()->first()]
                , Response::HTTP_BAD_REQUEST
            );
        } else {
            $credentials = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];

            if (Auth::guard('admin')->attempt($credentials, $request->input('remember'))) {
                return response()->json(['message' => 'Looged in suuccessfuly'], Response::HTTP_OK);
            } else {
                return response()->json(['message' => 'Erorr In Password Or Email!'], Response::HTTP_BAD_REQUEST);
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->guest(route('auth.login'));
    }
}