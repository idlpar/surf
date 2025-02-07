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
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->text('tagline')->nullable(); // Allows longer text for taglines
            $table->text('title')->nullable(); // Allows larger titles
            $table->text('subtitle')->nullable(); // Allows longer subtitles
            $table->text('link')->nullable(); // Supports long URLs
            $table->string('image')->nullable(); // Stores image path
            $table->boolean('status')->default(false)->index(); // Indexed for performance
            $table->integer('order')->default(0); // Helps manage slide order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slides');
    }
};
