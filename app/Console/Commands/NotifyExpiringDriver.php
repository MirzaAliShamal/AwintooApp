<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Notification;
use Illuminate\Console\Command;
use App\Models\RestInformation;
use App\Mail\ExpiryMail;
use Illuminate\Support\Facades\Mail;

class NotifyExpiringDriver extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:expiring-driver';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications for driver licence that are expiring in less than 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now();
        $thresholdDate = $today->copy()->addDays(30);

        $info = RestInformation::whereBetween('driver_license_expiry_date', [$today, $thresholdDate])->get();

        foreach ($info as $detail) {
            $daysLeft = $today->diffInDays($detail->driver_license_expiry_date, false);
            $notify = Notification::create([
                'client_id' => $detail->id,
                'type' => 'driver',
                'full_name' => $detail->client->full_name,
                'expiry_date' => $detail->driver_license_expiry_date,
                'days_left' => $daysLeft,
            ]);
            $client = [
                'full_name' => $detail->client->full_name,
                'expiry_date' => $detail->insurance_expiry_date,
                'daysLeft' => $notify->days_left,
                'email' => $detail->client->email,
            ];

            // Mail::to($detail->client->email)->send(new ExpiryMail((object) $client, 'Driver Licence'));
        }

        $this->info('Notifications have been sent successfully.');
        
        return 0;
    }
}
