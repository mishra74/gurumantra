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
        Schema::create('question_banks', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->integer('marks')->default(1);
            $table->integer('negative_marks')->default(0);
            $table->string('type')->default('mcq'); // mcq, true_false, etc.
            $table->integer('total_options')->default(4);
            $table->json('options')->nullable(); // yaha CKEditor se options save honge
            $table->string('correct_answer')->nullable();
            $table->text('hint')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_banks');
    }
};
