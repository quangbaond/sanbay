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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('password2')->nullable();
            $table->tinyInteger('role')->default(0)->comment('0: user, 1: admin');
            $table->bigInteger('balance')->default(0);
            $table->tinyInteger('status')->default(1)->comment('0: inactive, 1: active');
            $table->string('phone')->nullable();
            $table->string('id_card')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
