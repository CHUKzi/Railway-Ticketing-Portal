<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
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
            return $this->sendResponse(null, null, 'Store Failed');
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
            return $this->sendResponse(null, null, 'Store Failed');
        }
    }
}
