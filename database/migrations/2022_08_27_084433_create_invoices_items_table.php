<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_items', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoices')
                ->onDelete('restrict')
                ->onUpdate('CASCADE');
            $table->unsignedBigInteger('product');
            $table->foreign('product')
                ->references('id')
                ->on('products')
                ->onDelete('restrict')
                ->onUpdate('CASCADE');
            $table->double("price");
            $table->double("quantity");
            $table->double("discount_vat");
            $table->double("rate_vat");
            $table->double("total");
            $table->unsignedBigInteger('size');
            $table->foreign('size')
                ->references('id')
                ->on('sizes')
                ->onDelete('restrict')
                ->onUpdate('CASCADE');
            $table->unsignedBigInteger('color');
            $table->foreign('color')
                ->references('id')
                ->on('colors')
                ->onDelete('restrict')
                ->onUpdate('CASCADE');
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
        Schema::dropIfExists('invoices_items');
    }
}
