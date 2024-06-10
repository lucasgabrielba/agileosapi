<?php

namespace Domains\Shared\Models;

use Domains\Organizations\Models\Organization;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\LaravelData\WithData;

class Address extends Model
{
    use HasFactory,
        HasUuids,
        SoftDeletes,
        WithData;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'street',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'country',
        'postal_code',
        'reference',
        'organization_id',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
