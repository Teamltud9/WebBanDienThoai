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
        Schema::create('image_products', function (Blueprint $table) {
            $table->uuid('imageId')->primary(); 
            $table->string('imagePath');
            $table->uuid('productId');
            $table->foreign('productId')->references('productId')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_products');
    }
};
