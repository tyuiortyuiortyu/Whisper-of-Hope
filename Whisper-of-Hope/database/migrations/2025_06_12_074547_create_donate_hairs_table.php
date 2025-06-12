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
        Schema::create('donate_hairs', function (Blueprint $table) {
        $table->id();
        $table->string('donator_name');
        $table->integer('donator_age');
        $table->string('donator_email');
        $table->string('donator_phone');
        $table->float('donator_reason');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donate_hairs');
    }
};
