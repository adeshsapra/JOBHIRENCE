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
        Schema::table('job_application', function (Blueprint $table) {
            $table->string('poster_type')->nullable()->after('employer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_application', function (Blueprint $table) {
            $table->dropColumn('poster_type');
        });
    }
};
