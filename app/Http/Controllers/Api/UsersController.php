<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Models\Booking;
use App\Models\Buyer;
use App\Models\Station;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\TicketsFare;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\File;

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
            $user->email_verification_token = uniqid();
            $user->save();

            $verify_url = url('/') . '/verify/' . $user->email . '/' . $user->email_verification_token;

            $send_informations = [
                'verify_url' => $verify_url,
            ];

            $send_email = new EmailController();
            $send_email->userRegister($user->email, $send_informations);

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
            if ($user->email_verified_at === null) {
                return $this->sendResponse(null, null, 'Please verify your email address');
            }
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
                'name' => $user->first_name . ' ' . $user->last_name,
                'email' => $user->email,
                'mobile' => $user->mobile,
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

            return $this->sendResponse($payments, count($payments) . ' records found', null);
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return $this->sendResponse(null, null, 'failed');
        }
    }

    public function qrScan(Request $request)
    {
        // QR Code Scan
        try {
            $request->validate([
                'qr_id' => 'required',
                'latitude' => 'required|string|max:255',
                'longitude' => 'required|string|max:255',
            ]);

            $station = Station::find($request->input('qr_id'));

            if ($station) {
                $station_latitude = $station->latitude;
                $station_longitude = $station->longitude;
                $user_latitude = $request->input('latitude');
                $user_longitude = $request->input('longitude');

                $distanceThreshold = env('DISTANCE_THRESHOLD');

                $distance = Station::haversineDistance($station_latitude, $station_longitude, $user_latitude, $user_longitude);

                if ($distance <= $distanceThreshold) {

                    // Arrival Stations
                    $arrival_stations = TicketsFare::select([
                        'tickets_fares.to_station_id as station_id',
                        'stations.name as station_name',
                        'tickets_fares.class_1_price',
                        'tickets_fares.class_2_price',
                        'tickets_fares.class_3_price',
                        'tickets_fares.currency',
                    ])
                        ->join('stations', 'stations.id', '=', 'tickets_fares.to_station_id')
                        ->where('tickets_fares.from_station_id', $station->id)
                        ->get();

                    $response = [
                        'departure_station' => [
                            'station_id' => $station->id,
                            'station_name' => $station->name,
                        ],

                        'arrival_stations' => $arrival_stations,
                    ];

                    return $this->sendResponse($response, 'Qr Code Scan Successfully!', null);
                }
            } else {
                return $this->sendResponse(null, null, 'Invalid QRCode');
            }
            return $this->sendResponse(null, null, 'Can\'t find station with in your location');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->sendResponse(null, null, $e->errors());
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return $this->sendResponse(null, null, 'Store Failed');
        }
    }

    public function payNow(Request $request)
    {
        // Pay Now
        try {
            $request->validate([
                'departure_station_id' => 'required',
                'arrival_station_id' => 'required',
                'tickets_qty' => 'required',
                'class' => 'required|in:1,2,3',
                'latitude' => 'required|string|max:255',
                'longitude' => 'required|string|max:255',
            ]);

            $departure_station = Station::find($request->input('departure_station_id'));

            if ($departure_station) {

                $arrival_station = Station::find($request->input('arrival_station_id'));

                if ($arrival_station) {
                    $station_latitude = $departure_station->latitude;
                    $station_longitude = $departure_station->longitude;
                    $user_latitude = $request->input('latitude');
                    $user_longitude = $request->input('longitude');

                    $distanceThreshold = env('DISTANCE_THRESHOLD');

                    $distance = Station::haversineDistance($station_latitude, $station_longitude, $user_latitude, $user_longitude);

                    if ($distance <= $distanceThreshold) {

                        $destination_info = TicketsFare::where('from_station_id', $request->input('departure_station_id'))
                            ->where('to_station_id', $request->input('arrival_station_id'))
                            ->first();

                        if ($request->input('class') == 1) {
                            $destination_for_points = $destination_info->class_1_price;
                            $ticket_price = $destination_info->class_1_price;
                        } elseif ($request->input('class') == 2) {
                            $destination_for_points = $destination_info->class_2_price;
                            $ticket_price = $destination_info->class_2_price;
                        } elseif ($request->input('class') == 3) {
                            $destination_for_points = $destination_info->class_3_price;
                            $ticket_price = $destination_info->class_3_price;
                        } else {
                            return $this->sendResponse(null, null, 'invalid class selected');
                        }

                        $destination_for_points = $destination_for_points * $request->input('tickets_qty');

                        $user = Auth::user();

                        if ($destination_for_points <= $user->credit_points) {

                            for ($i = 0; $i < $request->input('tickets_qty'); $i++) {

                                //$recipe = time() . uniqid();

                                $randomNumber = mt_rand(1000, 9999); // Generate a random 4-digit number
                                $date = date('Ymd'); // Get the current date in the format YYYYMMDD
                                $time = date('g:iA'); // Get the current time in the format hh:mma (e.g., 10:20AM)
                                $recipe = $date . 'GT' . $time . $randomNumber;

                                $booking = new Booking();
                                $booking->user_id = $user->id;
                                $booking->from_station_id = $request->input('departure_station_id');
                                $booking->to_station_id = $request->input('arrival_station_id');
                                $booking->recipe = $recipe;
                                $booking->spent_points = $destination_for_points / $request->input('tickets_qty');
                                $booking->status = 'active';
                                $booking->class = $request->input('class');

                                //File name
                                $uniqueId = time() . '-' . uniqid();
                                $qr_file_name = 'f-' . $booking->from_station_id . '-to-' . $booking->to_station_id . '-QID-' . $uniqueId . '.svg';
                                $qrCodeSvg = QrCode::size(200)->generate($recipe);
                                File::put(public_path('build/users/recipe/' . $qr_file_name), $qrCodeSvg);
                                $booking->qr_code = $qr_file_name;
                                $booking->save();

                                $booking_data = [
                                    'id' => $booking->id,
                                    'receipt' => $booking->recipe,
                                    'departure_station_id' => $booking->from_station_id,
                                    'departure_station_name' => $departure_station->name,
                                    'arrival_station_id' => $booking->to_station_id,
                                    'arrival_station_name' => $arrival_station->name,
                                    'class' => $request->input('class') . ' class',
                                    'ticket_price' => $ticket_price,
                                    'currency' => $destination_info->currency,
                                    'spent_points' => $booking->spent_points,
                                    'qr_code' => URL::asset('/build/users/recipe/' . $booking->qr_code),
                                    'status' => $booking->status,
                                    'booked_at' => $booking->created_at,
                                ];
                                /*  Your Ticket Booked Confirmation #book ID 334384029 */
                                $booking_data_all[] = $booking_data;
                            }

                            $user->credit_points -= $booking->spent_points;
                            $user->save();
                            //$destination_for_points - $user->credit_points;

                            $response = [
                                'booking_information' => $booking_data_all,
                                'total' => [
                                    'total_ticket_price' => number_format($ticket_price * $request->input('tickets_qty'), 2),
                                    'currency' => $destination_info->currency,
                                    'total_spent_points' => $destination_for_points,
                                ],
                            ];

                            $send_email = new EmailController();
                            $send_email->ticketBook($user->email, $response);

                            return $this->sendResponse($response, 'Ticket Successfully Booked!', null);
                        } else {
                            return $this->sendResponse(null, null, 'your account has not enough Credit points for this booking');
                        }
                    }
                } else {
                    return $this->sendResponse(null, null, 'Invalid arrival station');
                }
            } else {
                return $this->sendResponse(null, null, 'Invalid Departure station');
            }
            return $this->sendResponse(null, null, 'Can\'t find station with in your location');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->sendResponse(null, null, $e->errors());
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return $this->sendResponse(null, null, 'Store Failed');
        }
    }
}
