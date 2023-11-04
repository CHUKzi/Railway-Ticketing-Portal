<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketBookingController extends Controller
{
    public function index()
    {
        // Index Trains

        $bookings = Booking::select('bookings.id as booking_id', 'bookings.recipe', DB::raw('CONCAT(users.first_name, " ", users.last_name) as username'), 'stations_from.name as departure_station', 'stations_to.name as arrival_station', DB::raw('CONCAT(bookings.class, " class") as class'), 'bookings.status as booking_status')
            ->addSelect(DB::raw('CASE
        WHEN bookings.class = 1 THEN tickets_fares.class_1_price
        WHEN bookings.class = 2 THEN tickets_fares.class_2_price
        WHEN bookings.class = 3 THEN tickets_fares.class_3_price
    END as price'))
            ->addSelect('bookings.spent_points', 'bookings.created_at as booked_at')
            ->leftJoin('users', 'bookings.user_id', '=', 'users.id')
            ->leftJoin('stations as stations_from', 'bookings.from_station_id', '=', 'stations_from.id')
            ->leftJoin('stations as stations_to', 'bookings.to_station_id', '=', 'stations_to.id')
            ->leftJoin('tickets_fares', function ($join) {
                $join->on('bookings.from_station_id', '=', 'tickets_fares.from_station_id')
                    ->on('bookings.to_station_id', '=', 'tickets_fares.to_station_id');
            })
            ->get();

        return view('tickets-bookings.index', compact('bookings'));
    }

    public function create()
    {
    }

    public function store()
    {
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }

    public function destroy()
    {
    }

    public function sendTicketStatus($bookings, $status)
    {
        // Pending

         foreach ($bookings as $booking){
            $bookinfo = Booking::find($booking->id);
            $user = User::find($booking->user_id);
            $send_email = new EmailController();
            $send_email->ticketStatusUpdate($user->email, $bookinfo);
         }

         return true;
    }
}
