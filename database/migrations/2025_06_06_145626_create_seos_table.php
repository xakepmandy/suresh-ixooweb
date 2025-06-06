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
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            $table->string('seo_title')->nullable(); 
            $table->string('seo_description')->nullable(); 
            $table->string('seo_keywords')->nullable(); 
            $table->string('seo_image')->nullable();
            $table->string('seo_url')->nullable();
            $table->string('seo_language')->nullable(); 
            $table->foreignId('page_id')->nullable('pages')->onDelete('cascade');
            $table->foreignId('blog_id')->nullable('blogs')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seos');
    }
};
