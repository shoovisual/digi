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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('serial')->unique();
            $table->string('product_short')->nullable();
            $table->text('description')->nullable();
            $table->json('product_images')->nullable();
            $table->json('product_videos')->nullable();
            $table->json('product_documents')->nullable();
            $table->json('specifications')->nullable();
            $table->json('features')->nullable();
            $table->json('reviews')->nullable();
            $table->json('ratings')->nullable();
            $table->foreignId('category_id')->constrained('categories');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
