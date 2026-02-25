<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('daily_currents', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('sub_title')->nullable();
        $table->string('pdf')->nullable();
        $table->longText('content')->nullable();
        $table->boolean('is_active')->default(1); // 1 = Active, 0 = Inactive
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('daily_currents');
}

};
