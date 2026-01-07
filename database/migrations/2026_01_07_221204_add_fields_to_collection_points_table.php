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
        Schema::table('collection_points', function (Blueprint $table) {
            $table->timestamp('contested_at')->nullable()->after('rejected_at');
            $table->timestamp('contestation_deadline')->nullable()->after('contested_at');
            $table->timestamp('reevaluated_at')->nullable()->after('contestation_deadline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('collection_points', function (Blueprint $table) {
            $table->dropColumn(['contested_at', 'contestation_deadline', 'reevaluated_at']);
        });
    }
};
