<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the column if it exists to avoid errors
            try {
                $table->dropColumn('contact_number');
            } catch (\Exception $e) {
                // Column doesn't exist, continue
            }
            
            // Add the column
            $table->string('contact_number')->nullable()->after('name');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('contact_number');
        });
    }
};