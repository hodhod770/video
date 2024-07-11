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
        Schema::create('videws', function (Blueprint $table) {
            $table->id();
            $table->String('name')->nullable();
            $table->integer('type')->nullable();
            $table->String('video')->nullable();
            $table->String('image')->nullable();
            $table->String('uname')->unique();
            $table->Text('summary',5000)->nullable();
            $table->Text('description',15000)->nullable();
            $table->Text('kayword',15000)->nullable();
            $table->integer('watch_num')->default(0);
            $table->integer('like_num')->default(0);
            $table->boolean('IsActive')->default(1);
            $table->integer('id_channal');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videws');
    }
};
