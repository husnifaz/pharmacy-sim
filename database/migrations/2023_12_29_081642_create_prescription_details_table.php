<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prescription_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('prescription_id');
            $table->integer('item_id');
            $table->integer('qty');
            $table->float('price');
            $table->float('total');
            $table->integer('medicine_uses_id');
            $table->string('remarks')->nullable();
            $table->string('expired_date')->nullable();
            $table->string('batch_number')->nullable();
            $table->unsignedBigInteger('item_stock_id')->nullable();
            $table->timestamps();
            $table->bigInteger('created_by');

            $table->foreign('prescription_id')
                ->references('id')
                ->on('prescriptions')
                ->onDelete('cascade');

            $table->foreign('item_id')
                ->references('id')
                ->on('items')
                ->onDelete('cascade');

            $table->foreign('item_stock_id')
                ->references('id')
                ->on('item_stocks')
                ->onDelete('cascade');

            $table->foreign('medicine_uses_id')
                ->references('id')
                ->on('medicine_uses')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_details');
    }
};
