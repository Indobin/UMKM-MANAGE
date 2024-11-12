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
        Schema::create('receinvables', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->decimal('jumlah',15, 2);
            $table->date('tanggal_jatuh_tempo');
            $table->enum('status',['Belum Terkumpul', 'Terkumpul']);
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receinvables');
    }
};
