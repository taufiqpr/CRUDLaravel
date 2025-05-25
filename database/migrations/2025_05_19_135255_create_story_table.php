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
        Schema::create('story', function (Blueprint $table) {
        $table->id();
        $table->string('text_ksa');
        $table->string('text_idn');
        $table->string('audio');
        $table->unsignedBigInteger('stories_id');
        $table->timestamps();

        $table->foreign('stories_id')->references('id')->on('stories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story');
    }
};
