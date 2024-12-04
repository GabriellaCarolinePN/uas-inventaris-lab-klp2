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
        Schema::create('inventaris', function (Blueprint $table) {
                $table->id();
                $table->string('kode_alat')->unique();
                $table->string('nama_alat');
                $table->text('deskripsi')->nullable();
                $table->integer('jumlah');
                $table->enum('status_ketersediaan', ['tersedia', 'tidak tersedia']);
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};
