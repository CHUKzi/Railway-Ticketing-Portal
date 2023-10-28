<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }

    public function verify($email, $token)
    {
        if($user = User::where('email', $email)->first()){

            if($user->email_verification_token === $token) {
                $user->email_verified_at = Carbon::now();
                $user->email_verification_token = null;
                $user->save();
                return 'Your Account is verified successfully!';
            }

            if($user->email_verified_at){
                return 'Already Verified!';
            }
        }

        return 'Verified failed';
    }
}
