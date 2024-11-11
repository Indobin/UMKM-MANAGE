<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
        'timestamps',
    ];
      /**
     * Relasi ke model Category
     * Satu transaksi memiliki satu kategori
     */
    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }
}