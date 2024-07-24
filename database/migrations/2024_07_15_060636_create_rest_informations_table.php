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
        Schema::create('rest_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->unique('client_id');
            $table->string('body_size')->nullable();
            $table->string('phone_type')->nullable();
            $table->string('name_with_vietnam_characters')->nullable();
            $table->string('job_apply')->nullable();
            $table->string('training_program')->nullable();
            $table->string('system_email')->nullable();
            $table->string('english_characters_living_address')->nullable();
            $table->text('vietnam_living_address')->nullable();
            $table->enum('bank_in_vn', ['yes', 'no'])->nullable();
            $table->string('country_to_go')->nullable();
            $table->string('school_diploma')->nullable();
            $table->string('original_english_legalizedFM_equalize')->nullable();
            $table->date('driver_licence_issue_date')->nullable();
            $table->date('driver_license_expiry_date')->nullable();
            $table->string('photo')->nullable();
            $table->string('video_working_link')->nullable();
            $table->date('police_certificate_expiry_date')->nullable();
            $table->string('visa_application_number')->nullable();
            $table->date('interview_date')->nullable();
            $table->string('insurance_type')->nullable();
            $table->date('insurance_expiry_date')->nullable();
            $table->decimal('amount_paid', 10, 2)->nullable();
            $table->decimal('balance_amount', 10, 2)->nullable();
            $table->string('document_to_upload')->nullable();
            $table->string('working_place')->nullable();
            $table->text('address_abroad')->nullable();
            $table->string('phone_abroad')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rest_informations');
    }
};
