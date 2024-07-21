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
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->String('image');
            $table->String('bgimage');
            $table->String('name')->nullable();
            $table->String('uname')->unique();
            $table->Text('desc',15000)->nullable();
            $table->boolean('IsActive')->default(1);
            $table->Integer('subscription')->default(0);
            $table->Integer('Userid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channels');
    }
};
