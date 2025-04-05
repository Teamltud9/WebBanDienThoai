<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('previews', function (Blueprint $table) {
            $table->uuid('previewId')->primary();
            $table->text('content');
            $table->uuid('userId');
            $table->uuid('productId');
            $table->boolean('isDeleted')->default(false);
            $table->timestamps();
            
            $table->foreign('userId')->references('userId')->on('users');
            $table->foreign('productId')->references('productId')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('previews');
    }
};
