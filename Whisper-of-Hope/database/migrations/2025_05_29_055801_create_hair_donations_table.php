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
        Schema::create('hair_donations', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('full_name');
            $table->integer('age');
            $table->string('email');
            $table->string('phone', 20);
            $table->integer('hair_length'); 
            $table->string('status')->default('waiting');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hair_donations');
    }
};
