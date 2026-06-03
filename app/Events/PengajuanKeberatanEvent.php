<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;  

class PengajuanKeberatanEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $nama;
    public $email;
    /**
     * Create a new event instance.
     */
    public function __construct($nama, $email)
    {
        $this->nama = $nama;
        $this->email = $email;
    }

    public function broadcastAs(): array
    {
        return [
            'nama' => $this->nama,
            'email' => $this->email
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return new Channel('pengajuan-keberatan', $this->nama, $this->email);
    }
}
