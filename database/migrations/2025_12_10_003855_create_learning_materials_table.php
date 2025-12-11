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
        Schema::create('learning_materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('type', ['pendahuluan', 'materi', 'latihan', 'evaluasi']);
            $table->integer('order')->default(0);
            $table->longText('content');
            $table->text('description')->nullable();
            $table->string('math_symbols')->nullable(); // JSON string for math symbols
            $table->text('references')->nullable(); // JSON string for references
            $table->boolean('is_published')->default(false);
            $table->integer('min_score')->default(75); // Minimum score to pass
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_materials');
    }
};
