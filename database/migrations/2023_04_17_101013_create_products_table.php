<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->string('title');
            $table->string('size');
            $table->text('condition');
            $table->text('description');
            $table->integer('category_id');
            $table->string('brand');
            $table->double('price');
            $table->string('country');
            $table->string('city');
            $table->string('location');
            $table->string('quantity');
            $table->string('remaining_items');
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
        Schema::dropIfExists('products');
    }
}
