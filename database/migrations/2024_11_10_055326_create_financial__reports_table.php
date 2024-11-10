<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('financial__reports', function (Blueprint $table) {
            $table->id();
            $table->integer('bulan')->comment('Bulan laporan (1-12)');
            $table->integer('tahun')->comment('Tahun laporan');
            $table->decimal('total_pemasukan', 15, 2)->default(0)->comment('Total pemasukan');
            $table->decimal('total_pengeluaran', 15, 2)->default(0)->comment('Total pengeluaran');
            $table->decimal('laba', 15, 2)->default(0)->comment('Keuntungan bulan tersebut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial__reports');
    }
};
