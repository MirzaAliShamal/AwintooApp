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
            $table->string('place_of_birth')->nullable()->after('system_email');
            $table->string('nationality')->nullable()->after('place_of_birth');
            $table->string('marital_status')->nullable()->after('nationality');
            $table->string('spouse_name')->nullable()->after('marital_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rest_informations', function (Blueprint $table) {
            $table->dropColumn('place_of_birth');
            $table->dropColumn('nationality');
            $table->dropColumn('marital_status');
            $table->dropColumn('spouse_name');
        });
    }
};
