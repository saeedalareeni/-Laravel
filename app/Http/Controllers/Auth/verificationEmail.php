<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class verificationEmail extends Controller
{
    public function notic()
    {
        return response()->view('cms.auth.VerificationEmail');
    }

    public function sendEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return response()->json([
            'message' => 'Email verification Send Success',
        ], Response::HTTP_OK);
    }

    public function sendEmailVerification(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('admin.index');
    }
}