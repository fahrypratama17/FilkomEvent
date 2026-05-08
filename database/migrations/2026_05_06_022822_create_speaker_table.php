<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('speakers', function (Blueprint $table) {
      $table->id('speaker_id');
      $table->string('name', 100);
      $table->string('title', 100);
      $table->string('organization', 150);
      $table->text('photo_url')->nullable();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('speakers');
  }
};
