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
        Schema::create('source_codes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('thumbnail');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('categories')->nullable();
            $table->string('technologies')->nullable();
            $table->string('price')->nullable();
            $table->enum('status', [0,1])->default(0);
            $table->string('file_url')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('source_codes');
    }
};
