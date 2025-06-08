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
        Schema::table('volunteer_event_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('volunteer_event_applications', 'tracking_code')) {
                $table->string('tracking_code')->unique()->nullable()->after('application_reason');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('volunteer_event_applications', function (Blueprint $table) {
            if (Schema::hasColumn('volunteer_event_applications', 'tracking_code')) {
                $table->dropColumn('tracking_code');
            }
        });
    }
};
