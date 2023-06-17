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
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->unsignedBigInteger('author');
            $table->unsignedBigInteger('category');
            $table->string('image');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('author')->references('id')->on('authors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('category')->references('id')->on('categories')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
