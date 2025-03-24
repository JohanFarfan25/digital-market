<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id');
            $table->string('uuid')->unique();
            $table->enum('type', ['purchase', 'sale', 'adjustment']);
            $table->timestamp('date')->useCurrent();
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->string('supplier')->nullable();
            $table->string('customer')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('transaction_status', [
                'pending',
                'authorized',
                'completed',
                'failed',
                'declined',
                'refunded',
                'voided',
                'cancelled',
                'expired',
            ])->default('pending');
            $table->string('external_ref')->nullable();
            $table->string('fact')->nullable();
            $table->string('franchise')->nullable();
            $table->string('reson_rejection')->nullable();
            $table->unsignedBigInteger('registered_by')->nullable();
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('registered_by')->references('id')->on('users');
            $table->foreign('edited_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
