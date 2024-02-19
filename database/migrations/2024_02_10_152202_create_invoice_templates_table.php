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
        Schema::create('invoice_templates', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->longText('company_address');
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('npwp')->nullable();
            $table->longText('additional_section')->nullable();
            $table->string('manager_name');
            $table->longText('note')->nullbale();

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
        Schema::dropIfExists('invoiceTemplates');
    }
};
