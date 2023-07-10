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
        Schema::create('cross_data', function (Blueprint $table) {
            $table->ulid('id')->index();
            $table->foreignUlid('market_id')->references('id')->on('markets');
            $table->foreignUlid('product_id')->references('id')->on('products');
            $table->foreignUlid('collected_data_id')->references('id')->on('collected_data');
            $table->decimal('price', 9);
            $table->decimal('qty', 9);
            $table->timestamp('updated_at');
            $table->unique(['market_id','product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cross_data');
    }
};
