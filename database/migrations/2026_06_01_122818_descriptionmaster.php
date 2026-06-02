<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('type');              // "introduction", "closing", "body"
            $table->string('title');             // "Professional Introduction"
            $table->longText('content');         // Email body HTML content
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_descriptions');
    }
};
