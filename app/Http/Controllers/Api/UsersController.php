<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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
            $user->mobile = $request->input('user.mobile');
            $user->password = bcrypt($request->input('user.password'));
            $user->role_id = 4; // User role
            $user->credit_points = 0;
            $user->assignRole('user');
            $user->save();
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
            $user = Auth::user();
            $user->update(['last_login' => Carbon::now()]);
        } catch (JWTException $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return $this->sendResponse(null, null, 'Could not create token');
        }
        return response()->json(compact('token'));
    }

    public function logout()
    {
        // User Logout
        try {
            if (Auth::check()) {
                Auth::logout();
                return $this->sendResponse(null, 'User logged out successfully', null);
            }
            return $this->sendResponse(null, null, 'User not authenticated');
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return $this->sendResponse(null, null, 'Logout failed');
        }
    }

    public function myAccount()
    {
        // My Account
        try {
            $user = Auth::user();

            $Data = [
                'id' => $user->id,
                'name' => $user->first_name . ' '. $user->last_name,
                'email'=> $user->email,
                'mobile'=> $user->mobile,
                'credit_points' => number_format($user->credit_points, 2),
                'join_date' => Carbon::parse($user->created_at)->format('Y-m-d'),
            ];

            return $this->sendResponse($Data, 'Fetch data successfully!', null);
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return $this->sendResponse(null, null, 'failed');
        }
    }

    public function myPayments()
    {
        // My Payments
        try {
            $payments = Buyer::select('buyers_history.id as payment_id', 'packages.id as package_id', 'packages.name as package_name', 'packages.price as package_price', 'packages.credit_points', 'packages.created_at as time')
            ->join('packages', 'buyers_history.package_id', '=', 'packages.id')
            ->where('buyers_history.user_id', Auth::user()->id)
            ->orderByDesc('buyers_history.created_at')
            ->get();

            $payments = collect($payments);

            if ($payments->isEmpty()) {
                return $this->sendResponse(null, null, 'Payments not found');
            }

            return $this->sendResponse($payments, count($payments).' records found', null);

        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return $this->sendResponse(null, null, 'failed');
        }
    }
}
