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
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('category_id');
            $table->uuid('users_id');
            $table->string('name');
            $table->string('description');
            $table->integer('price');
            $table->string('image');
            $table->string('stock');
            $table->string('status');
            $table->timestamps();

            $table->foreign('category_id')
            ->references('id')
            ->on('categories');
            
            $table->foreign('users_id')
            ->references('id')
            ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
