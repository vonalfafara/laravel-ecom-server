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
        Schema::create("orders", function(Blueprint $table) {
            $table->id();
            $table->string("order_id");
            $table->unsignedBigInteger("user_id")->index();
            $table->unsignedBigInteger("product_id")->index();
            $table->integer("quantity");
            $table->decimal("total");
            $table->enum("status", ["Pending", "For Packaging", "Out for Delivery", "Cancelled"]);
            $table->enum("payment_type", ["Debit/Credit Card", "Cash on Delivery"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
