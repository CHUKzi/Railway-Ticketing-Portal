<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index()
    {
        // Index users
        $users = User::role('user')->get();
        return view('users.index', compact('users'));
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

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('SuccessMessage','User deleted successfully');
    }
}
