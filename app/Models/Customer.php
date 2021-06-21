<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';

    function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
       return $this->belongsTo(City::class);
    }

}
