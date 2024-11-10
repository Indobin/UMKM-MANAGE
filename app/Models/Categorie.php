<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

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
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
