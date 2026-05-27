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
      $table->string('event_id', 20);
      $table->text('description');

      $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('event_goals');
  }
};
