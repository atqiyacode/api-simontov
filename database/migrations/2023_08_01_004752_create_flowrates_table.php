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
        Schema::create('flowrates', function (Blueprint $table) {
            $table->id();
            $table->dateTime('mag_date');
            $table->bigInteger('mag_date_time');
            $table->decimal('flowrate');
            $table->string('unit_flowrate');
            $table->decimal('totalizer_1');
            $table->decimal('totalizer_2');
            $table->decimal('totalizer_3');
            $table->string('unit_totalizer');
            $table->decimal('analog_1');
            $table->decimal('analog_2');
            $table->integer('status_battery');
            $table->integer('alarm');
            $table->string('bin_alarm', 15)->nullable();
            $table->string('file_name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flowrates');
    }
};
