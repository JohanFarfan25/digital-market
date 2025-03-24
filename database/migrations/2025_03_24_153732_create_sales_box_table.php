<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sales_box', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->double('cash_initial', 20, 3);
            $table->double('base', 20, 3);
            $table->double('total', 20, 3);
            $table->enum('status_box', ['open', 'close']);
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->unsignedBigInteger('registered_by');
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('registered_by')->references('id')->on('users');
            $table->foreign('edited_by')->references('id')->on('users');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('box_id')->nullable();
            $table->foreign('box_id')->references('id')->on('sales_box');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales_box');
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('box_id')->nullable();
            $table->foreign('box_id')->references('id')->on('sales_box');
        });
    }
};
