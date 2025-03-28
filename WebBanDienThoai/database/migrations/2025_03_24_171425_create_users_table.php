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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('userId')->primary(); 
            $table->string('userName')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phoneNumber')->unique();
            $table->string('address')->default('');
            $table->boolean('isDeleted')->default(false);
            $table->uuid('roleId');
            $table->foreign('roleId')->references('roleId')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
