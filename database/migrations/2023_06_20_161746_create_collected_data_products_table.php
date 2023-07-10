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
        Schema::create('collected_data_products', function (Blueprint $table) {
            $table->foreignUlid('collected_data_id')->references('id')->on('collected_data');
            $table->foreignUlid('product_id')->references('id')->on('products');
            $table->decimal('price', 9);
            $table->decimal('qty', 9);
            $table->unique(['collected_data_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collected_data_products');
    }
};
