<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('certificates', function (Blueprint $table) {
      $table->id('certificate_id');
      $table->foreignId('registration_id')
        ->constrained('registrations', 'registration_id')
        ->cascadeOnDelete()
        ->unique();
      $table->text('file_path');
      $table->timestamp('date_generate')->nullable();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('certificates');
  }
};

