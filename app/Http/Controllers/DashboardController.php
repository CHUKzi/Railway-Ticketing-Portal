<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
/*         $user  = Auth::user();

        $roles = $user->getRoleNames();

        dd($roles, $user); */

        return view('dashboard');
    }
}
