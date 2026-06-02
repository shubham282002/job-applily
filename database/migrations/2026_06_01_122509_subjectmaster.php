<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('category');          // "Job Application", "Follow-up", etc
            $table->string('title');             // "Applying for Software Engineer"
            $table->longText('description');     // Full subject line
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_subjects');
    }
};
