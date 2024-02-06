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
        Schema::table('locations', function (Blueprint $table) {
            $table->string('pic')->nullable();
            $table->string('npwp')->nullable();
            $table->string('email')->nullable();
            $table->longText('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('pic');
            $table->dropColumn('npwp');
            $table->dropColumn('email');
            $table->dropColumn('address');
        });
    }
};
