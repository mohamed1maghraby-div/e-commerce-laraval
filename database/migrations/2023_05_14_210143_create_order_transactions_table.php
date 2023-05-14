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
        Schema::create('order_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('transaction')->nullable();
            $table->string('transaction_number')->nullable();
            $table->string('payment_result')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_transactions');
    }
};
