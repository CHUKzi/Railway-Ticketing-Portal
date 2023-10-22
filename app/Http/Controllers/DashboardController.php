<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

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

        return view('dashboard', compact('count_users', 'count_back_office_staff', 'count_stations'));
    }
}
