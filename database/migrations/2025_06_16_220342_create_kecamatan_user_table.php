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
        Schema::create('user_kecamatan', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('wilkerstat_kecamatan_id'); // sesuai field relasi di master_kecamatan

            $table->foreign('wilkerstat_kecamatan_id')
                ->references('wilkerstat_kecamatan_id')
                ->on('master_kecamatan')
                ->onDelete('cascade');

            $table->primary(['user_id', 'wilkerstat_kecamatan_id']); // composite key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kecamatan_user');
    }
};
