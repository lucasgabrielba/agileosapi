<?php

namespace Domains\Organizations\Models;

use Domains\Shared\Models\Address;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Organization extends Model
{
    use HasFactory,
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
        'status',
    ];

    protected $casts = [
        'phones' => 'array',
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

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
