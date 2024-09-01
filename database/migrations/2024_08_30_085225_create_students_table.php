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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->string('std_unique_id')->unique();
            $table->string('full_name')->nullable();
            $table->date('dob')->nullable();
            $table->integer('age')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('sure_name')->nullable();
            $table->string('given_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('visa_number')->nullable();
            $table->date('visa_issue_date')->nullable();
            $table->date('visa_expiry_date')->nullable();
            $table->string('agency_name')->nullable();
            $table->string('agent_name')->nullable();
            $table->string('country_code')->nullable();
            $table->string('training_program');
            $table->integer('class_hours');
            $table->integer('practice_hours');
            $table->string('address_in_ro');
            $table->string('working_place_ro');
            $table->string('training_place_ro');
            $table->string('phone_number_ro');
            $table->string('bank_account_ro');
            $table->date('arrival_date_ro');
            $table->string('address_abroad')->nullable();
            $table->string('working_place_abroad')->nullable();
            $table->string('training_place_abroad');
            $table->string('phone_abroad')->nullable();
            $table->string('residence_permit_number')->nullable();
            $table->date('residence_permit_issue_date')->nullable();
            $table->date('residence_permit_expiry_date')->nullable();
            $table->date('training_start_date');
            $table->integer('remain_hours_training_class');
            $table->integer('remain_hours_practice');
            $table->date('work_start_date');
            $table->decimal('salary', 8, 2);
            $table->decimal('monthly_rate', 8, 2);
            $table->decimal('daily_rate', 8, 2);
            $table->string('employer');
            $table->string('monthly_time_sheet')->nullable();
            $table->string('month');
            $table->integer('total_work_hours');
            $table->integer('total_training_class_hours');
            $table->integer('total_practice_hours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
