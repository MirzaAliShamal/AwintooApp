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
            $table->dropColumn('training_program');
            $table->unsignedBigInteger('practice_places_id')->nullable()->after('name_with_vietnam_characters');
            $table->foreign('practice_places_id')->references('id')->on('practice_places')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rest_informations', function (Blueprint $table) {
            $table->string('training_program')->after('name_with_vietnam_characters')->nullable();
            $table->dropForeign(['practice_places_id']);
            $table->dropColumn('practice_places_id');
        });
    }
};
