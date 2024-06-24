<?php

namespace Domains\Shared\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class ListDataHelper
{
    /**
     * @var array|string[]
     *
     * @example include, search, order, per_page, page, select
     */
    protected array $keyWords = [
        'include',
        'search',
        'order',
        'per_page',
        'page',
        'select',
    ];

    protected array $parameters = [];

    protected string $modelClass;

    public function __construct(
        protected Model $model,
        protected ?Model $relationshipModel = null,
    ) {
        $this->modelClass = get_class($model);

        if (property_exists($this->modelClass, 'mappingAttributes') && is_array($this->modelClass::$mappingAttributes)) {
            $this->parameters = $this->modelClass::$mappingAttributes;
        }
    }

    public function list(array $filter, array $selectAttributes = []): LengthAwarePaginator
    {
        $query = $this->startQuery();

        // Handle includes (eager loading)
        if (isset($filter['include'])) {
            $this->handleIncludes($query, $filter['include']);
        }

        // Handle search in Laravel Scout
        if (isset($filter['search'])) {
            $this->searchInScout($query, $filter['search']);
        }

        // Handle additional filters like ?email=john.doe@example.com
        $this->searchBySpecificFields($query, $filter);

        // Handle select: &select=name,email,document
        if (isset($filter['select'])) {
            $this->handleSelect($query, $filter['select']);
        }

        // Handle order: &order=-created_at,status
        if (isset($filter['order'])) {
            $this->orderRows($query, $filter['order']);
        }

        // Handle pagination
        $perPage = $filter['per_page'] ?? 15;

        return $query->paginate($perPage);
    }

    private function startQuery()
    {
        if (! $this->relationshipModel) {
            return $this->model::query();
        }

        // Determine the relationship name based on the model class name
        $relationshipBaseName = Str::plural(Str::snake(class_basename($this->model)));
        $relationshipAlternativeName = 'all'.Str::camel($relationshipBaseName);

        // Check if, for example, "allAccounts" relationship exists
        if (method_exists($this->relationshipModel, $relationshipAlternativeName)) {
            return $this->relationshipModel->$relationshipAlternativeName();
        }

        // Check if, for example, "accounts" relationship exists
        if (method_exists($this->relationshipModel, $relationshipBaseName)) {
            return $this->relationshipModel->$relationshipBaseName();
        }
    }

    protected function mapParameter(string $param)
    {
        if (Str::contains($param, '.')) {
            $param = explode('.', $param);

            return $this->parameters[$param[1]] ?? $param[1];
        }

        return $this->parameters[$param] ?? $param;
    }

    protected function searchInScout($query, string $searchQuery): void
    {
        if (! method_exists($this->modelClass, 'search')) {
            return;
        }

        if ($this->relationshipModel) {
            $relation_basename_id = Str::lower(class_basename($this->relationshipModel)).'_id';
            $relation_id = $this->relationshipModel->id;

            $findBySearch = $this->model::search($searchQuery)
                ->where($relation_basename_id, $relation_id)
                ->raw();
        } else {
            $findBySearch = $this->model::search($searchQuery)->raw();
        }

        $idsFound = array_column($findBySearch['hits'], 'id');

        $query->whereIn('id', $idsFound);
    }

    protected function searchBySpecificFields($query, array $filter): void
    {
        foreach ($filter as $key => $value) {
            if (in_array($key, $this->keyWords)) {
                continue;
            }

            if (! is_array($value) && preg_match('/([^(]+)\(([^,]+),?([^,]*)\)/', $value, $matches)) {
                $this->handleSpecialCases($query, $matches, $key);

                continue;
            }

            $this->handleDefaultCase($query, $value, $key);
        }
    }

    protected function handleSpecialCases($query, $matches, $key): void
    {
        switch ($matches[1]) {
            case 'lt':
                $query->where($this->mapParameter($key), '<', $matches[2]);
                break;
            case 'gt':
                $query->where($this->mapParameter($key), '>', $matches[2]);
                break;
            case 'between':
                $query->whereBetween($this->mapParameter($key), [$matches[2], $matches[3]]);
                break;
            case 'in':
                $query->whereIn($this->mapParameter($key), explode(',', $matches[2]));
                break;
            default:
                break;
        }
    }

    protected function handleDefaultCase($query, $value, $key): void
    {
        $clause = is_array($value) ? $value[0] : 'LIKE';
        $value = is_array($value) ? $value[1] : $value.'%';

        $query->where($this->mapParameter($key), $clause, $value);
    }

    protected function selectFields($query, array $selectAttributes): void
    {
        foreach ($selectAttributes as $selectAttribute) {
            $query->addSelect($this->mapParameter($selectAttribute));
        }
    }

    protected function orderRows($query, string $orderQuery): void
    {
        $orders = explode(',', $orderQuery);
        foreach ($orders as $order) {
            $direction = Str::startsWith($order, '-') ? 'desc' : 'asc';
            $query->orderBy($this->mapParameter(ltrim($order, '-')), $direction);
        }
    }

    protected function handleIncludes($query, $includes)
    {
        $relationships = explode(',', $includes);
        $query->with($relationships);
    }

    protected function handleSelect($query, $select)
    {
        $selectAttributes = explode(',', $select);
        $this->selectFields($query, $selectAttributes);
    }
}
