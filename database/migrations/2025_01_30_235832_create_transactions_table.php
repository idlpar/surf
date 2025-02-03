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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');

            // Payment details
            $table->string('gateway')->comment('Stripe, PayPal, etc.');
            $table->string('transaction_id')->unique()->comment('Gateway transaction ID');
            $table->decimal('amount', 10, 2);
            $table->char('currency_code', 3)->default('USD');
            $table->decimal('fee', 10, 2)->default(0)->comment('Processing fee');

            // Status tracking
            $table->enum('status', [
                'pending',
                'completed',
                'failed',
                'refunded',
                'partially_refunded',
                'disputed',
                'canceled'
            ])->default('pending');

            // Payment method details
            $table->string('payment_method')->nullable()->comment('card, paypal, etc.');
            $table->string('card_last4')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('payment_method_id')->nullable()->comment('Gateway payment method ID');

            // Timestamps
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Error handling
            $table->text('failure_reason')->nullable();
            $table->string('error_code')->nullable();

            // Relationships
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // Indexes
            $table->index('transaction_id');
            $table->index('status');
            $table->index('processed_at');
            $table->index(['user_id', 'gateway']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
