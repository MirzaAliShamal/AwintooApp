<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Client;

class NotificationService
{
    public static function createNotification(Client $client, $type, $data)
    {
        Notification::create([
            'client_id' => $client->id,
            'type' => $type,
            'data' => $data,
        ]);
    }
}
