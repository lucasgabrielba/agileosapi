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
        'status',
        'items',
        'problem_description',
        'budget_description',
        'internal_notes',
        'order_history',
        'closed_at',
        'estimated_date',
        'end_of_warranty_date',
        'is_reentry',
        'priority',
        'attachments',
        'client_id',
        'user_id',
        'organization_id',
    ];

    protected $casts = [
        'items' => 'array',
        'order_history' => 'array',
        'attachments' => 'array',
        'status' => OrderStatus::class,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $organization = Organization::find($order->organization_id);
            $user = User::find($order->user_id);

            $lastOrder = $organization->orders()->orderBy('number', 'desc')->first();
            $nextNumber = $lastOrder ? $lastOrder->number + 1 : 1;

            $order->organization_id = $organization->id;
            $order->user_id = $user->id;

            $order->number = $nextNumber;
            $order->status = OrderStatus::OPEN;
            $order->order_history = [
                [
                    'message' => 'Ordem de Serviço aberta',
                    'author' => $user->name,
                    'date' => now()->toDateTimeString(),
                ],
            ];

            if ($order->is_reentry) {
                $order->status = OrderStatus::REENTRY;
            }
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

    public function getItemsAttribute($value)
    {
        $itemIds = json_decode($this->attributes['items'], true);

        if (is_array($itemIds)) {
            return Item::whereIn('id', $itemIds)
                ->select('id', 'brand', 'model', 'serial')
                ->get();
        }

        return collect();
    }
}
