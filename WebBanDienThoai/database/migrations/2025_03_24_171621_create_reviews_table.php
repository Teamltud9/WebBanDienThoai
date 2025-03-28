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
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('reviewId')->primary(); 
            $table->string('content');
            $table->boolean('isDeleted')->default(false);
            $table->uuid('userId');
            $table->foreign('userId')->references('userId')->on('users')->onDelete('cascade');

            $table->uuid('productId');
            $table->foreign('productId')->references('productId')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
