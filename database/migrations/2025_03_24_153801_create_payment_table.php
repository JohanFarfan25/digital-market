<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->double('amount', 26, 2)->nullable();
            $table->string('payment_type');
            $table->text('note')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('box_id')->nullable();
            $table->string('voucher_number', 245)->nullable();
            $table->string('bank')->nullable();
            $table->unsignedBigInteger('transaction_id');
            $table->string('card_cd')->nullable();
            $table->string('franchise')->nullable();
            
            $table->smallInteger('payment_status')->nullable();
            $table->dateTime('payment_date')->useCurrent();
            $table->string('payment_reason_rejection', 100)->nullable();

            $table->unsignedBigInteger('registered_by');
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('registered_by')->references('id')->on('users');
            $table->foreign('edited_by')->references('id')->on('users');
            $table->foreign('transaction_id')->references('id')->on('transactions');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment');
    }
};
