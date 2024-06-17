<?php

namespace Domains\Orders\Data;

use Domains\Orders\Models\Item;
use Domains\Organizations\Data\OrganizationData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Optional;

class ItemData extends Data
{
    public function __construct(
        public string $id,
        public string $type,
        public string $model,
        public string $serial,
        public string $brand,
        public Lazy|array|Optional $organization,
        public Lazy|array|Optional $client,
        public Lazy|array|Optional $metadata = [],
    ) {
    }

    public static function allowedRequestIncludes(): ?array
    {
        return [
            'organization',
            'client',
            'metadata',
        ];
    }

    public static function fromModel(Item $model): self
    {
        return new self(
            id: $model->id,
            type: $model->type,
            model: $model->model,
            serial: $model->serial,
            brand: $model->brand,
            organization: Lazy::create(fn () => OrganizationData::fromModel($model->organization)),
            client: Lazy::create(fn () => ClientData::fromModel($model->client)),
            metadata: Lazy::create(fn () => array_filter([
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at,
            ]))
        );
    }
}
