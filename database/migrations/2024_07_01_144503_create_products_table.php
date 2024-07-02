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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('image');
            $table->bigInteger('profit_everyday');
            $table->bigInteger('time_invest');
            $table->integer('progress');
            $table->bigInteger('amount_total');
            $table->bigInteger('amount_invested');
            $table->text('description');
            $table->bigInteger('min_invest');
            $table->text('times_invest_decision');
            $table->text('book_invest');
            $table->text('security');
            $table->text('sort_description');
            $table->text('interest_risk');
            $table->text('profit_calculation');
            $table->tinyInteger('status')->comment('0: inactive, 1: active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
