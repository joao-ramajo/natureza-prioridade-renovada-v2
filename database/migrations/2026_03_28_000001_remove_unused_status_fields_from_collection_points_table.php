<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('collection_points', function (Blueprint $table) {
            $table->dropColumn([
                'approved_at',
                'rejected_at',
                'contested_at',
                'contestation_deadline',
                'reevaluated_at',
                'rejection_reason',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('collection_points', function (Blueprint $table) {
            $table->timestamp('approved_at')->nullable()->after('lng');
            $table->timestamp('rejected_at')->nullable()->after('approved_at');
            $table->timestamp('contested_at')->nullable()->after('rejected_at');
            $table->timestamp('contestation_deadline')->nullable()->after('contested_at');
            $table->timestamp('reevaluated_at')->nullable()->after('contestation_deadline');
            $table->text('rejection_reason')->nullable()->after('lng');
        });
    }
};
