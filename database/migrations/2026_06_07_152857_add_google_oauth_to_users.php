<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id')->nullable()->unique();
            $table->string('google_email')->nullable();
            $table->text('google_access_token')->nullable();  // Encrypted
            $table->text('google_refresh_token')->nullable(); // Encrypted
            $table->timestamp('google_token_expires_at')->nullable();
            $table->boolean('gmail_connected')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'google_id',
                'google_email',
                'google_access_token',
                'google_refresh_token',
                'google_token_expires_at',
                'gmail_connected',
            ]);
        });
    }
};
