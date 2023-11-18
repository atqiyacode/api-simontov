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
        Schema::create('dashboard_chart_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('dashboard_chart_id');
            $table->timestamps();

            // Define foreign keys if necessary
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dashboard_chart_id')->references('id')->on('dashboard_charts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_dashboard_chart');
    }
};
