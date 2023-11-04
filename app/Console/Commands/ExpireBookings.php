<?php

namespace App\Console\Commands;

use App\Http\Controllers\TicketBookingController;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;

class ExpireBookings extends Command
{
    protected $signature = 'bookings:expire';
    protected $description = 'Expire bookings older than 12 hours';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $expiredDatetime = Carbon::now()->subHours(24);
        $status = 'expired';
        Booking::where('created_at', '<', $expiredDatetime)
        ->where('status', 'active')
        ->orWhere('status', 'checked')
        ->update([
            'status' => $status,
            'expired_at' => Carbon::now(),
        ]);

        $this->info('Bookings expired successfully.');
    }
}
