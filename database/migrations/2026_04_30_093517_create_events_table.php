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
    Schema::create('events', function (Blueprint $table) {
      $table->id('event_id');
      $table->string('title', 150);
      $table->text('description');
      $table->timestamp('event_start');
      $table->timestamp('event_end');
      $table->string('location', 150);
      $table->integer('quota');
      $table->integer('quota_filled');
      $table->string('event_status', 20);
      $table->string('registration_status', 20);
      $table->decimal('price', 10, 2);
      $table->boolean('is_paid');
      $table->integer('category_id');
      $table->integer('created_by');
      $table->text('image_url');
      $table->string('organizer', 150);
      $table->string('contact_email', 100);
      $table->string('contact_phone', 20);
      $table->timestamps();
    });
  }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
