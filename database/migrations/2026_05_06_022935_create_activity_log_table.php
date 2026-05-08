<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('activity_log', function (Blueprint $table) {
      $table->id('log_id');
      $table->unsignedBigInteger('user_id');
      $table->string('action', 100);
      $table->text('description')->nullable();
      $table->timestamp('created_at')->useCurrent();

      $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('activity_log');
  }
};
