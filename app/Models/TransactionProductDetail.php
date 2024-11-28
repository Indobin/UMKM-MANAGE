<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionProductDetail extends Model
{
    protected $guarded = [
        'id',
        'timestamps',
    ];
    protected static function booted()
    {
        static::saved(function ($detail) {
            $product = $detail->product;
            if ($product) {
                $product->decrement('stok', $detail->jumlah);
            }
        });
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function transactionProduct()
    {
        return $this->belongsTo(TransactionProduct::class, 'transaction_id');
    }
}
