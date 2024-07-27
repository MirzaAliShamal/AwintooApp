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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('proof_of_payment')->nullable()->after('after_deduction');
            $table->dropColumn('dob');
            $table->dropColumn('birth_place');
            $table->dropColumn('address');
            $table->dropColumn('issue_date');
            $table->dropColumn('expiry_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('proof_of_payment');
            $table->date('dob');
            $table->string('birth_place');
            $table->text('address');
            $table->date('issue_date');
            $table->date('expiry_date');
        });
    }
};
