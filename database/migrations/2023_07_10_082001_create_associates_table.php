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
        Schema::create('associates', function (Blueprint $table) {
            $table->id();
            $table->string('associate_number')->nullable();
            $table->string('company_name');
            $table->string('image')->nullable();
            $table->string('address')->nullable();
            $table->integer('province_id')->nullable();
            $table->date('accession_date')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('date_statute')->nullable();
            $table->string('number_statute')->nullable();
            $table->text('company_goals')->nullable();
            $table->string('representative_name')->nullable();
            $table->string('representative_email')->nullable();
            $table->string('representative_mobile')->nullable();
            $table->string('representative_cellphone')->nullable();
            $table->string('representative_role')->nullable();
            $table->string('nuit')->nullable();
            $table->string('invoice_mobile')->nullable();
            $table->string('invoice_name')->nullable();
            $table->string('invoice_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('associates');
    }
};
