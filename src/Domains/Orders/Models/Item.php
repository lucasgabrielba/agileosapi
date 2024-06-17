<?php

namespace Domains\Orders\Models;

use Domains\Organizations\Models\Organization;
use Domains\Shared\Traits\FiltersNullValues;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            $item->organization_id = Auth::user()->organization->id;
        });
    }

    public function toSearchableArray()
    {
        return [
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
