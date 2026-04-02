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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('unit')->default('sq/ml/qr'); // measurement unit (e.g. kq, litr, qram, ədəd)
            $table->decimal('stock', 8, 2)->default(0); // quantity currently in warehouse
            $table->decimal('min_stock_alert', 8, 2)->default(10); // minimum threshold to trigger alert
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
