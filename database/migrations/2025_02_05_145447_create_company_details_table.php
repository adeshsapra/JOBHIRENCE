<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('company_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('profile_img')->nullable();
            $table->string('cover_img')->nullable();
            $table->string('market_type')->nullable();
            $table->text('about')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('follower')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('company_details');
    }
};
