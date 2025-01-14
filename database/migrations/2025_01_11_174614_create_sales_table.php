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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->string('product_name');
            $table->string('product_image');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('sub_total_product');
            $table->integer('total_quantity');
            $table->integer('sub_total');
            $table->string('payment_method')->nullable();
            $table->string('payment_confirmation')->nullable();
            $table->integer('total_amount')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
