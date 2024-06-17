<?php

namespace Domains\Organizations\Data;

use Domains\Organizations\Models\User;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Optional;

class UserData extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public Lazy|string|Optional $status,
        public Lazy|array|Optional $organization,
        public Lazy|array|Optional $roles,
        public Lazy|array|Optional $permissions,
        public Lazy|array|Optional $metadata = [],
    ) {
    }

    public static function allowedRequestIncludes(): ?array
    {
        return [
            'status',
            'organization',
            'roles',
            'permissions',
            'metadata',
        ];
    }

    public static function fromModel(User $model): self
    {
        return new self(
            id: $model->id,
            name: $model->name,
            email: $model->email,
            status: Lazy::create(fn () => $model->status),
            organization: Lazy::create(fn () => OrganizationData::fromModel($model->organization)),
            roles: Lazy::create(fn () => $model->roles->pluck('name')->toArray()),
            permissions: Lazy::create(fn () => $model->permissions->pluck('name')->toArray()),
            metadata: Lazy::create(fn () => array_filter([
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at,
            ]))
        );
    }
}
