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
        Schema::create('master_kecamatan', function (Blueprint $table) {
            $table->id();
            $table->string('kecamatan')->nullable();
            $table->string('wilkerstat_kecamatan_id')->nullable()->unique();
        });

        Schema::create('master_deskel', function (Blueprint $table) {
            $table->id();
            $table->string('desa_kelurahan')->nullable();
            $table->string('wilkerstat_kecamatan_id')->nullable();
            $table->string('desa_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
