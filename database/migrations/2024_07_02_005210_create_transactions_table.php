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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->bigInteger('amount');
            $table->tinyInteger('type')->comment('1: deposit, 2: withdraw');
            $table->tinyInteger('status')->comment('0: pending, 1: success, 2: failed');
            $table->string('payment_method')->nullable();
            $table->foreignId('user_bank_id')->nullable()->constrained()->onDelete('cascade');
            $table->text('description')->nullable();
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
