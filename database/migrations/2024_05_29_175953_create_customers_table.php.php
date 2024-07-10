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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('contact_number');
            $table->string('address');
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
        Schema::table('customers', function (Blueprint $table) {
            // Revert the change, assuming the original type was integer
            $table->integer('address')->change();
        });
    }
};
