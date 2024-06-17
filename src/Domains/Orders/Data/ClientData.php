<?php

namespace Domains\Orders\Data;

use Domains\Orders\Models\Client;
use Domains\Organizations\Data\OrganizationData;
use Domains\Shared\Data\AddressData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Optional;

class ClientData extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public array $phones,
        public string $document,
        public Lazy|array|Optional $organization,
        public Lazy|array|Optional $address,
    ) {
    }

    public static function allowedRequestIncludes(): ?array
    {
        return [
            'organization',
            'address',
        ];
    }

    public static function fromModel(Client $model): self
    {
        return new self(
            id: $model->id,
            name: $model->name,
            email: $model->email,
            phones: $model->phones,
            document: $model->document,
            organization: Lazy::create(fn () => OrganizationData::fromModel($model->organization)),
            address: Lazy::create(fn () => AddressData::collection($model->address)),
        );
    }
}
