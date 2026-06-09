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
        Schema::create('incoming_letters', function (Blueprint $table) {
            $table->id();
            $table->string('letter_number', 50);
            $table->date('letter_date');
            $table->date('received_date');
            $table->string('sender', 100);
            $table->enum('letter_type', ['invitation', 'announcement']);
            $table->string('subject', 255);
            $table->string('file_path')->nullable();
            $table->enum('status', ['unassigned', 'assigned', 'completed'])->default('unassigned');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incoming_letters');
    }
};
