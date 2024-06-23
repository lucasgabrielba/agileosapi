<?php

namespace Domains\Organizations\Models;

use Domains\Orders\Models\Client;
use Domains\Orders\Models\Item;
use Domains\Orders\Models\Order;
use Domains\Organizations\Data\Enums\OrganizationStatus;
use Domains\Shared\Models\Address;
use Domains\Shared\Models\Phone;
use Domains\Shared\Traits\FiltersNullValues;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Organization extends Model
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
        'status',
        'preferences',
        'brand',
    ];

    protected $with = ['phones'];

    protected $casts = [
        'preferences' => 'array',
        'brand' => 'array',
        'abilities' => 'array',
        'status' => OrganizationStatus::class,
    ];

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'document' => $this->document,
        ];
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
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
