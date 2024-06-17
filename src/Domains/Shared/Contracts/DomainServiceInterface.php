<?php

namespace Domains\Shared\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface DomainServiceInterface
{
    public function list(string $parent, array $filters): LengthAwarePaginator;

    public function get(string $id): Model;

    public function create(string $parent, array $data);

    public function update(string $id, array $data): ?Model;

    public function destroy(string $id): void;
}
