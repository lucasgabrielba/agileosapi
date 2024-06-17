<?php

namespace Domains\Shared\Data;

use Domains\Orders\Data\ClientData;
use Domains\Organizations\Data\OrganizationData;
use Domains\Shared\Models\Address;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Optional;

class AddressData extends Data
{
    public function __construct(
        public string $id,
        public string $street,
        public string $number,
        public string $complement,
        public string $district,
        public string $city,
        public string $state,
        public string $country,
        public string $postal_code,
        public string $reference,
        public Lazy|array|Optional $organization,
        public Lazy|array|Optional $client,
    ) {
    }

    public static function allowedRequestIncludes(): ?array
    {
        return [
            'organization',
            'client',
        ];
    }

    public static function fromModel(Address $model): self
    {
        return new self(
            id: $model->id,
            street: $model->street,
            number: $model->number,
            complement: $model->complement,
            district: $model->district,
            city: $model->city,
            state: $model->state,
            country: $model->country,
            postal_code: $model->postal_code,
            reference: $model->reference,
            organization: Lazy::create(fn () => OrganizationData::fromModel($model->organization)),
            client: Lazy::create(fn () => ClientData::fromModel($model->client)),
        );
    }
}
