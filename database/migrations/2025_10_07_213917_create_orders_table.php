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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('buy_order')->unique();
            $table->string('session_id');
            $table->integer('amount');
            $table->string('status')->default('pending'); // pending, approved, failed, canceled
            $table->string('authorization_code')->nullable();
            $table->string('payment_type')->nullable();
            $table->timestamp('transaction_date')->nullable();
            $table->json('raw_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
