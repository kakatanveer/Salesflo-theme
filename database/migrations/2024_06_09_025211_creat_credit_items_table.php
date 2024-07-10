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
        Schema::create('credit_items',function(Blueprint $table) {
            $table->id();
            $table->foreignId('credit_id')->constrained('credits')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('items');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->decimal('item_discount', 10, 2);
            $table->decimal('discount_amount', 10, 2);
            $table->decimal('total', 10, 2);
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
