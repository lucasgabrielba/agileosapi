<?php

namespace Domains\Orders\Data;

use Domains\Orders\Models\Order;
use Domains\Organizations\Data\UserData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Optional;

class OrderData extends Data
{
    public function __construct(
        public string $id,
        public Lazy|string $number,
        public Lazy|bool|Optional $is_reentry,
        public Lazy|string|Optional $priority,
        public Lazy|array|Optional $client,
        public Lazy|array|Optional $user,
        public Lazy|array|Optional $items,
        public Lazy|array|Optional $order_history,
        public Lazy|string|Optional $problem_description,
        public Lazy|string|Optional $status,
        public Lazy|array|Optional $metadata = [],
    ) {
    }

    public static function allowedRequestIncludes(): ?array
    {
        return [
            'status',
            'client',
            'user',
            'items',
            'order_history',
            'problem_description',
            'priority',
            'is_reentry',
            'number',
            'metadata',
        ];
    }

    public static function fromModel(Order $model): self
    {

        return new self(
            id: $model->id,
            status: Lazy::create(fn () => $model->status->name),
            client: Lazy::create(fn () => ClientData::fromModel($model->client)),
            user: Lazy::create(fn () => UserData::fromModel($model->user)),
            items: Lazy::create(fn () => $model->items->map(fn ($item) => ItemData::fromModel($item))),
            order_history: Lazy::create(fn () => $model->order_history),
            problem_description: Lazy::create(fn () => $model->problem_description),
            priority: Lazy::create(fn () => $model->priority),
            is_reentry: Lazy::create(fn () => $model->is_reentry),
            number: Lazy::create(fn () => $model->number),
            metadata: Lazy::create(fn () => array_filter([
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at,
            ]))
        );
    }
}
