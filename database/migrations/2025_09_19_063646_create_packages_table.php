<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_name');
            $table->enum('package_type', ['day', 'month', 'year']);
            $table->enum('course_type', [
                'test_notes',
                'recorded_test_notes',
                'live_recorded_test_notes'
            ]);
            $table->integer('package_validity')->comment('validity in days');
            $table->decimal('mrp', 10, 2);
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 5, 2)->nullable();
            $table->date('expire_at')->nullable();
            $table->string('package_key')->unique();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
