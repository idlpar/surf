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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('user_id');
            $table->decimal('subtotal', 8, 2)->default(0);
            $table->decimal('discount', 8, 2)->default(0);
            $table->decimal('tax', 8, 2)->default(0);
            $table->decimal('shipping_cost', 8, 2)->default(0);
            $table->decimal('total', 8, 2)->default(0);
            $table->char('currency_code', 3)->default('BDT');

            // Address handling
            $table->json('billing_address');
            $table->json('shipping_address')->nullable();
            $table->boolean('is_shipping_different')->default(false);

            // Payment information
            $table->string('payment_method');
            $table->string('payment_status')->default('unpaid');
            $table->string('payment_id')->nullable();

            // Status tracking
            $table->enum('status', [
                'pending',
                'confirmed',
                'processing',
                'shipped',
                'delivered',
                'canceled',
                'refunded'
            ])->default('pending');

            // Timestamps
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamps();

            // Customer notes
            $table->text('notes')->nullable();

            // Relationships
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // Indexes
            $table->index('status');
            $table->index('created_at');
            $table->index('order_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
