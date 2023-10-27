<?php

namespace App\Http\Controllers;

use App\Mail\StaffRegister;
use App\Mail\UserRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function staffRegister($email, $information)
    {
        $MailData = [
            'title' => 'Test Email From AllPHPTricks.com',
            'html' => $information,
        ];

        Mail::to($email)->send(new StaffRegister($MailData));
    }
}
