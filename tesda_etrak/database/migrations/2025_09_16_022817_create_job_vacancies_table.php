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
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('request_date', 50)->nullable();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('sector')->nullable();
            $table->string('vacancies');
            $table->string('related_qualifications')->nullable();
            $table->string('job_titles')->nullable();
            $table->string('tr_qualifications')->nullable();
            $table->string('no_of_vacancies')->nullable();
            $table->string('deployment_location')->nullable();
            $table->string('no_of_referred')->nullable();
            $table->string('no_of_hired')->nullable();
            $table->string('remarks')->nullable();
            $table->string('attachment_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
