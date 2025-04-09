<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('company_details', function (Blueprint $table) {
            $table->string('headquarters')->nullable()->after('about');
            $table->boolean('is_slider')->default(false)->after('headquarters');
        });
    }

    public function down(): void
    {
        Schema::table('company_details', function (Blueprint $table) {
            $table->dropColumn(['headquarters', 'is_slider']);
        });
    }
};
