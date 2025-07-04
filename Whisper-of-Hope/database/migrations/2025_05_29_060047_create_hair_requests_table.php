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
            $table->string('id')->primary();
            
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Form type
            $table->enum('who_for', ['myself', 'parent_guardian', 'health_professional'])->default('myself');

            // Recipient details (always required)
            $table->string('recipient_full_name');
            $table->integer('recipient_age');
            $table->string('recipient_email')->nullable(); // nullable for when someone else is applying
            $table->string('recipient_phone')->nullable(); // nullable for when someone else is applying
            $table->text('recipient_reason');
            
            // Requester details (when applying for someone else)
            $table->string('requester_full_name')->nullable();
            $table->string('requester_email')->nullable();
            $table->string('requester_phone')->nullable();
            $table->string('relationship_to_recipient')->nullable(); // for parent/guardian or medical professional
            
            // Medical professional specific fields
            $table->string('healthcare_location')->nullable();
            
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