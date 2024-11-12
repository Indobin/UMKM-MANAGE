<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class categorie extends Model
{
    // use HasFactory;

    protected $fillable = [
        'kategori',
    ]; 

    /**
     * Relasi ke model Transaction
     * Satu kategori bisa memiliki banyak transaksi
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
