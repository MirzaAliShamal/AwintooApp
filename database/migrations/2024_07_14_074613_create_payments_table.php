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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->string('client_name');
            $table->string('passport_number');
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->text('address');
            $table->date('dob');
            $table->string('birth_place');
            $table->decimal('payment', 10, 2);
            $table->foreignId('job_id')->constrained('jobs')->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->decimal('after_deduction', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
