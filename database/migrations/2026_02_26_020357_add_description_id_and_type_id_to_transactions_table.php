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
        Schema::table('transactions', function (Blueprint $table) {
            // Add new foreign key columns
            $table->foreignId('description_id')->nullable()->after('or_number')->constrained('payment_accounts')->onDelete('set null');
            $table->foreignId('type_id')->nullable()->after('description_id')->constrained('payment_types')->onDelete('set null');
            
            // Remove old columns
            $table->dropColumn('type');
            $table->dropColumn('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Restore old columns
            $table->string('type')->after('or_number');
            $table->string('description')->after('amount');
            
            // Remove foreign key columns
            $table->dropForeign(['description_id']);
            $table->dropForeign(['type_id']);
            $table->dropColumn('description_id');
            $table->dropColumn('type_id');
        });
    }
};
