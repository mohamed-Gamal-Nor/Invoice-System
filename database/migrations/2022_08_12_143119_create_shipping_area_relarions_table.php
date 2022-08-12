<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingAreaRelarionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_area_relarions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipping_name');
            $table->foreign('shipping_name')
                ->references('id')
                ->on('shippings')
                ->onDelete('restrict')
                ->onUpdate('CASCADE');
            $table->unsignedBigInteger('area');
            $table->foreign('area')
                ->references('id')
                ->on('shipping_areas')
                ->onDelete('restrict')
                ->onUpdate('CASCADE');
            $table->double('price');
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
        Schema::dropIfExists('shipping_area_relarions');
    }
}
