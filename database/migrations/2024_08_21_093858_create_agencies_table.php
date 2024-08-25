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
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('agency_name');
            $table->string('company_name');
            $table->text('company_address');
            $table->string('director_name');
            $table->string('company_registration_number')->nullable();
            $table->string('company_tax_number')->nullable();
            $table->string('company_bank_account')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('contract_name')->nullable();
            $table->integer('quota')->default(0);
            $table->string('agency_logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agencies');
    }
};
