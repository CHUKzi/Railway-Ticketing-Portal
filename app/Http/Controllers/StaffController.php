<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

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
        //create staff
        $roles = User::Roles;
        return view('staff.create', compact('roles'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|string|max:15|unique:users,mobile',
        ]);

        try {
            $user = new User();

            if ($request->input('role') == 'super admin') {
                $user->role_id = 1;
            } elseif ($request->input('role') == 'admin') {
                $user->role_id = 2;
            } elseif ($request->input('role') == 'staff') {
                $user->role_id = 3;
            }

            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');
            $user->assignRole($request->input('role'));
            $user->email_verified_at = Carbon::now();

            $gen_password = uniqid();
            $user->password = Hash::make($gen_password);

            $login_url = url('/').'/profile?genpassword=ture';
            $send_informations = [
                'name' => $user->first_name.' '.$user->last_name,
                'email' => $user->email,
                'password' => $gen_password,
                'role'=> $request->input('role'),
                'login_url' => $login_url,
            ];

            $send_email = new EmailController();
            $send_email->staffRegister($user->email, $send_informations);

            $user->save();

            return redirect()->route('staff.index')->with('SuccessMessage', 'Created successfully');
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return redirect()->route('staff.index')->with('ErrorMessage', 'Created Failed');
        }
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
        try {
            $user = User::find($id);
            // System Admin
            if ($user->id === 1) {
                return redirect()->route('staff.index')->with('ErrorMessage', 'Can\'t Remove Server Admin');
            }
            $user->delete();
            return redirect()->route('staff.index')->with('SuccessMessage', 'Deleted successfully');
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return redirect()->route('staff.index')->with('ErrorMessage', 'Delete Failed');
        }
    }
}
