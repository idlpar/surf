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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            // Address type (billing/shipping/etc)
            $table->enum('type', ['billing', 'shipping', 'both'])->default('shipping');

            // Address details
            $table->string('name');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('locality')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('country_code', 2); // ISO 3166-1 alpha-2
            $table->string('company')->nullable();

            // Additional fields
            $table->boolean('is_default')->default(false);
            $table->json('custom_attributes')->nullable(); // For special requirements

            // Relationships
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // Indexes
            $table->index('user_id');
            $table->index('type');
            $table->index('is_default');
            $table->index('postal_code');

            $table->timestamps();
            $table->softDeletes(); // For archiving addresses instead of permanent deletion
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
