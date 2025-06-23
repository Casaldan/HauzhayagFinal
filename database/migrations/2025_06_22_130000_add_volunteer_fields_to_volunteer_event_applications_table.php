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
            if (!Schema::hasColumn('volunteer_event_applications', 'volunteer_description')) {
                $table->text('volunteer_description')->nullable()->after('application_reason');
            }
            if (!Schema::hasColumn('volunteer_event_applications', 'valid_id_path')) {
                $table->string('valid_id_path')->nullable()->after('volunteer_description');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('volunteer_event_applications', function (Blueprint $table) {
            if (Schema::hasColumn('volunteer_event_applications', 'volunteer_description')) {
                $table->dropColumn('volunteer_description');
            }
            if (Schema::hasColumn('volunteer_event_applications', 'valid_id_path')) {
                $table->dropColumn('valid_id_path');
            }
        });
    }
};
