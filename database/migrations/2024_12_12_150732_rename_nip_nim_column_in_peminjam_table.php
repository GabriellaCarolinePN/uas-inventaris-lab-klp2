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
        Schema::table('peminjam', function (Blueprint $table) {
            $table->renameColumn('nip/nim', 'nip_nim');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjam', function (Blueprint $table) {
            $table->renameColumn('nip_nim', 'nip/nim');
        });
    }
};
