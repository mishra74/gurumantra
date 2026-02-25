<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('classes', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('time')->nullable();
        $table->unsignedBigInteger('teacher_id')->nullable();
        $table->date('start_date')->nullable();
        $table->text('description')->nullable();
        $table->string('meta_key')->nullable();
        $table->string('meta_description')->nullable();
        $table->boolean('status')->default(1);
        $table->softDeletes();
        $table->timestamps();
    });

    Schema::create('class_batch', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('class_id');
        $table->unsignedBigInteger('batch_id');
        $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
        $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
        $table->timestamps();
    });
}

};
