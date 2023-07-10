<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_market', function (Blueprint $table) {
            $table->foreignUlid('product_id')->references('id')->on('products')->cascadeOnDelete();
            $table->foreignUlid('market_id')->references('id')->on('markets')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_market');
    }
};
