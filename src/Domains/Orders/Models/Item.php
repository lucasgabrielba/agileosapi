<?php

namespace Domains\Orders\Models;

use Domains\Organizations\Models\Organization;
use Domains\Shared\Traits\FiltersNullValues;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Item extends Model
{
    use FiltersNullValues,
        HasFactory,
        HasUuids,
        Searchable,
        SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'type',
        'model',
        'serial',
        'brand',
        'client_id',
        'organization_id',
    ];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'model' => $this->model,
            'serial' => $this->serial,
            'brand' => $this->brand,
        ];
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
