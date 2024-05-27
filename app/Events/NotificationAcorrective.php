<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Action;
use App\Models\User;

class NotificationAcorrective implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

      public function broadcastOn()
      {
          return ['my-channel-ac'];
      }

      public function broadcastAs()
      {
          return 'my-event-ac';
      }
}