<?php

namespace Domains\Organizations\Data;

use Domains\Shared\Data\AddressData;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Optional;

class OrganizationData extends Data
{
    public function __construct(
        public ?string $id,
        public Lazy|string|Optional $status,
        public Lazy|array|Optional $attributes,
        public Lazy|AddressData $address,
        public Lazy|array|Optional $metadata,
    ) {
    }

    public static function allowedRequestIncludes(): ?array
    {
        return [
            'status',
            'attributes',
            'address',
            'metadata',
        ];
    }

    public static function fromModel(Model $model): self
    {
        return new self(
            id: $model->id,
            status: Lazy::create(fn () => $model->status),
            address: Lazy::create(
                fn () => AddressData::from($model->address)->include('attributes')
            ),
            attributes: Lazy::create(fn () => array_filter([
                'name' => $model->name,
                'phones' => $model->phones,
                'email' => $model->email,
            ])),
            metadata: Lazy::create(fn () => array_filter([
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at,
            ])),
        );
    }
}
