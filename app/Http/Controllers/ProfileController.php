<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        if ($request->query('genpassword') == true) {
            session()->flash('ErrorMessage', 'Please Change Your Password');
            return view('profile.edit');
        }

        return view('profile.edit');
    }

    public function passwordUpdate(Request $request)
    {
        // Validate user input
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            // Get the authenticated user
            $user = Auth::user();

            if (Hash::check($request->current_password, $user->password)) {

                $user->password = Hash::make($request->password);
                $user->save();

                return redirect()->route('dashboard')->with('SuccessMessage', 'Password changed successfully');
            } else {
                return back()->with('ErrorMessage', 'Current password is incorrect');
            }
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return back()->with('ErrorMessage', 'An error occurred while changing the password.');
        }
    }
}
