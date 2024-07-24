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
            $table->string('password')->nullable()->after('email');
            $table->string('father_name')->nullable()->change();
            $table->string('mother_name')->nullable()->change();
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->change();
            $table->date('dob')->nullable()->change();
            $table->string('passport_number')->nullable()->change();
            $table->date('issue_date')->nullable()->change();
            $table->date('expiry_date')->nullable()->change();
            $table->date('id_expiry_date')->nullable()->change();
            $table->string('phone_number')->nullable()->change();
            $table->string('school_level')->nullable()->change();
            $table->date('police_certificate_issue_date')->nullable()->change();
            $table->date('application_date')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('password');
            $table->string('father_name')->nullable(false)->change();
            $table->string('mother_name')->nullable(false)->change();
            $table->enum('gender', ['male', 'female', 'other'])->nullable(false)->change();
            $table->date('dob')->nullable(false)->change();
            $table->string('passport_number')->nullable(false)->change();
            $table->date('issue_date')->nullable(false)->change();
            $table->date('expiry_date')->nullable(false)->change();
            $table->date('id_expiry_date')->nullable(false)->change();
            $table->string('phone_number')->nullable(false)->change();
            $table->string('school_level')->nullable(false)->change();
            $table->date('police_certificate_issue_date')->nullable(false)->change();
            $table->date('application_date')->nullable(false)->change();
        });
    }
};
