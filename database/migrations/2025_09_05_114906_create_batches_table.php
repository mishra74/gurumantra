<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('package')->nullable();
            $table->date('start_date')->nullable();
            $table->integer('validity')->nullable(); // validity in days
            $table->boolean('is_active')->default(1); // Active/Inactive
            $table->softDeletes(); // Delete/Restore
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
