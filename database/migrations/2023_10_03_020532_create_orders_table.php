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
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users");
            $table->unsignedBigInteger("cart_id");
            $table->foreign("cart_id")->references("id")->on("carts");
            $table->enum("status", ["Pending", "For Packaging", "Out for Delivery", "Cancelled"]);
            $table->enum("payment_type", ["Debit/Credit Card", "Cash on Delivery"]);
            $table->decimal("total");
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
