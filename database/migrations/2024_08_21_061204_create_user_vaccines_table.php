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
        Schema::create('user_vaccines', function (Blueprint $table) {
            $table->id();
            $table->timestamp('schedule')->useCurrent();
            $table->unsignedMediumInteger('vaccine_center_id');
            $table->unsignedMediumInteger('user_id');
            $table->boolean('is_completed')->default(false);
            $table->index('vaccine_center_id');
            $table->index('user_id');
            $table->index('schedule');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_vaccines');
    }
};
