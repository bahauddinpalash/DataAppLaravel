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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();

            // Personal Information
            $table->string('name');
            $table->string('email')->unique();
            $table->string('contact_number');
            $table->integer('age')->unsigned();
            $table->string('nationality');
            $table->string('marital_status');
            
            // Professional Details
            $table->string('position')->nullable();
            $table->integer('total_experience')->unsigned();
            $table->integer('relevant_experience')->unsigned();
            $table->decimal('current_salary', 10, 2);
            $table->decimal('expected_salary', 10, 2);
            $table->string('highest_qualification');
            $table->string('notice_period');
            $table->string('interview_availability');

            // Visa and Location Information
            $table->string('visa_type');
            $table->date('visa_expiry_date');
            $table->string('current_location');

            // Additional Details
            $table->string('job_change_reason');
            $table->string('cv')->nullable(); 
            // Timestamps
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
