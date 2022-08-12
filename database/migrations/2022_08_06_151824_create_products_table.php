<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->unique();
            $table->string('product_number',999)->nullable();
            $table->string('purchasing_price',999);
            $table->string('selling_price',999);
            $table->string('product_image',999)->nullable();
            $table->text('description',999)->nullable();
            $table->unsignedInteger('section');
            $table->foreign('section')
                ->references('id')
                ->on('product_sections')
                ->onDelete('restrict')
                ->onUpdate('CASCADE');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('CASCADE');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('products');
    }
}
