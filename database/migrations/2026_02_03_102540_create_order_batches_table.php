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
        Schema::create('order_batches', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('batch_volume')->nullable();
            $table->string('type')->nullable(); // Class / Test / Batch
            $table->unsignedBigInteger('batch_id')->nullable();

            $table->decimal('price', 10, 2)->default(0);

            $table->string('order_number')->unique();
            $table->string('razorpay_orderID')->nullable();
            $table->string('razorpay_payment_id')->nullable();
            $table->text('razorpay_signature')->nullable();

            $table->timestamps();

            // // Optional Foreign Keys
            // $table->foreign('batch_id')->references('id')->on('users')->onDelete('cascade');
            // // $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_batches');
    }
};
