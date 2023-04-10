<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('name1');
            $table->timestamp('buy_date')->default(now());
            $table->integer('invoice_no')->nullable();
            $table->string('address')->nullable();
            $table->string('phone',11)->nullable();
            $table->string('invoice_img')->nullable();
            $table->integer('price')->nullable();
            $table->integer('currency')->nullable();
            $table->double('exchange')->nullable();
            $table->integer('status_id')->nullable();
            $table->text('invoice_note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
