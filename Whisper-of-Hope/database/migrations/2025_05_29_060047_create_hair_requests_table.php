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
        Schema::create('hair_requests', function (Blueprint $table) {
            $table->id();
            $table->string('recipient_full_name');
            $table->integer('recipient_age');
            $table->string('recipient_email');
            $table->string('recipient_phone');
            $table->text('recipient_reason');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('purpose_id')->constrained('purposes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hair_requests');
    }
};