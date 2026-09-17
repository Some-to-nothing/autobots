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
    Schema::create('produk', function (Blueprint $table) {
        $table->string('kode', 20)->primary(); // kode produk, sesuai ERD soal
        $table->string('nama', 50);
        $table->string('tipe', 50);
        $table->string('jenis', 50);
        $table->string('kategori', 50); // Mesin, Kelistrikan, Kaki-kaki, dst
        $table->string('brand', 50)->nullable();
        $table->string('kompatibilitas_kendaraan', 100)->nullable();
        $table->bigInteger('harga');
        $table->integer('stok');
        $table->text('gambar')->nullable();
        $table->enum('status_approve', ['pending', 'approved', 'rejected'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
