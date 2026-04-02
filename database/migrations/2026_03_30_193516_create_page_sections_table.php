<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page_name'); // 'home', 'about', 'blogs'
            $table->string('section_key'); // 'hero', 'custom_123'
            
            $table->string('title_az')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_ru')->nullable();
            
            $table->text('subtitle_az')->nullable();
            $table->text('subtitle_en')->nullable();
            $table->text('subtitle_ru')->nullable();
            
            $table->longText('content_az')->nullable();
            $table->longText('content_en')->nullable();
            $table->longText('content_ru')->nullable();
            
            $table->string('image_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order_index')->default(0);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
