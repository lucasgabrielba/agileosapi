<?php

namespace Domains\Shared\Data;

use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Optional;

class AddressData extends Data
{
    public function __construct(
        public ?string $id,
        public Lazy|string|Optional $street,
        public Lazy|string|Optional $number,
        public Lazy|string|Optional $complement,
        public Lazy|string|Optional $district,
        public Lazy|string|Optional $city,
        public Lazy|string|Optional $state,
        public Lazy|string|Optional $country,
        public Lazy|string|Optional $postal_code,
        public Lazy|string|Optional $reference,
        public Lazy|array|Optional $metadata,
    ) {
    }

    public static function allowedRequestIncludes(): ?array
    {
        return [
            'street',
            'number',
            'complement',
            'district',
            'city',
            'state',
            'country',
            'postal_code',
            'reference',
            'metadata',
        ];
    }

    public static function fromModel(Model $model): self
    {
        return new self(
            id: $model->id,
            street: Lazy::create(fn () => $model->street),
            number: Lazy::create(fn () => $model->number),
            complement: Lazy::create(fn () => $model->complement),
            district: Lazy::create(fn () => $model->district),
            city: Lazy::create(fn () => $model->city),
            state: Lazy::create(fn () => $model->state),
            country: Lazy::create(fn () => $model->country),
            postal_code: Lazy::create(fn () => $model->postal_code),
            reference: Lazy::create(fn () => $model->reference),
            metadata: Lazy::create(fn () => array_filter([
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at,
            ])),
        );
    }
}
