<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStoresTable extends Migration
{
    public function up()
    {
        Schema::create('product_stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product');
            $table->foreign('product')
                ->references('id')
                ->on('products')
                ->onDelete('restrict')
                ->onUpdate('CASCADE');
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
            $table->unsignedBigInteger('store');
            $table->foreign('store')
                ->references('id')
                ->on('storges')
                ->onDelete('restrict')
                ->onUpdate('CASCADE');
            $table->integer("qty");
            // relation with ivoice items supplier purchases
            $table->unsignedBigInteger('invoice_supplier_purchases')->nullable();
            $table->foreign('invoice_supplier_purchases')
                ->references('id')
                ->on('invoices_items')
                ->onDelete('restrict')
                ->onUpdate('CASCADE');
            // relation with ivoice items supplier Returned purchases
            /*
            $table->unsignedBigInteger('invoice_supplier_purchases_returned')->nullable();
            $table->foreign('invoice_supplier_purchases_returned')
                ->references('id')
                ->on('')
                ->onDelete('restrict')
                ->onUpdate('CASCADE');
            */
            // relation with ivoice items customer purchases
            /*
            $table->unsignedBigInteger('invoice_customer_purchases')->nullable();
            $table->foreign('invoice_supplier_purchases')
                ->references('id')
                ->on('')
                ->onDelete('restrict')
                ->onUpdate('CASCADE');
            // relation with ivoice items customer Returned purchases
            */
            /*
            $table->unsignedBigInteger('invoice_customer_purchases_returned')->nullable();
            $table->foreign('invoice_supplier_purchases')
                ->references('id')
                ->on('')
                ->onDelete('restrict')
                ->onUpdate('CASCADE');
            */
            // 0=> start Balance
            // 1=> purchase from supplier
            // 2=> Repurchase To supplier
            // 3=> pay To Customer
            // 4=> Repay from Customer
            // 5=> Balance Mode
            $table->integer("status");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_stores');
    }
}
