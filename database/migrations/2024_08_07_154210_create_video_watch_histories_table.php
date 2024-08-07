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
        Schema::create('video_watch_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('video_id');
            $table->timestamp('watched_at');
            $table->timestamps();
            
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
    
            $table->index(['user_id', 'video_id', 'watched_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_watch_histories');
    }
};
