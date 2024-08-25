<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Notification;
use Illuminate\Console\Command;

class NotifyExpiringId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:expiring-id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications for Id that are expiring in less than 30 days';

    /**
     * Execute the console command.
     */
    
    public function handle()
    {
        $today = Carbon::now()->startOfDay();
        $thresholdDate = $today->copy()->addDays(30);
        $clients = Client::whereBetween('id_expiry_date', [$today, $thresholdDate])->get();

        foreach ($clients as $client) {
            $expiryDate = Carbon::parse($client->id_expiry_date)->startOfDay();
            if ($expiryDate->isTomorrow()) {
                $daysLeft = 1;
            } else {
                $daysLeft = $today->diffInDays($expiryDate);
            }
            Notification::create([
                'client_id' => $client->id,
                'type' => 'id_expire',
                'full_name' => $client->full_name,
                'expiry_date' => $client->id_expiry_date,
                'days_left' => $daysLeft,
            ]);
        }
        $this->info('Notifications have been sent successfully.');

        return 0;
    }



}
