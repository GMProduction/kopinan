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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('transaction_number')->default(null)->nullable();
            $table->integer('total_price');
            $table->tinyInteger('status_pesanan')->default(0)->comment('0: menunggu | 1: diterima | 2:diambil | 3:ditolak');
            $table->tinyInteger('status_pembayaran')->default(0)->comment('0: menunggu | 1: diterima | 2:ditolak');
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
