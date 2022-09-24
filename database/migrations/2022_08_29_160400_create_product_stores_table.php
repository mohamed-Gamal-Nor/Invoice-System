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
            $table->integer("status");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_stores');
    }
}
