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
        Schema::create('center_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('mocktest_volume_id')->nullable();
                        $table->integer('zone_id')->nullable();
                        $table->integer('center_id')->nullable();
                        $table->double('mrp')->nullable();
                        $table->double('price')->nullable();
                        $table->integer('total_seet')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('center_prices');
    }
};
