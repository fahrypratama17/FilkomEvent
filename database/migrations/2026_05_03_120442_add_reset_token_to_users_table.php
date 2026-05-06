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
      Schema::table('users', function (Blueprint $table) {
        if (! Schema::hasColumn('users', 'reset_token')) {
          $table->string('reset_token')->nullable();
        }

        if (! Schema::hasColumn('users', 'reset_token_expired_at')) {
          $table->timestamp('reset_token_expired_at')->nullable();
        }
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('users', function (Blueprint $table) {
        $columns = array_filter([
          Schema::hasColumn('users', 'reset_token') ? 'reset_token' : null,
          Schema::hasColumn('users', 'reset_token_expired_at') ? 'reset_token_expired_at' : null,
        ]);

        if ($columns !== []) {
          $table->dropColumn($columns);
        }
      });
    }
};
