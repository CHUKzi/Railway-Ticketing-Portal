<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Buyer;
use App\Models\Station;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
/*         $user  = Auth::user();

        $roles = $user->getRoleNames();

        dd($roles, $user); */
        $count_users = User::role('user')->count();
        $count_back_office_staff = User::role(['staff','admin','super admin'])->count();
        $count_stations = Station::count();
        $count_booking = Booking::where('status', 'active')->count();

        // Last 7 days of charts

        $endDate = Carbon::now()->endOfDay();
        $startDate = Carbon::now()->subDays(6);

        $b_data = [['Days', 'Booking']];

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dayName = $date->englishDayOfWeek;
            $bookingCount = Booking::whereDate('created_at', $date->toDateString())->count();
            $b_data[] = [$dayName, $bookingCount];
        }

        $last7_days_booking_data = json_encode($b_data);

        $endDate = Carbon::now()->endOfDay();
        $startDate = Carbon::now()->subDays(6);

        $p_data = [['Days', 'Payment']];

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dayName = $date->englishDayOfWeek;
            $paymentsCount = Buyer::whereDate('created_at', $date->toDateString())->count();
            $p_data[] = [$dayName, $paymentsCount];
        }

        $last7_days_payment_data = json_encode($p_data);

        return view('dashboard', compact('count_users', 'count_back_office_staff', 'count_stations', 'count_booking', 'last7_days_booking_data', 'last7_days_payment_data'));
    }
}
