<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('event_goals', function (Blueprint $table) {
      $table->id('goal_id');
      $table->foreignId('event_id')
        ->constrained('events', 'event_id')
        ->cascadeOnDelete();
      $table->text('description');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('event_goals');
  }
};
