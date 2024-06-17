<?php

namespace Domains\Organizations\Data;

use Domains\Organizations\Models\Organization;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

class OrganizationData extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public Lazy|array $metadata = [],
    ) {
    }

    public static function fromModel(Organization $model): self
    {
        return new self(
            id: $model->id,
            name: $model->name,
            metadata: Lazy::create(fn () => array_filter([
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at,
            ]))
        );
    }
}
