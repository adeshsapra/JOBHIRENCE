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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('c_name');
            $table->string('c_email')->unique();
            $table->string('c_password');
            $table->string('c_industry');
            $table->string('c_size');
            $table->year('c_established_year');
            $table->string('c_type');
            $table->string('c_city');
            $table->string('c_country');
            $table->string('c_postal_code');
            $table->string('c_website')->nullable();
            $table->text('c_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
