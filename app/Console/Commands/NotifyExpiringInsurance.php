<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Notification;
use Illuminate\Console\Command;
use App\Models\RestInformation;
use App\Mail\ExpiryMail;
use Illuminate\Support\Facades\Mail;

class NotifyExpiringInsurance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:expiring-insurance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications for insurance that are expiring in less than 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now();
        $thresholdDate = $today->copy()->addDays(30);

        $info = RestInformation::whereBetween('insurance_expiry_date', [$today, $thresholdDate])->get();

        foreach ($info as $detail) {
            $daysLeft = $today->diffInDays($detail->insurance_expiry_date, false);
            $notify = Notification::create([
                'client_id' => $detail->id,
                'type' => 'insurance',
                'full_name' => $detail->client->full_name,
                'expiry_date' => $detail->insurance_expiry_date,
                'days_left' => $daysLeft,
            ]);
            $client = [
                'full_name' => $detail->client->full_name,
                'expiry_date' => $detail->insurance_expiry_date,
                'daysLeft' => $notify->days_left,
                'email' => $detail->client->email,
            ];

            // Mail::to($detail->client->email)->send(new ExpiryMail((object) $client, 'Insurance'));
        }

        $this->info('Notifications have been sent successfully.');
        
        return 0;
    }
}
