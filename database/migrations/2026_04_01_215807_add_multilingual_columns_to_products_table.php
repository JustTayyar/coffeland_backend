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
        if (!Schema::hasColumn('products', 'name_az')) {
            Schema::table('products', function (Blueprint $table) { $table->string('name_az')->nullable()->after('id'); });
        }
        if (!Schema::hasColumn('products', 'name_en')) {
            Schema::table('products', function (Blueprint $table) { $table->string('name_en')->nullable(); });
        }
        if (!Schema::hasColumn('products', 'name_ru')) {
            Schema::table('products', function (Blueprint $table) { $table->string('name_ru')->nullable(); });
        }
        
        if (!Schema::hasColumn('products', 'description_az')) {
            Schema::table('products', function (Blueprint $table) { $table->text('description_az')->nullable(); });
        }
        if (!Schema::hasColumn('products', 'description_en')) {
            Schema::table('products', function (Blueprint $table) { $table->text('description_en')->nullable(); });
        }
        if (!Schema::hasColumn('products', 'description_ru')) {
            Schema::table('products', function (Blueprint $table) { $table->text('description_ru')->nullable(); });
        }

        // Copy existing data safely
        \Illuminate\Support\Facades\DB::statement('UPDATE products SET name_az = name WHERE name_az IS NULL OR name_az = ""');
        \Illuminate\Support\Facades\DB::statement('UPDATE products SET description_az = description WHERE description_az IS NULL OR description_az = ""');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Keeping it simple
        Schema::table('products', function (Blueprint $table) {
            $cols = ['name_az', 'name_en', 'name_ru', 'description_az', 'description_en', 'description_ru'];
            foreach($cols as $col) {
                if (Schema::hasColumn('products', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
