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
        Schema::create('outgoing_letters', function (Blueprint $table) {
            $table->id();
            $table->string('letter_number', 50)->nullable();
            $table->date('letter_date')->nullable();
            $table->enum('letter_type', ['recommendation', 'active_certificate', 'assignment']);
            $table->string('related_name', 100);
            $table->string('purpose', 255);
            $table->string('addressed_to', 100);
            $table->text('letter_body');
            $table->string('event_name', 100)->nullable();
            $table->date('event_date')->nullable();
            $table->string('event_location', 100)->nullable();
            $table->string('file_path')->nullable();
            $table->enum('status', ['draft', 'pending_approval', 'approved', 'rejected', 'sent'])->default('draft');
            $table->text('rejection_note')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoing_letters');
    }
};
