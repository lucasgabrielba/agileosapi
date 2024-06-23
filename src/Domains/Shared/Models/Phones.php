<?php

namespace Domains\Shared\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = ['phone_number'];

    public function phoneable()
    {
        return $this->morphTo();
    }
}
