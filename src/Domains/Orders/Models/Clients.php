<?php

namespace Domains\Orders\Models;

use Domains\Organizations\Models\Organization;
use Domains\Shared\Traits\FiltersNullValues;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Client extends Model
{
    use FiltersNullValues,
        HasFactory,
        HasUuids,
        Searchable,
        SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'email',
        'phones',
        'document',
        'organization_id',
    ];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'phones' => $this->phones,
            'document' => $this->document,
        ];
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
