<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Notification;
use Illuminate\Console\Command;
use App\Mail\ExpiryMail;
use Illuminate\Support\Facades\Mail;

class NotifyExpiringPassports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:expiring-passports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications for passports that are expiring in less than 30 days';

    /**
     * Execute the console command.
     */
    
    public function handle()
    {
        $today = Carbon::now();
        $thresholdDate = $today->copy()->addDays(30);

        $clients = Client::whereBetween('expiry_date', [$today, $thresholdDate])->get();

        foreach ($clients as $client) {
            $daysLeft = $today->diffInDays($client->expiry_date, false);
            $notify = Notification::create([
                'client_id' => $client->id,
                'type' => 'passport',
                'full_name' => $client->full_name,
                'expiry_date' => $client->expiry_date,
                'days_left' => $daysLeft,
            ]);
            $client['daysLeft'] = $notify->days_left;
            Mail::to($client->email)->send(new ExpiryMail($client, 'Passport'));
        }

        $this->info('Notifications have been sent successfully.');
        
        return 0;
    }
}
