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
        if (!Schema::hasColumn('blogs', 'title_en')) {
            Schema::table('blogs', function (Blueprint $table) { $table->string('title_en')->nullable(); });
        }
        if (!Schema::hasColumn('blogs', 'title_ru')) {
            Schema::table('blogs', function (Blueprint $table) { $table->string('title_ru')->nullable(); });
        }
        if (!Schema::hasColumn('blogs', 'category_en')) {
            Schema::table('blogs', function (Blueprint $table) { $table->string('category_en')->nullable(); });
        }
        if (!Schema::hasColumn('blogs', 'category_ru')) {
            Schema::table('blogs', function (Blueprint $table) { $table->string('category_ru')->nullable(); });
        }
        if (!Schema::hasColumn('blogs', 'content_en')) {
            Schema::table('blogs', function (Blueprint $table) { $table->longText('content_en')->nullable(); });
        }
        if (!Schema::hasColumn('blogs', 'content_ru')) {
            Schema::table('blogs', function (Blueprint $table) { $table->longText('content_ru')->nullable(); });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $cols = ['title_en', 'title_ru', 'category_en', 'category_ru', 'content_en', 'content_ru'];
            foreach($cols as $col) {
                if (Schema::hasColumn('blogs', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
