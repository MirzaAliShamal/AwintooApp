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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('dob');
            $table->string('passport_number');
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->date('id_expiry_date');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->string('school_level');
            $table->foreignId('job_id')->constrained('jobs');
            $table->date('police_certificate_issue_date');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('application_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
