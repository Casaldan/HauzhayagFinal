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
        Schema::table('students', function (Blueprint $table) {
            $table->string('temporary_password')->nullable()->after('password');
            $table->string('profile_picture')->nullable()->after('temporary_password');
            $table->string('class_year')->nullable()->after('profile_picture');
            $table->enum('status', ['active', 'inactive'])->default('active')->after('class_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['temporary_password', 'profile_picture', 'class_year', 'status']);
        });
    }
};
