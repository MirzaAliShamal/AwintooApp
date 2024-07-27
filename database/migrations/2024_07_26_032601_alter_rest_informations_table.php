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
        Schema::table('rest_informations', function (Blueprint $table) {
            $table->string('five_minutes_work_video')->nullable();
            $table->string('legalized_police_certificate')->nullable();
            $table->string('legalized_school_certificate')->nullable();
            $table->string('legalized_driver_license')->nullable();
            $table->dropColumn('phone_type');
            $table->dropColumn('job_apply');
            $table->dropColumn('bank_in_vn');
            $table->dropColumn('country_to_go');
            $table->dropColumn('school_diploma');
            $table->dropColumn('original_english_legalizedFM_equalize');
            $table->dropColumn('photo');
            $table->dropColumn('video_working_link');
            $table->dropColumn('document_to_upload');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rest_informations', function (Blueprint $table) {
            $table->dropColumn('five_minutes_work_video');
            $table->dropColumn('legalized_police_certificate');
            $table->dropColumn('legalized_school_certificate');
            $table->dropColumn('legalized_driver_license');
            $table->string('phone_type')->nullable();
            $table->string('job_apply')->nullable();
            $table->enum('bank_in_vn', ['yes', 'no'])->nullable();
            $table->string('country_to_go')->nullable();
            $table->string('school_diploma')->nullable();
            $table->string('original_english_legalizedFM_equalize')->nullable();
            $table->string('photo')->nullable();
            $table->string('video_working_link')->nullable();
            $table->string('document_to_upload')->nullable();
        });
    }
};
