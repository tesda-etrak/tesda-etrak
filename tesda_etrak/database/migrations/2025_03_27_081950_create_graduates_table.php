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
        Schema::create('graduates', function (Blueprint $table) {
            $table->id();
            $table->string('district', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('tvi')->nullable();
            $table->string('qualification_title')->nullable();
            $table->string('sector')->nullable();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('extension_name', 50)->nullable();
            $table->string('full_name');
            $table->string('sex', 50)->nullable();
            $table->string('birthdate', 50)->nullable();
            $table->string('contact_number', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('scholarship_type', 50)->nullable();
            $table->string('training_status', 50)->nullable();
            $table->string('assessment_result')->nullable();
            $table->string('employment_before_training', 50)->nullable();
            $table->string('occupation')->nullable();
            $table->string('employer_name')->nullable();
            $table->string('employer_address')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('date_hired', 50)->nullable();
            $table->string('allocation', 50)->nullable();
            $table->string('verification_means', 50)->nullable();
            $table->string('verification_date', 50)->nullable();
            $table->string('verification_status', 50)->nullable();
            $table->string('follow_up_date_1', 50)->nullable();
            $table->string('follow_up_date_2', 50)->nullable();
            $table->string('follow_up_remarks')->nullable();
            $table->string('response_status', 50)->nullable();
            $table->string('not_interested_reason')->nullable();
            $table->char('referral_status', 10)->nullable();
            $table->string('referral_date', 50)->nullable();
            $table->string('no_referral_reason')->nullable();
            $table->char('invalid_contact', 10)->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('job_title')->nullable();
            $table->string('application_status')->nullable();
            $table->string('not_proceed_reason')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('hired_date', 50)->nullable();
            $table->string('submitted_documents_date', 50)->nullable();
            $table->string('interview_date', 50)->nullable();
            $table->string('not_hired_reason', 50)->nullable();
            $table->string('remarks')->nullable();
            $table->char('count', 10)->nullable();
            $table->char('no_of_graduates', 10)->nullable();
            $table->char('no_of_employed', 10)->nullable();
            $table->string('verification', 50)->nullable();
            $table->char('job_vacancies', 10)->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduates');
    }
};
