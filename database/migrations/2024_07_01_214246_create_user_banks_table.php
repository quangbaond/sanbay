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
        Schema::create('user_banks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('bank_account_name');
            $table->string('bank_branch');
            $table->string('bank_account');
            $table->string('bank_name');
            $table->string('id_card_before');
            $table->string('id_card_after');
            $table->tinyInteger('status')->default(1)->comment('0: inactive, 1: active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_banks');
    }
};
