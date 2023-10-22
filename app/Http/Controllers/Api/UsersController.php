<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Exception;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsersController extends AppBaseController
{
    public function store(Request $request)
    {
        //User Registration
        try {
            $request->validate([
                'user.first_name' => 'required|string|max:255',
                'user.last_name' => 'required|string|max:255',
                'user.email' => 'required|email|unique:users,email',
                'user.mobile' => 'required|string|max:15|unique:users,mobile',
                'user.password' => 'required|string|min:6',
            ]);

            $user = new User();
            $user->first_name =  $request->input('user.first_name');
            $user->last_name = $request->input('user.last_name');
            $user->email = $request->input('user.email');
            $user->password = bcrypt($request->input('user.password'));
            $user->role_id = 4; // User role
            $user->assignRole('user');
            $user->save();
            Log::info($user);
            return $this->sendResponse($user, 'User Registered Successful', null);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->sendResponse(null, null, $e->errors());
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return $this->sendResponse(null, null, 'Store Failed');
        }
    }

    public function auth(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->sendResponse(null, null, 'Invalid credentials');
            }
        } catch (JWTException $e) {
            return $this->sendResponse(null, null, 'Could not create token');
        }
        return response()->json(compact('token'));
    }
}
