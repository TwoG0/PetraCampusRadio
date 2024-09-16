<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class detail_scriptUpdate implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $script;
    public $index;
    public $fieldindex;
    public $cmd;
    public function __construct($s,$i,$f,$c)
    {
        $this->script = $s;
        $this->index = $i;
        $this->fieldindex = $f;
        $this->cmd = $c;
    }

    public function broadcastWith(): array
    {
        // dd($this->text);

        return [
            'scriptid' => $this->script->id,
            'index' => $this->index,
            'fieldindex' => $this->fieldindex,
            'command' => $this->cmd,
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // dd($this->script);
        return [
            new Channel('EditScript.'.$this->script->id),
        ];
    }
}
