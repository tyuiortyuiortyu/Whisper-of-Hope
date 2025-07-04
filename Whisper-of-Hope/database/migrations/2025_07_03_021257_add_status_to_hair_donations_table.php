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
        Schema::table('hair_donations', function (Blueprint $table) {
            // Tambahkan kolom 'status' jika belum ada
            if (!Schema::hasColumn('hair_donations', 'status')) {
                $table->enum('status', ['waiting', 'received', 'missing'])->default('waiting')->after('hair_length');
            }
        });
    }

    public function down(): void
    {
        Schema::table('hair_donations', function (Blueprint $table) {
            if (Schema::hasColumn('hair_donations', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};