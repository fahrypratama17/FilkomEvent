<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new  class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name', 100);
            $table->string('nim', 16)->unique();
            $table->string('email')->unique();
            $table->text('password');
            $table->rememberToken();
            $table->string('reset_token')->nullable();
            $table->timestamp('reset_token_expired-at')->nullable();
            $table->string('role')->default('Mahasiswa');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
