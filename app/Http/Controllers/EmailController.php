<?php

namespace App\Http\Controllers;

use App\Mail\PackageBuy;
use App\Mail\StaffRegister;
use App\Mail\TicketBook;
use App\Mail\UserRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function staffRegister($email, $information)
    {
        $MailData = [
            'title' => 'Staff Register',
            'html' => $information,
        ];

        Mail::to($email)->send(new StaffRegister($MailData));
    }

    public function userRegister($email, $information)
    {
        $MailData = [
            'title' => 'user Register',
            'html' => $information,
        ];

        Mail::to($email)->send(new UserRegister($MailData));
    }

    public function buyPackage($email, $information)
    {
        $MailData = [
            'title' => 'Package Buy',
            'html' => $information,
        ];

        Mail::to($email)->send(new PackageBuy($MailData));
    }

    public function ticketBook($email, $information)
    {
        $MailData = [
            'title' => 'Tickets Book',
            'html' => $information,
        ];

        Mail::to($email)->send(new TicketBook($MailData));
    }
}
