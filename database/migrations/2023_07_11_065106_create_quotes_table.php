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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('ref');
            $table->integer('user_id');
            $table->integer('company_id');
            $table->integer('payment_frequency_id');
            $table->float('amount',8,2);
            $table->float('amount_paid',8,2)->nullable();
            $table->float('penalty',8,2)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->date('payment_date')->nullable();
            $table->text('payment_ref')->nullable();
            $table->integer('status');
            $table->text('obs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
