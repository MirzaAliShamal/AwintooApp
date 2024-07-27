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
        Schema::table('clients', function (Blueprint $table) {
            $table->string('id_number')->nullable()->after('id_expiry_date');
            $table->string('photo')->nullable()->after('user_id');
            $table->string('id_front')->nullable()->after('photo');
            $table->string('id_back')->nullable()->after('id_front');
            $table->string('license_front')->nullable()->after('id_back');
            $table->string('license_back')->nullable()->after('license_front');
            $table->string('job_application_sign')->nullable()->after('license_back');
            $table->string('passport_copy')->nullable()->after('job_application_sign');
            $table->string('police_certificate')->nullable()->after('passport_copy');
            $table->string('school_certificate')->nullable()->after('police_certificate');
            $table->string('bank_certificate')->nullable()->after('school_certificate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('id_number');
            $table->dropColumn('photo');
            $table->dropColumn('id_front');
            $table->dropColumn('id_back');
            $table->dropColumn('license_front');
            $table->dropColumn('license_back');
            $table->dropColumn('job_application_sign');
            $table->dropColumn('passport_copy');
            $table->dropColumn('police_certificate');
            $table->dropColumn('school_certificate');
            $table->dropColumn('bank_certificate');
           
        });
    }
};
