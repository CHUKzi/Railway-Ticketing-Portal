<?php

namespace App\Http\Controllers;

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
