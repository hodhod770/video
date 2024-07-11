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
        Schema::create('what_user_feels', function (Blueprint $table) {
            $table->id();
            $table->integer('id_v')->default(0);
            $table->integer('id_user')->default(0);  
            $table->integer('feel')->default(0);  //0=no feel  1=like 2=dislike
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('what_user_feels');
    }
};
