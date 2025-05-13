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
        Schema::create('documents', function (Blueprint $table) {
            $table->id()->autoIncrement()->primary();
            $table->char('uuid', 36)->unique();
            $table->string('title');
            $table->string('sender');
            $table->string('sender_email');
            $table->string('sender_dept');
            $table->string('recepient_dept');
            $table->enum('communication', ['IC','EC']);
            $table->string('qr_code_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
