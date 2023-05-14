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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('driver_name')->unique();
            $table->string('merchant_email')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('secret')->nullable();
            $table->string('sandbox_merchant_email')->nullable();
            $table->string('sandbox_username')->nullable();
            $table->string('sandbox_password')->nullable();
            $table->string('sandbox_secret')->nullable();
            $table->boolean('sandbox')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
