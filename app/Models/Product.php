<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
     protected $guarded = [
        'id',
        'timestamps',
    ];
    
    public function transaction_detail(): HasMany
    {
        return $this->hasMany(TransactionProductDetail::class);
    }
}
