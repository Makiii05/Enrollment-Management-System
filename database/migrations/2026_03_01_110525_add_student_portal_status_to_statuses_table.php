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
        Schema::table('statuses', function (Blueprint $table) {
            $table->enum('student_portal_status', ['on', 'off'])->default('off')->after('enrollment_status');
        });

        // Update existing record
        \DB::table('statuses')->update(['student_portal_status' => 'off']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('statuses', function (Blueprint $table) {
            $table->dropColumn('student_portal_status');
        });
    }
};
