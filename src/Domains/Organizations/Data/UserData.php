<?php

namespace Domains\Organizations\Data;

use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Optional;

class UserData extends Data
{
    public function __construct(
        public ?string $id,
        public Lazy|string|Optional $status,
        public Lazy|array|Optional $attributes,
        public Lazy|OrganizationData $organization,
        public Lazy|array|Optional $metadata,
    ) {
    }

    public static function allowedRequestIncludes(): ?array
    {
        return [
            'status',
            'attributes',
            'organization',
            'metadata',
        ];
    }

    public static function fromModel(Model $model): self
    {
        return new self(
            id: $model->id,
            status: Lazy::create(fn () => $model->status),
            attributes: Lazy::create(fn () => array_filter([
                'name' => $model->name,
                'email' => $model->email,
            ])),
            organization: Lazy::create(
                fn () => OrganizationData::from($model->organization)->include('attributes')
            ),
            metadata: Lazy::create(fn () => array_filter([
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at,
            ])),
        );
    }
}
