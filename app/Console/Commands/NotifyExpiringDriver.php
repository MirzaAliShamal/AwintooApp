<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Notification;
use Illuminate\Console\Command;
use App\Models\RestInformation;

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
        $today = Carbon::now()->startOfDay();
        $thresholdDate = $today->copy()->addDays(30);

        $info = RestInformation::whereBetween('driver_license_expiry_date', [$today, $thresholdDate])->get();

        foreach ($info as $detail) {
            $expiryDate = Carbon::parse($detail->driver_license_expiry_date)->startOfDay();
            if ($expiryDate->isTomorrow()) {
                $daysLeft = 1;
            } else {
                $daysLeft = $today->diffInDays($expiryDate);
            }
            Notification::create([
                'client_id' => $detail->client->id,
                'type' => 'driver',
                'full_name' => $detail->client->full_name,
                'expiry_date' => $detail->driver_license_expiry_date,
                'days_left' => $daysLeft,
            ]);
            $client = [
                'full_name' => $detail->client->full_name,
                'expiry_date' => $detail->driver_license_expiry_date,
                'daysLeft' => $daysLeft,
                'email' => $detail->client->email,
            ];
        }

        $this->info('Notifications have been sent successfully.');
        
        return 0;
    }

}
