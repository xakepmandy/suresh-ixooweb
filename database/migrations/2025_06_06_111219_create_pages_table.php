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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_hedding');
            $table->string('page_title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->string('image');
            $table->boolean('status')->default(true);
            $table->foreignId('category_id');
            $table->foreignId('sub_category_id');
            $table->integer('page_view_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
