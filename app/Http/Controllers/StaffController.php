<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        // Index Staff
        $users = User::role(['super admin', 'admin', 'staff'])->get();
        return view('staff.index', compact('users'));

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
}
