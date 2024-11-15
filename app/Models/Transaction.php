<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    public function category(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'idkategori');
    }
    public function scopePemasukan($query)
    {
        return $query->where('pemasukan', true);
    }
}
