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
        Schema::create('order_details', function (Blueprint $table) {



            $table->uuid('orderId');
            $table->foreign('orderId')->references('orderId')->on('orders')->onDelete('cascade');

            $table->uuid('productId');
            $table->foreign('productId')->references('productId')->on('products')->onDelete('cascade');

            $table->primary(['orderId', 'productId']);

            $table->integer('quantity');
            $table->decimal('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
