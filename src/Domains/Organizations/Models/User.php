<?php

namespace Domains\Organizations\Models;

use Domains\Shared\Traits\FiltersNullValues;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use FiltersNullValues,
        HasApiTokens,
        HasFactory,
        HasRoles,
        HasUuids,
        Notifiable,
        SoftDeletes;

    protected $guard_name = 'api';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'organization_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
