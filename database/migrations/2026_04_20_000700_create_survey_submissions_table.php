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
        Schema::create('survey_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('respondent_status');
            $table->json('needed_collections')->nullable();
            $table->json('frequent_services')->nullable();
            $table->string('satisfaction')->nullable();
            $table->json('suggestions')->nullable();
            $table->text('other_suggestion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_submissions');
    }
};
