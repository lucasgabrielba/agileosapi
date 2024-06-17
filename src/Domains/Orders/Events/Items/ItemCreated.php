<?php

namespace Domains\Orders\Events\Items;

use Domains\Orders\Models\Item;
use Domains\Shared\Enums\PermissionsEnum;
use Domains\Shared\Events\DispatchEventsByPermission;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ItemCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $item;

    public $organizationId;

    public function __construct(string $organizationId, Item $item)
    {
        $this->organizationId = $organizationId;
        $this->item = $item;
    }

    public function broadcastAs()
    {
        return 'item-created';
    }

    public function broadcastOn()
    {
        return DispatchEventsByPermission::execute(
            $this->organizationId,
            PermissionsEnum::CREATE_ITEMS
        );
    }
}
