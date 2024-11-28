<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionProduct extends Model
{
    protected $guarded = [
        'id',
        'timestamps',
    ];
    public function details()
    {
        return $this->hasMany(TransactionProductDetail::class, 'transaction_id');
    }
}
