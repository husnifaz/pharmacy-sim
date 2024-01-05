<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('generic')->nullable();
            $table->float('price');
            $table->float('order_price');
            $table->unsignedInteger('medicine_unit_id')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('medicine_unit_id')
                ->references('id')
                ->on('medicine_units')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
