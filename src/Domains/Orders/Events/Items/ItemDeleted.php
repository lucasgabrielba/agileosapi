<?php

namespace Domains\Orders\Events\Items;

use Domains\Shared\Enums\PermissionsEnum;
use Domains\Shared\Events\DispatchEventsByPermission;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ItemDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $item;

    public $organizationId;

    public function __construct(string $organizationId, string $itemId)
    {
        $this->organizationId = $organizationId;
        $this->itemId = $itemId;
    }

    public function broadcastAs()
    {
        return 'item-deleted';
    }

    public function broadcastOn()
    {
        return DispatchEventsByPermission::execute(
            $this->organizationId,
            PermissionsEnum::DELETE_ITEMS
        );
    }
}
