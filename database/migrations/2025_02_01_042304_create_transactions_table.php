<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('source_code');
            $table->unsignedBigInteger('voucher')->nullable();
            $table->string('price');
            $table->string('percent')->default('0');
            $table->string('transaction_id')->nullable(); // Menyimpan transaction ID Midtrans
            $table->string('order_id')->nullable(); // Menyimpan order ID dari Midtrans
            $table->string('payment_type')->nullable(); // Menyimpan jenis pembayaran
            $table->decimal('gross_amount', 10, 2)->nullable(); // Jumlah transaksi
            $table->string('currency')->nullable(); // Mata uang
            $table->string('transaction_status')->nullable(); // Status transaksi
            $table->string('fraud_status')->nullable(); // Status fraud
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
