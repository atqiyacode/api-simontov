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
        Schema::table('flowrates', function (Blueprint $table) {
            $table->string('ph', 100)->nullable()->change();
            $table->string('cod', 100)->nullable()->change();
            $table->string('cond', 100)->nullable()->change();
            $table->string('level', 100)->nullable()->change();
            $table->string('do', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flowrates', function (Blueprint $table) {
            $table->decimal('ph', 22)->nullable()->change();
            $table->decimal('cod', 22)->nullable()->change();
            $table->decimal('cond', 22)->nullable()->change();
            $table->decimal('level', 22)->nullable()->change();
            $table->decimal('do', 22)->nullable()->change();
        });
    }
};
