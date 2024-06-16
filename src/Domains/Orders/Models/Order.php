<?php

namespace Domains\Orders\Models;

use Domains\Orders\Data\Enums\OrderStatus;
use Domains\Organizations\Models\Organization;
use Domains\Organizations\Models\User;
use Domains\Shared\Traits\FiltersNullValues;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;

class Order extends Model
{
    use FiltersNullValues,
        HasFactory,
        HasUuids,
        Searchable,
        SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'number',
        'internal_notes',
        'problem_description',
        'budget_description',
        'order_history',
        'created_at',
        'closed_at',
        'estimated_date',
        'end_of_warranty_date',
        'is_reentry',
        'priority',
        'status',
        'attachments',
        'client_id',
        'user_id',
        'organization_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $user = Auth::user();
            $organization = $user->organization;

            $lastOrder = $organization->orders()->orderBy('number', 'desc')->first();
            $nextNumber = $lastOrder ? $lastOrder->number + 1 : 1;

            $order->number = $nextNumber;
            $order->status = OrderStatus::OPEN->value;
            $order->user_id = $user->id;
            $order->organization_id = $organization->id;
        });
    }

    public function toSearchableArray()
    {
        return [
            'problem_description' => $this->problem_description,
            'budget_description' => $this->budget_description,
            'internal_notes' => $this->internal_notes,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
