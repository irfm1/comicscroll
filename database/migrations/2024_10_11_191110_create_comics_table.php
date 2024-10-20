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
        Schema::create('comics', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title')->default('some title');
            $table->string('alt');
            $table->string('author')->default('some author');
            $table->string('publisher')->default('some publisher');
            $table->string('genre')->default('some genre');
            $table->string('type')->default('some type');
            $table->string('description')->default('some description');
            $table->string('status')->default('ongoing');
            $table->string('url');
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comics');
    }
};
