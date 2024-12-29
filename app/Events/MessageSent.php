<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $message;
    public $receiver_id;
    public $dateTime;
    public $sender_id;

    public function __construct($message, $receiver_id, $dateTime, $sender_id)
    {
        $this->message = $message;
        $this->receiver_id = $receiver_id;
        $this->dateTime = $dateTime;
        $this->sender_id = $sender_id;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.'.$this->receiver_id),
        ];
    }
    function broadcastWith() : array {
        return [
            'content' => $this->message,
            'date_time' => $this->dateTime,
            'receiver_id' => $this->receiver_id,
            'sender_id' => auth()->user()->id,
        ];
    }

}
