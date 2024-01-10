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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_pelanggan');
            $table->string('no_antrian')->unique();
            $table->string('plat_nomor');
            $table->string('merk');
            $table->enum('status',['menunggu','proses','selesai'])->default('menunggu');
            $table->string('keterangan',500);
            $table->timestamps();
            $table->foreign('id_pelanggan')
                    ->references('id')
                    ->on('pelanggan')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
