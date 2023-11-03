<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Http\Requests\BuyRequest;
use App\Models\Buyer;
use App\Models\Package;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Facades\JWTAuth;

class PackagesController extends AppBaseController
{
    public function index(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            //$token = $request->bearerToken();

            $packages = Package::all();
            $packages = collect($packages);

            if ($packages->isEmpty()) {
                return $this->sendResponse(null, null, 'Packages not found');
            }
            return $this->sendResponse($packages, count($packages) . ' Packages found', null);

        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return $this->sendResponse(null, null,'It\'s a technical error! Please reach out to our customer service.');
        }
    }

    public function indexSingle(Request $request, $id)
    {
        try {
            $package = Package::find($id);
            $package = collect($package);

            if ($package->isEmpty()) {
                return $this->sendResponse(null, null, 'Package not found');
            }
            return $this->sendResponse($package, 'Package found', null);

        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return $this->sendResponse(null, null,'It\'s a technical error! Please reach out to our customer service.');
        }
    }

    public function buyNow(Request $request)
    {
        try {

            $request->validate([
                'package_id' => 'required',
                'payment_type' => 'required|in:card', //ezCash
            ]);

            $user = Auth::user();
            $package = Package::find($request->package_id);
            $userData = User::find($user->id);
            $userData->credit_points += $package->credit_points;
            if ($userData->save()) {
                $buyer = new Buyer();
                $buyer->user_id = $userData->id;
                $buyer->package_id = $package->id;
                $buyer->payment_type = $request->payment_type;
                $buyer->save();
            }

            $Data = [
                "payment_id"=>$buyer->id,
                "user_id" => $userData->id,
                "package_id"=>$package->id,
                "package_name" => $package->name,
                'package_price' => $package->price,
                'currency' => $package->currency,
                "buy_points" => $package->credit_points,
                "current_credit_points"=>number_format($userData->credit_points, 2),
                "payment_type"=>$buyer->payment_type,
                "time" => $buyer->created_at,
            ];

            $send_email = new EmailController();
            $send_email->buyPackage($user->email, $Data);

            return $this->sendResponse($Data, 'Payment successful!', null);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->sendResponse(null, null, $e->errors());
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return $this->sendResponse(null, null, 'Payment Failed');
        }
    }
}
