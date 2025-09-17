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
        Schema::create('banners_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('banner_id')->nullable()->constrained('banners')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('locale');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners_translations');
    }
};
