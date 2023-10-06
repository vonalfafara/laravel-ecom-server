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
        Schema::create("carts", function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_id")->index();
            $table->unsignedBigInteger("user_id")->index();
            $table->integer("quantity");
            $table->decimal("price");
            $table->decimal('total_price');
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
