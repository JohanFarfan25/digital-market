<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('payment_type', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('code', 10)->nullable();
            $table->string('label', 45)->nullable();
            $table->enum('type', ['cash', 'credit card','debit card','check','transfer','deposit','other']);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('registered_by');
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('registered_by')->references('id')->on('users');
            $table->foreign('edited_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_type');
    }
};

