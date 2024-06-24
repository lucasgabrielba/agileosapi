<?php

namespace Domains\Orders\Models;

use Domains\Organizations\Models\Organization;
use Domains\Shared\Models\Address;
use Domains\Shared\Models\Phone;
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
        'document',
        'organization_id',
        'address_id',
    ];

    public function toSearchableArray()
    {
        $array = $this->toArray();

        $array['phones'] = $this->phones()
            ->select('phone_number')
            ->get()
            ->toArray();

        return [
            'name' => $this->name,
            'phones' => $array['phones'],
            'document' => $this->document,
        ];
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function address()
    {
        return $this->hasMany(Address::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }
}
