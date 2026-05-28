<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('event_speakers', function (Blueprint $table) {
      $table->id();
      $table->foreignId('event_id')
        ->constrained('events', 'event_id')
        ->cascadeOnDelete();
      $table->unsignedBigInteger('speaker_id');

      $table->foreign('speaker_id')->references('speaker_id')->on('speakers')->onDelete('cascade');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('event_speakers');
  }
};
