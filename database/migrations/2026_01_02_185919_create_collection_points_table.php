<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('collection_points', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();

            $table
                ->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');

            $table->string('status')->index();
            $table->string('category')->index();

            $table->string('address');
            $table->string('city');
            $table->string('state', 2);
            $table->string('zip_code', 20);

            $table->text('description')->nullable();

            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();

            $table->text('rejection_reason')->nullable();

            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('collection_points', function (Blueprint $table) {
            $table->dropForeign(['user_id']);

            $table->dropIndex(['status']);
            $table->dropIndex(['category']);
        });

        Schema::dropIfExists('collection_points');
    }
};
