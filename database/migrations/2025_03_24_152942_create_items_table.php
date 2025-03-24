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
            $table->string('uuid')->unique();
            $table->unsignedBigInteger('transaction_id');
            $table->integer('product_id')->nullable();
            $table->integer('batch_id')->nullable();
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->foreignId('registered_by')->constrained('users')->onDelete('cascade');
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->timestamps();
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
