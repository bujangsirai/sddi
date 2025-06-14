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
        Schema::create('monitoring_deskel', function (Blueprint $table) {
            $table->id();


            $table->foreignId('master_deskel_id')
                ->constrained('master_deskel')
                ->onDelete('no action');

            $table->decimal('progress_persen', 5, 2); // persentase progress
            $table->json('detail_progress')->nullable(); // detail progress dalam format JSON
            $table->text('catatan')->nullable(); // catatan selama monitoring
            $table->timestamps(); // created_at dan updated_at

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ProgressDeskel');
    }
};
