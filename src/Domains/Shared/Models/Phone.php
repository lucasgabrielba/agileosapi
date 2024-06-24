<?php

namespace Domains\Shared\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use HasFactory,
        HasUuids,
        SoftDeletes;

    protected $fillable = ['phone_number'];

    public $incrementing = false;

    protected $keyType = 'string';

    public function phoneable()
    {
        return $this->morphTo();
    }
}
