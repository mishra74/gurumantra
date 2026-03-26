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
        Schema::create('off_line_mock_tests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('thumbnail')->nullable();
            $table->string('meta_key')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('volume_id')->nullable();
            $table->boolean('live_class')->default(false);
            $table->string('title')->nullable();
            $table->date('start_date')->nullable();
            $table->time('start_time')->nullable();
            $table->integer('time_period')->nullable();
            $table->time('last_time')->nullable();
            $table->string('pdf_file_question')->nullable();
            $table->string('pdf_enter_question')->nullable();
            $table->string('pdf_file_answer')->nullable();
            $table->string('pdf_enter_answer')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('off_line_mock_tests');
    }
};
