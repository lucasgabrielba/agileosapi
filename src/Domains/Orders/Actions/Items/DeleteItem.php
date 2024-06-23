<?php

namespace Domains\Orders\Actions\Items;

use Domains\Orders\Events\Items\ItemDeleted;
use Domains\Orders\Models\Item;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteItem
{
    public static function execute(string $organizationId, string $itemId): void
    {
        try {
            Item::where('id', $itemId)->delete();

            event(new ItemDeleted($organizationId, $itemId));
        } catch (ModelNotFoundException $e) {
            throw new Exception('Item not found');
        } catch (Exception $e) {
            throw new Exception('An error occurred during the delete: '.$e->getMessage());
        }
    }
}
