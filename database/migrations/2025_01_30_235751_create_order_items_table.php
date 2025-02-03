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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('variant_id')->nullable();

            // Product details at time of purchase
            $table->string('product_name');
            $table->string('sku');
            $table->decimal('price', 8, 2);
            $table->decimal('original_price', 8, 2)->nullable();
            $table->integer('quantity');

            // Product specifications
            $table->json('attributes')->nullable(); // Size, color, etc.
            $table->decimal('weight', 8, 2)->nullable();
            $table->decimal('tax', 8, 2)->default(0);

            // Relationships
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('set null');
//
//            $table->foreign('variant_id')
//                ->references('id')
//                ->on('product_variants')
//                ->onDelete('set null');

            // Indexes
            $table->index('order_id');
            $table->index('product_id');
            $table->index('sku');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
