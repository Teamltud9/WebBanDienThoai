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
            $table->uuid('productId')->primary();;
            $table->string('productName');
            $table->decimal('productPrice', 15, 2);
            $table->string('description');
            $table->string('CPU');
            $table->integer('RAM');
            $table->string('storage');
            $table->string('display');
            $table->integer('battery');
            $table->boolean('isDeleted')->default(false);
            $table->uuid('brandId');
            $table->foreign('brandId')->references('brandId')->on('brands')->onDelete('cascade');
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
