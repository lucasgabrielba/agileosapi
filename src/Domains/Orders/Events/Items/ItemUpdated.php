<?php

namespace Domains\Orders\Events\Items;

use Domains\Orders\Models\Item;
use Domains\Shared\Actions\Events\DispatchEventsByPermission;
use Domains\Shared\Enums\PermissionsEnum;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ItemUpdated implements ShouldBroadcast
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
        return 'item-updated';
    }

    public function broadcastOn()
    {
        return DispatchEventsByPermission::execute(
            $this->organizationId,
            PermissionsEnum::EDIT_ITEMS
        );
    }
}
