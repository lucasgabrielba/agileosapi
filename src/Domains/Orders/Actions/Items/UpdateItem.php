<?php

namespace Domains\Orders\Actions\Items;

use Domains\Orders\Events\Items\ItemUpdated;
use Domains\Orders\Models\Item;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateItem
{
    public static function execute(string $organizationId, string $itemId, array $data): void
    {
        try {
            Item::where('id', $itemId)->update($data);

            event(new ItemUpdated($organizationId, $itemId));
        } catch (ModelNotFoundException $e) {
            throw new Exception('Item not found');
        } catch (Exception $e) {
            throw new Exception('An error occurred during the update: '.$e->getMessage());
        }
    }
}
