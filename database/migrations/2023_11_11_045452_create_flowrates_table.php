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
            $table->dateTime('mag_date')->nullable();

            $table->decimal('totalizer_1')->nullable();
            $table->decimal('totalizer_2')->nullable();
            $table->decimal('totalizer_3')->nullable();

            $table->decimal('flowrate')->nullable();
            $table->decimal('pressure')->nullable();

            $table->string('unit_flowrate')->nullable();
            $table->string('unit_totalizer')->nullable();

            $table->decimal('analog_1')->nullable();
            $table->integer('status_battery')->nullable();
            $table->integer('alarm')->nullable();

            $table->string('ph')->nullable();
            $table->string('cod')->nullable();
            $table->string('cond')->nullable();
            $table->string('level')->nullable();
            $table->string('do')->nullable();

            $table->string('bin_alarm', 15)->nullable();

            $table->boolean('do_alarm_hi')->default(0);
            $table->boolean('do_alarm_lo')->default(0);

            $table->boolean('pres_alarm_hi')->default(0);
            $table->boolean('pres_alarm_lo')->default(0);

            $table->boolean('ph_alarm_hi')->default(0);
            $table->boolean('ph_alarm_lo')->default(0);

            $table->string('fm_status')->nullable();
            $table->string('fm_err_code')->nullable();

            $table->boolean('pln_stat')->default(1);
            $table->boolean('panel_stat')->default(1);

            $table->string('file_name');

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
