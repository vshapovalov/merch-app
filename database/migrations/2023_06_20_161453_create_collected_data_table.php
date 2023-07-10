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
        Schema::create('collected_data', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->timestamp('collected_at');
            $table->string('description', 100);
            $table->foreignUlid('market_id')->references('id')->on('markets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collected_data');
    }
};
