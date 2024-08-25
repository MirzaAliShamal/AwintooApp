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
            $table->string('status')->default('Visa Application Started')->after('phone_abroad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rest_informations', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
