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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('plates');
            $table->integer('ah');
            $table->integer('limit');
            $table->decimal('buying_price', 8, 2);
            $table->decimal('selling_price', 8, 2);
            $table->unsignedBigInteger('added_by');
            $table->timestamp('added_on')->useCurrent();
            $table->timestamps();

            // Assuming you have a users table and added_by refers to a user ID
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
