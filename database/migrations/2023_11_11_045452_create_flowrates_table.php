<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('flowrates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained('locations');
            $table->dateTime('mag_date');
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
            $table->string('ph')->nullable();
            $table->string('cod')->nullable();
            $table->string('cond')->nullable();
            $table->string('level')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('flowrates');
    }
};
