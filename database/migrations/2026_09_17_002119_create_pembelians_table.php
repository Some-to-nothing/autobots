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
    Schema::create('pembelian', function (Blueprint $table) {
        $table->id('kode_pembelian');
        $table->string('kode_produk', 20);
        $table->integer('banyak');
        $table->bigInteger('bayar');
        $table->foreignId('kode_pembeli')->constrained('users')->cascadeOnDelete();
        $table->enum('status', ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('pending');
        $table->timestamps();

        $table->foreign('kode_produk')->references('kode')->on('produk')->cascadeOnUpdate();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
