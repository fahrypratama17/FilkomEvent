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
      Schema::create('registrations', function (Blueprint $table) {
        $table->id('registration_id');

        $table->foreignId('user_id')
          ->constrained('users', 'user_id')
          ->cascadeOnDelete();

        $table->string('event_id', 20);
        $table->foreign('event_id')
          ->references('event_id')
          ->on('events')
          ->cascadeOnDelete();

        $table->string('registration_status', 20);
        $table->timestamp('registration_date')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('registrations');
    }
};
