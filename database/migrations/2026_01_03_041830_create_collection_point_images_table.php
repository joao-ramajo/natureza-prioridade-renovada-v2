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
        Schema::create('collection_point_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_point_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('collection_point_images', function (Blueprint $table) {
            $table->dropForeign(['collection_point_id']);
        });

        Schema::dropIfExists('collection_point_images');
    }
};
