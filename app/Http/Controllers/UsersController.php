<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Buyer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    public function index()
    {
        // Index users
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        // Create a new user
    }

    public function store()
    {
        // Store the user
    }

    public function edit()
    {
        // Edit the user
    }

    public function update()
    {
        // Update the user
    }

    public function view($id)
    {
        $user = User::find($id);

        $bookings = Booking::select([
            'bookings.id AS booking_id',
            'bookings.recipe',
            DB::raw('CONCAT(users.first_name, " ", users.last_name) AS username'),
            'sf.name AS departure_station',
            'st.name AS arrival_station',
            DB::raw('CONCAT(bookings.class, " class") AS class'),
            'bookings.status AS booking_status',
            DB::raw('CASE
                WHEN bookings.class = 1 THEN tf.class_1_price
                WHEN bookings.class = 2 THEN tf.class_2_price
                WHEN bookings.class = 3 THEN tf.class_3_price
                END AS price'),
            'bookings.spent_points',
            'bookings.created_at AS booked_at',
        ])
        ->leftJoin('users', 'bookings.user_id', '=', 'users.id')
        ->leftJoin('stations AS sf', 'bookings.from_station_id', '=', 'sf.id')
        ->leftJoin('stations AS st', 'bookings.to_station_id', '=', 'st.id')
        ->leftJoin('tickets_fares AS tf', function ($join) {
            $join->on('tf.from_station_id', '=', 'bookings.from_station_id')
                ->on('tf.to_station_id', '=', 'bookings.to_station_id');
        })
        ->where('bookings.user_id', 26)
        ->get();

        $payments = Buyer::select([
            'buyers_history.id AS payment_id',
            DB::raw('CONCAT(users.first_name, " ", users.last_name) AS username'),
            'packages.id AS package_id',
            'packages.name AS package_name',
            'packages.price AS package_price',
            'packages.credit_points',
            'buyers_history.created_at AS buy_time',
        ])
        ->join('packages', 'buyers_history.package_id', '=', 'packages.id')
        ->join('users', 'buyers_history.user_id', '=', 'users.id')
        ->where('buyers_history.user_id', 3)
        ->get();

        dd($payments,$bookings);

        return view('users.view', compact('user', 'bookings', 'payments'));
    }

    public function delete()
    {
        // Delete the user
    }

    public function destroy($id)
    {
        // Destroy the user

        $user = User::find($id);
        if ($user->id === 1) {
            return redirect()->route('users.index')->with('ErrorMessage', 'Can\'t Remove Server Admin');
        }
        $user->delete();
        return redirect()->back()->with('SuccessMessage','User deleted successfully');
    }

    public function payments()
    {
        $payments = Buyer::select([
            'buyers_history.id AS payment_id',
            DB::raw('CONCAT(users.first_name, " ", users.last_name) AS user_name'),
            'packages.id AS package_id',
            'packages.name AS package_name',
            'packages.price AS package_price',
            'packages.credit_points',
            'buyers_history.created_at AS buy_time',
        ])
        ->join('packages', 'buyers_history.package_id', '=', 'packages.id')
        ->join('users', 'buyers_history.user_id', '=', 'users.id')
        ->get();

       return view('users.payments', compact('payments'));
    }
}
