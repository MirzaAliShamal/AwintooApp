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
            $table->string('visa_number')->nullable();
            $table->date('visa_issue_date')->nullable();
            $table->date('visa_expiry_date')->nullable();
            $table->string('residence_permit_number')->nullable();
            $table->date('residence_permit_issue_date')->nullable();
            $table->date('residence_permit_expiry_date')->nullable();
            $table->string('bank_account_in_eu')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('resident_card_front')->nullable();
            $table->string('resident_card_back')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rest_informations', function (Blueprint $table) {
            $table->dropColumn('visa_number');
            $table->dropColumn('visa_issue_date');
            $table->dropColumn('visa_expiry_date');
            $table->dropColumn('residence_permit_number');
            $table->dropColumn('residence_permit_issue_date');
            $table->dropColumn('residence_permit_expiry_date');
            $table->dropColumn('bank_account_in_eu');
            $table->dropColumn('bank_name');
            $table->dropColumn('resident_card_front');
            $table->dropColumn('resident_card_back');
        });
    }
};
