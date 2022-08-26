<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreasuriesTable extends Migration
{

    public function up()
    {
        Schema::create('treasuries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('address');
            $table->double("start_balance");
            $table->text('description')->nullable();
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
        Schema::dropIfExists('treasuries');
    }
}
