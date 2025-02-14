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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            // Az orders táblához van csatolva. Relationship...Ha törlik bármelyiket az orders táblából
            // akkor innen is törlődik a termék adat
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade'); 
            $table->unsignedBigInteger('product_id');
            $table->string('vendor_id')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('qty');
            $table->float('price', 8,2);
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
        Schema::dropIfExists('order_items');
    }
};
