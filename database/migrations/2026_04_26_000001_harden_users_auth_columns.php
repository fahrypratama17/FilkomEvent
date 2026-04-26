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
        if (! Schema::hasColumn('users', 'remember_token')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->rememberToken()->nullable()->after('password');
            });
        }

        if (! Schema::hasIndex('users', 'users_email_unique', 'unique')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->unique('email');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This hardening migration is intentionally one-way to avoid
        // dropping pre-existing indexes/columns in mixed environments.
    }
};
